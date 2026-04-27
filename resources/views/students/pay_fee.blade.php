<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Pay Fee
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow-lg rounded-lg p-6">

                <!-- Student Info -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold">Student Details</h3>
                    <p><strong>Name:</strong> {{ $student->name }}</p>
                    <p><strong>Email:</strong> {{ $student->email }}</p>
                </div>
                
                <!-- ✅ Razorpay Form -->
                <form action="{{ route('razorpay.payment') }}" method="POST">
                    @csrf

                    <!-- Hidden Student ID -->
                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                    <!-- Amount -->
                    <div class="mb-4">
                        <label class="block mb-1">Amount</label>
                        <input type="number" name="amount"
                            class="w-full border-gray-300 rounded-lg"
                            placeholder="Enter amount" required>
                    </div>

                    <!-- Payment Mode (Auto Online) -->
                    <input type="hidden" name="payment_mode" value="online">

                    <!-- Buttons -->
                    <div class="flex justify-between">

                        <a href="{{ route('students.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Back
                        </a>

                        <!-- 💎 Premium Razorpay Button -->
                        <button type="submit"
                            class="bg-gradient-to-r from-purple-500 to-indigo-600
                                   hover:from-purple-600 hover:to-indigo-700
                                   text-white px-6 py-2 rounded-lg shadow-lg flex items-center gap-2">

                            <!-- Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                 class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8c-1.657 0-3 1.343-3 3h6c0-1.657-1.343-3-3-3z" />
                            </svg>

                            Pay with Razorpay
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>