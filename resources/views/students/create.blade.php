<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Student
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-md rounded-lg p-6">

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form Start -->
                <form action="{{ route('students.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" name="name"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                               placeholder="Enter name" value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                               placeholder="Enter email" value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Phone</label>
                        <input type="text" name="phone"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                               placeholder="Enter phone" value="{{ old('phone') }}">
                    </div>

                    <!-- DOB -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Date of Birth</label>
                        <input type="date" name="dob"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                               value="{{ old('dob') }}">
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-1">Address</label>
                        <textarea name="address" rows="3"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                                  placeholder="Enter address">{{ old('address') }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between">
                        <a href="{{ route('students.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Back
                        </a>

  <button type="submit"
    class="bg-gradient-to-r from-blue-500 to-indigo-600 
           hover:from-blue-600 hover:to-indigo-700
           text-white px-6 py-2 rounded-lg 
           shadow-lg hover:shadow-xl 
           transition duration-300 ease-in-out">
    Save Student
</button>
                    </div>

                </form>
                <!-- Form End -->

            </div>

        </div>
    </div>
</x-app-layout>