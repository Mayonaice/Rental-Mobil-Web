<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input {
            border: 1px solid #d1d5db; /* Tailwind's border-gray-300 */
            box-shadow: none;
        }

        input:focus {
            outline: none;
            border-color: #6b46c1; /* Tailwind's purple-700 */
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.5); /* Tailwind's purple-400 with transparency */
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
        <h2 class="text-2xl font-bold mb-4 text-center text-purple-700">Payment Form</h2>
        <form  method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data" id="payment-form">
            @csrf
            <div>
                <input type="hidden" name="rental_id" value="{{$rental->id}}">
                <label for="payment-method" class="block text-sm font-medium text-purple-700">Payment Method</label>

                <select id="payment-method" name="master_payment_id" value="" class="mt-1 mb-2 px-3 py-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm">
                    <option value="">Select a method</option>
                    {{-- <option value="e-wallet">E-Wallet</option>
                    <option value="bank">Bank</option> --}}
                    @foreach ($mspayment as $mspay)
                        <option value="{{$mspay->id}}">{{$mspay->tipe_payment}}</option>
                    @endforeach
                </select>
            </div>

            <label for="wallet-name" class="block text-sm font-medium text-purple-700">Nama Akun</label>
            <input type="text" id="wallet-name" name="nama_akun" class="px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="Enter nama akun e-wallet/bank">
            
            <div id="wallet-input" class="hidden">
                <label for="wallet-provider" class="block text-sm font-medium text-purple-700">No hp e-wallet</label>
                <input type="text" id="wallet-provider" name="no_hp" class="px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="Enter no hp e-wallet">
            </div>

            <div id="bank-input" class="hidden" class="mb-2">
                <label for="account-number" class="block text-sm font-medium text-purple-700 mt-2">No Rekening</label>
                <input type="text" id="account-number" name="no_rek" class="px-3 py-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm" placeholder="Enter nomor rekening">
            </div>

            <div>
                <label for="amount" class="mt-1 block text-sm font-medium text-purple-700">Amount</label>
                <input type="text"  id="amount" value="{{ $rental->total_harga }}" class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm sm:text-sm" >
            </div>

            <input type="hidden" name="status_rental" value="WAITING_PAYMENT">
            
            <input type="hidden" name="status" value="NEW">


            <button type="submit" class="mt-4 w-full bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('payment-method').addEventListener('change', function () {
            const walletInput = document.getElementById('wallet-input');
            const bankInput = document.getElementById('bank-input');
            const selectedOptionText = this.options[this.selectedIndex].text;

            if (selectedOptionText === 'Dana' || selectedOptionText === 'GoPay') {
                walletInput.classList.remove('hidden');
                bankInput.classList.add('hidden');
            } else if (selectedOptionText === 'BCA' || selectedOptionText === 'BRI' || selectedOptionText === 'BNI' || selectedOptionText === 'Permata') {
                bankInput.classList.remove('hidden');
                walletInput.classList.add('hidden');
            } else {
                walletInput.classList.add('hidden');
                bankInput.classList.add('hidden');
            }
        });

      
        </script>
</body>
</html>