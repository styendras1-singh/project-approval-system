<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Fee History - {{ $student->name }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto">

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">

                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">#</th>
                            <th class="p-3 text-left">Amount</th>
                            <th class="p-3 text-left">Payment Mode</th>
                            <th class="p-3 text-left">Date</th>
                            <th class="p-3 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($fees as $key => $fee)
                        <tr class="border-t">
                            <td class="p-3">{{ $key + 1 }}</td>
                            <td class="p-3 font-semibold text-green-600">₹{{ $fee->amount }}</td>
                            <td class="p-3">{{ ucfirst($fee->payment_mode) }}</td>
                            <td class="p-3">{{ $fee->payment_date }}</td>

                            <td class="p-3 text-center">
                                <a href="{{ route('students.receipt', $fee->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                                    View Receipt
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500">
                                No Fee Records Found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            <!-- Back Button -->
            <div class="mt-4">
                <a href="{{ route('students.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Back
                </a>
            </div>

        </div>
    </div>
</x-app-layout>