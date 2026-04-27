<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
{
    $user = auth()->user();

    $projects = $user->role === 'admin'
        ? Project::with('user')->latest()->get()
        : Project::with('user')->where('user_id', $user->id)->latest()->get();

    $total = $projects->count();
    $pending = $projects->where('status', 'pending')->count();
    $approved = $projects->where('status', 'approved')->count();
    $rejected = $projects->where('status', 'rejected')->count();

    return view('dashboard', compact(
        'projects',
        'total',
        'pending',
        'approved',
        'rejected'
    ));
}
}
