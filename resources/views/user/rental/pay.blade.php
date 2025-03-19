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
        <h2 class="text-2xl font-bold mb-4 text-center text-purple-700">Pembayaran</h2>
        <form action="{{ route('payment.pay', $paymentid) }}" method="POST" enctype="multipart/form-data" id="payment-form">
            @method('PUT')
            @csrf
            @foreach ($masterPayment as $msp)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-purple-600 mb-3">Informasi Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="hidden"  value="{{ $paymentid->rental_id }}">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Bank</label>
                            <input type="hidden" value="{{ $paymentid->master_payment_id }}">
                            {{ $msp->tipe_payment }}
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Nama Akun</label>
                            <input type="hidden"  id="" value="{{ $paymentid->nama_akun }}">
                            {{ $paymentid->nama_akun }}
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        @if ($paymentid->no_hp != null)
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">No HP</label>
                                <input type="hidden"  value="{{ $paymentid->no_hp }}">
                                {{ $paymentid->no_hp }}
                            </div>
                        @endif
                        @if ($paymentid->no_rek != null)
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">No
                                    Rekening</label>
                                <input type="hidden" no_rek" value="{{ $paymentid->no_rek }}">
                                {{ $paymentid->no_rek }}
                            </div>
                        @endif

                    </div>
                    <h2 class="font-semibold mt-6">Scan Barcode Ini untuk melakukan pembayaran!</h2>
                    <div class=" flex justify-center items-center">
                        <img class="w-[216px]" src="{{ asset('storage/' . $msp->qrcode) }}" alt="">
                    </div>
                </div>
            @endforeach


    <div>
        <label for="amount" class="mt-1 block text-sm font-medium text-purple-700">Amount</label>
        <input type="text" id="amount" value="{{ $paymentid->rental->total_harga }}"
            class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm sm:text-sm">
    </div>

    <div class="mb-4 mt-6">
        <label class="block text-sm font-medium text-gray-700">Upload Bukti Pembayaran!</label>
        <div class="mt-2 flex items-center justify-center">
            <label for="imageUpload"
                class="cursor-pointer relative bg-gray-100 border-dashed border-2 border-gray-300 w-full h-40 flex justify-center items-center rounded-lg text-gray-600 hover:bg-gray-200">
                <span class="text-sm">Click to upload or drag image here</span>
                <input type="file" name="bukti_pembayaran" id="imageUpload" accept="image/*" class="hidden"
                    onchange="previewImage(event)" />
            </label>
        </div>
        <div class="mt-4">
            <img id="imagePreview" class="hidden w-full rounded-md shadow-md" alt="Image Preview" />
        </div>
    </div>

    <input type="hidden" name="status" value="WAITING_CONFIRMED">
    <input type="hidden" name="status_rental" value="WAITING_PAYMENT_CONFIRM">

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
