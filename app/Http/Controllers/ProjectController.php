<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Approval;
use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectStatusMail;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    /**
     * Show create form
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * List projects
     */
   public function index(Request $request)
{
    $user = auth()->user();

    $query = Project::with('user');

    // ✅ Role-based filter
    if ($user->role !== 'admin') {
        $query->where('user_id', $user->id);
    }

    // ✅ Filter: Status
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // ✅ Filter: Submitter (Admin only)
    if ($request->user_id && $user->role === 'admin') {
        $query->where('user_id', $request->user_id);
    }

    // ✅ Filter: Date
    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    // ✅ Sorting
    if ($request->sort == 'oldest') {
        $query->orderBy('created_at', 'asc');
    } else {
        $query->latest(); // default newest
    }

    $projects = $query->get();

    // dropdown ke liye users list (admin ke liye)
    $users = $user->role === 'admin' ? \App\Models\User::all() : [];

    return view('projects.index', compact('projects', 'users'));
}

    /**
     * Store project
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ]);

        $filePath = $request->hasFile('file')
            ? $request->file('file')->store('projects')
            : null;

        $project = Project::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'status' => 'pending'
        ]);

        // ✅ Submit mail
        Mail::to(auth()->user()->email)
            ->queue(new ProjectStatusMail($project, 'submitted'));

        return back()->with('success', 'Project submitted successfully');
    }

    /**
     * Approve project
     */
    public function approve(Project $project)
    {
        $this->authorize('approve', $project); // ✅ policy use

        DB::beginTransaction();

        try {
            $project->update([
                'status' => 'approved'
            ]);

            Approval::create([
                'project_id' => $project->id,
                'admin_id' => auth()->id(),
                'status' => 'approved'
            ]);

            AuditLog::create([
                'user_id' => auth()->id(),
                'project_id' => $project->id,
                'action' => 'approved'
            ]);

            DB::commit();

            // ✅ Mail
            Mail::to($project->user->email)
                ->queue(new ProjectStatusMail($project, 'approved'));

            return back()->with('success', 'Project Approved');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Approval failed');
        }
    }

    /**
     * Reject project
     */
    public function reject(Request $request, Project $project)
    {
        $this->authorize('approve', $project);

        $request->validate([
            'reason' => 'required|string|max:255'
        ]);

        DB::beginTransaction();

        try {
            $project->update([
                'status' => 'rejected'
            ]);

            Approval::create([
                'project_id' => $project->id,
                'admin_id' => auth()->id(),
                'status' => 'rejected',
                'reason' => $request->reason
            ]);

            AuditLog::create([
                'user_id' => auth()->id(),
                'project_id' => $project->id,
                'action' => 'rejected'
            ]);

            DB::commit();

            Mail::to($project->user->email)
                ->queue(new ProjectStatusMail($project, 'rejected', $request->reason));

            return back()->with('error', 'Project Rejected');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Rejection failed');
        }
    }
}