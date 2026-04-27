<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Students List
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Top Buttons -->
            <div class="flex justify-between mb-4">
                <a href="{{ route('students.create') }}"
                   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    + Add Student
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">ID</th>
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Email</th>
                            <th class="p-3 text-left">Phone</th>
                            <th class="p-3 text-left">DOB</th>
                            <th class="p-3 text-left">Address</th>
                            <th class="p-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($students as $student)
                        <tr class="border-t">
                            <td class="p-3">{{ $student->id }}</td>
                            <td class="p-3">{{ $student->name }}</td>
                            <td class="p-3">{{ $student->email }}</td>
                            <td class="p-3">{{ $student->phone }}</td>
                            <td class="p-3">{{ $student->dob }}</td>
                            <td class="p-3">{{ $student->address }}</td>

                            <td class="p-3 text-center flex gap-2 justify-center">

                                <!-- Edit -->
                                <a href="{{ route('students.edit', $student->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </form>

                                <!-- Pay Fee Button with Loader -->
                                <a href="{{ route('students.payFee', $student->id) }}"
                                   class="bg-blue-500 text-white px-3 py-1 rounded flex items-center gap-2"
                                   onclick="showLoader(this)">
                                    
                                    <svg class="animate-spin h-4 w-4 text-white hidden loader" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v8H4z"></path>
                                    </svg>

                                    <span class="btnText">Pay Fee</span>
                                </a>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center p-4 text-gray-500">
                                No Students Found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Loader Script -->
    <script>
        function showLoader(button) {
            let loader = button.querySelector('.loader');
            let text = button.querySelector('.btnText');

            loader.classList.remove('hidden');
            text.innerText = 'Processing...';
        }
    </script>

</x-app-layout>