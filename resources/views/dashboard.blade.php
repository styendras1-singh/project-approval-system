
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- HEADER -->

            <!-- STATS CARDS -->
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-gray-500">Total Projects</h3>
                    <p class="text-2xl font-bold">{{ $total }}</p>
                </div>

                <div class="bg-yellow-100 p-4 rounded shadow">
                    <h3 class="text-yellow-700">Pending</h3>
                    <p class="text-2xl font-bold">
                        {{ $pending }} ({{ $total ? round(($pending/$total)*100) : 0 }}%)
                    </p>
                </div>

                <div class="bg-green-100 p-4 rounded shadow">
                    <h3 class="text-green-700">Approved</h3>
                    <p class="text-2xl font-bold">
                        {{ $approved }} ({{ $total ? round(($approved/$total)*100) : 0 }}%)
                    </p>
                </div>

                <div class="bg-red-100 p-4 rounded shadow">
                    <h3 class="text-red-700">Rejected</h3>
                    <p class="text-2xl font-bold">
                        {{ $rejected }} ({{ $total ? round(($rejected/$total)*100) : 0 }}%)
                    </p>
                </div>

            </div>

            <!-- PROJECT TABLE -->
            <div class="bg-white shadow rounded p-4">

                <h3 class="text-lg font-bold mb-4">Project List</h3>

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-2">Project Name</th>
                            <th class="p-2">Submitter</th>
                            <th class="p-2">Submission Date</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Last Updated</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($projects->isEmpty())
<tr>
    <td colspan="5" class="text-center text-gray-500 py-4">
        No projects found
    </td>
</tr>
@endif
                        @foreach($projects as $project)
                        <tr class="border-t">
                            <td class="p-2">{{ $project->title }}</td>

                            <td class="p-2">
                                {{ $project->user->name }}
                            </td>

                            <td class="p-2">
                                {{ $project->created_at->format('d-m-Y') }}
                            </td>

                            <!-- STATUS COLOR -->
                            <td class="p-2">
                                @if($project->status == 'pending')
                                    <span class="text-yellow-600 font-bold">Pending</span>
                                @elseif($project->status == 'approved')
                                    <span class="text-green-600 font-bold">Approved</span>
                                @else
                                    <span class="text-red-600 font-bold">Rejected</span>
                                @endif
                            </td>

                            <td class="p-2">
                                {{ $project->updated_at->format('d-m-Y H:i') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>