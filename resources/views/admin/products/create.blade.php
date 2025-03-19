@extends('layout')

@section('content')
    <nav class = "flex px-5 py-3 text-gray-700  rounded-lg bg-gray-50 dark:bg-[#1E293B] " aria-label="Breadcrumb">
        <ol class = "inline-flex items-center space-x-1 md:space-x-3">
            <li class = "inline-flex items-center">
                <a href="#"
                    class = "inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    <svg class="h-4 w-4 mr-2" width="20" height="20" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <circle cx="7" cy="17" r="2" />
                        <circle cx="17" cy="17" r="2" />
                        <path d="M5 17h-2v-6l2-5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" />
                    </svg>
                    Mobil > Tambah Mobil
                </a>
            </li>
        </ol>
    </nav><br>
    <h1 class="text-4xl font-bold text-purple-600 max-w-md mx-auto mb-4">Tambah Mobil</h1>


    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="name" name="nama_mobil"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Nama Mobil" required />
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select id="category" name="category_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="number" class="block text-sm font-medium text-gray-700">Tahun</label>
                <input type="number" name="tahun"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Tahun Mobil" required />
            </div>

            <div class="mb-4">
                <label for="number" class="block text-sm font-medium text-gray-700">Harga Sewa</label>
                <input type="number" name="harga_sewa"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Harga Sewa" required />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Upload Image</label>
                <div class="mt-2 flex items-center justify-center">
                    <label for="imageUpload"
                        class="cursor-pointer relative bg-gray-100 border-dashed border-2 border-gray-300 w-full h-40 flex justify-center items-center rounded-lg text-gray-600 hover:bg-gray-200">
                        <span class="text-sm">Click to upload or drag image here</span>
                        <input type="file" name="image" id="imageUpload" accept="image/*" class="hidden"
                            onchange="previewImage(event)" />
                    </label>
                </div>
                <div class="mt-4">
                    <img id="imagePreview" class="hidden w-full rounded-md shadow-md" alt="Image Preview" />
                </div>
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        }
    </script>
    </body>

    </html>
@endsection
