@extends('layout')

@section('content')
    <nav class = "flex px-5 py-3 text-gray-700  rounded-lg bg-gray-50 dark:bg-[#1E293B] " aria-label="Breadcrumb">
        <ol class = "inline-flex items-center space-x-1 md:space-x-3">
            <li class = "inline-flex items-center">
                <a href="#"
                    class = "inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    <svg class="h-4 w-4 mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path
                            d="M10 13l2.538-.003c2.46 0 4.962-2.497 4.962-4.997 0-3-1.89-5-4.962-5H7c-.5 0-1 .5-1 1L4 18c0 .5.5 1 1 1h2.846L9 14c.089-.564.43-1 1-1zm7.467-5.837C19.204 8.153 20 10 20 12c0 2.467-2.54 4.505-5 4.505h.021-2.629l-.576 3.65a.998.998 0 01-.988.844l-2.712-.002a.5.5 0 01-.494-.578L7.846 19" />
                    </svg>
                    Payment > Tambah Metode Payment
                </a>
            </li>
        </ol>
    </nav><br>
    <h1 class="text-4xl font-bold text-purple-600 max-w-md mx-auto mb-4">Tambah Payment</h1>


    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">

        <form action="{{ route('masterPayment.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Akun</label>
                <input type="text" id="name" name="nama_akun"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Nama Akun" required />
            </div>

            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Tipe Payment</label>
                <select id="selector" name="tipe_payment"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    required>
                        <option value="BCA">BCA</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="Permata">Permata</option>
                        <option value="GoPay">Gopay</option>
                        <option value="Dana">Dana</option>
                </select>
            </div>

            <div id="bank" style="display: block;" class="mb-4">
                <label for="number" class=" text-sm font-medium text-gray-700">No Rekening</label>
                <input type="text" name="no_rek"
                    class="mt-1  w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="No Rekening"  />
            </div>
            <div id="nohp" style="display: none;" class="mb-4">
                <label for="number" class=" text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="no_hp"
                    class="mt-1  w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="No Hp"  />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Upload QR Code</label>
                <div class="mt-2 flex items-center justify-center">
                    <label for="imageUpload"
                        class="cursor-pointer relative bg-gray-100 border-dashed border-2 border-gray-300 w-full h-40 flex justify-center items-center rounded-lg text-gray-600 hover:bg-gray-200">
                        <span class="text-sm">Click to upload or drag image here</span>
                        <input type="file" name="qrcode" id="imageUpload" accept="image/*" class="hidden"
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

        const selector = document.getElementById('selector');
        const use_norek = document.getElementById('bank');
        const use_nohp = document.getElementById('nohp');

        selector.addEventListener('change', () => {
            const selectedValue = selector.value;

            use_norek.style.display = 'block';
            use_nohp.style.display = 'none';

            if (selectedValue === 'BCA' || selectedValue ===  'BNI' || selectedValue ===  'BRI' || selectedValue ===  'Permata') {
                use_norek.style.display = 'block';
            } else if (selectedValue === 'GoPay' || selectedValue ===  'Dana') {
                use_norek.style.display = 'none';
                use_nohp.style.display = 'block';
            } else {
                //
            }
        });
    </script>
    </body>

    </html>
@endsection
