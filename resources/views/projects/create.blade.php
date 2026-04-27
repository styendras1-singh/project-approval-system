<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Submit Project
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div>
                    <label>Title</label>
                    <input type="text" name="title" class="border p-2 w-full" required>
                </div>

                <div class="mt-4">
                    <label>Description</label>
                    <textarea name="description" class="border p-2 w-full" required></textarea>
                </div>

                <div class="mt-4">
                    <label>File</label>
                    <input type="file" name="file" class="border p-2 w-full">
                </div>

                <div class="mt-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">
                        Submit Project
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>