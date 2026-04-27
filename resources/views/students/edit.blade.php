<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Student
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white shadow-md rounded-lg p-6">

                <form action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block mb-1">Name</label>
                        <input type="text" name="name"
                            value="{{ $student->name }}"
                            class="w-full border-gray-300 rounded-lg">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block mb-1">Email</label>
                        <input type="email" name="email"
                            value="{{ $student->email }}"
                            class="w-full border-gray-300 rounded-lg">
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="block mb-1">Phone</label>
                        <input type="text" name="phone"
                            value="{{ $student->phone }}"
                            class="w-full border-gray-300 rounded-lg">
                    </div>

                    <!-- DOB -->
                    <div class="mb-4">
                        <label class="block mb-1">DOB</label>
                        <input type="date" name="dob"
                            value="{{ $student->dob }}"
                            class="w-full border-gray-300 rounded-lg">
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block mb-1">Address</label>
                        <textarea name="address"
                            class="w-full border-gray-300 rounded-lg">{{ $student->address }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-between">

                        <a href="{{ route('students.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">
                            Back
                        </a>

                        <!-- Gradient Update Button -->
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-500 to-indigo-600 
                                   hover:from-blue-600 hover:to-indigo-700
                                   text-white px-6 py-2 rounded-lg shadow-lg">
                            Update Student
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>