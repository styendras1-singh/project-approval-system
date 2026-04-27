<x-app-layout>
    <x-slot name="header">
        <h2>Projects</h2>
    </x-slot>

    <div class="p-2">
        <table border="1" width="100%">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>User</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @foreach($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
                <td>{{ $project->user->name ?? 'N/A' }}</td>
                <td>{{ $project->status }}</td>
                <td>
    @if(auth()->user()->role === 'admin')

        <!-- Approve -->
        <form method="POST" action="{{ route('projects.approve', $project->id) }}" style="display:inline;">
            @csrf
            <button type="submit" class="bg-green-700 text-white px-4 py-1 rounded">
                Approve
            </button>
        </form>

        <!-- Reject -->
        <form action="{{ route('projects.reject', $project->id) }}" method="POST" style="display:inline;">
            @csrf
            <input type="text" name="reason" placeholder="Reason" required class="border px-1">
            <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded">
                Reject
            </button>
        </form>

    @else
        <span class="text-gray-400">No Action</span>
    @endif
</td>
            </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>