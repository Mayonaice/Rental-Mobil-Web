<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input {
            border: 1px solid #d1d5db;
            box-shadow: none;
        }

        input:focus {
            outline: none;
            border-color: #6b46c1;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.5);
        }

        select:focus {
            outline: none;
            border-color: #6b46c1;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.5);
        }
    </style>
</head>

<body class="bg-purple-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center text-purple-700">Pengembalian</h2>
        <form action="{{ route('return.update', $getReturn) }}" method="POST" enctype="multipart/form-data"
            id="payment-form">
            @method('PUT')
            @csrf
            <div>
                <label for="amount" class="mt-1 block text-sm font-medium text-purple-700">Nama Mobil</label>
                <input type="text" id="amount" value="{{ $getReturn->product->nama_mobil }}"
                    class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm sm:text-sm">
            </div>
            <div class=" col-span-2">
                <label for="amount" class="mt-1 block text-sm font-medium text-purple-700">Tanggal Rental</label>
                <input type="date" readonly id="amount" value="{{ $getReturn->waktu_pinjam }}"
                    class="mt-1 px-3 py-2 rounded-md border-gray-300 shadow-sm sm:text-sm">
                <span> - </span>
                <input type="date" readonly id="amount" value="{{ $getReturn->waktu_pengembalian }}"
                    class="mt-1 px-3 py-2 rounded-md border-gray-300 shadow-sm sm:text-sm">
            </div>

            <div class="mb-4 mt-6">
                <label class="block text-sm font-medium text-gray-700">Upload Bukti Pembayaran!</label>
                <div class="mt-2 flex items-center justify-center">
                    <label for="imageUpload"
                        class="cursor-pointer relative bg-gray-100 border-dashed border-2 border-gray-300 w-full h-40 flex justify-center items-center rounded-lg text-gray-600 hover:bg-gray-200">
                        <span class="text-sm">Click to upload or drag image here</span>
                        <input type="file" name="bukti_pengembalian" id="imageUpload" accept="image/*" class="hidden"
                            onchange="previewImage(event)" />
                    </label>
                </div>
                <div class="mt-4">
                    <img id="imagePreview" class="hidden w-full rounded-md shadow-md" alt="Image Preview" />
                </div>
            </div>

            <input type="hidden" name="status" value="WAITING_PENGEMBALIAN_CONFIRMED">

            <button type="submit"
                class="mt-4 w-full bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('payment-method').addEventListener('change', function() {
            const walletInput = document.getElementById('wallet-input');
            const bankInput = document.getElementById('bank-input');
            const selectedOptionText = this.options[this.selectedIndex].text;

            if (selectedOptionText === 'Dana' || selectedOptionText === 'GoPay') {
                walletInput.classList.remove('hidden');
                bankInput.classList.add('hidden');
            } else if (selectedOptionText === 'BCA' || selectedOptionText === 'BRI' || selectedOptionText ===
                'BNI' || selectedOptionText === 'Permata') {
                bankInput.classList.remove('hidden');
                walletInput.classList.add('hidden');
            } else {
                walletInput.classList.add('hidden');
                bankInput.classList.add('hidden');
            }
        });

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
