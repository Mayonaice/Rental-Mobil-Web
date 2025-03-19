<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tambahkan efek animasi */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Container -->
    <div class="min-h-screen flex justify-center items-center">
        <div id="checkout-container" class="max-w-4xl w-full bg-white rounded-lg shadow-lg p-8 fade-in">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6">Checkout</h2>


            <form id="" method="POST" action="{{ route('rental.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-purple-600 mb-3">Customer Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Pemesan</label>
                            {{ $user->name }}
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            {{ $user->email }}
                        </div>
                    </div>
                </div>


                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-purple-600 mb-3">Order Details</h3>
                    <div class="overflow-hidden border border-purple-200 rounded-lg">
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-purple-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mobil
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Waktu
                                        Rental</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Waktu
                                        Pengembalian</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Harga
                                        Per Hari</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 text-gray-900">
                                        <input class=" w-2" type="hidden" name="product_id" readonly value="{{ $getMobil->id }}">
                                        {{ $getMobil->nama_mobil }}
                                        </td>
                                    <input type="hidden" name="status" value="NEW" id="">
                                    <td class="px-6 py-4 text-right text-gray-600"><input id="waktu_pinjam"
                                            type="date" value="{{ old('tanggal', $defaultDate) }}"
                                            name="waktu_pinjam"></td>
                                    <td class="px-6 py-4 text-right text-gray-600"><input id='waktu_pengembalian'
                                            type="date" name="waktu_pengembalian"></td>
                                    <td class="px-6 py-4 text-right text-gray-600">Rp.
                                        <strong id="harga">{{ $getMobil->harga_sewa }}</strong>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot class="bg-purple-50">
                                <tr>
                                    <td class="px-6 py-4 text-right font-semibold" colspan="3">Total:</td>
                                    <td class="px-6 py-4 text-right font-semibold text-purple-700">
                                        <input  class="" id="totalHarga" type="text" readonly
                                            name="total_harga">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <a href="{{ route('rental.payment') }}">
                    <button type="submit" id="submit-button"
                        class="px-6 py-3 bg-purple-600 text-white rounded-lg shadow hover:bg-purple-700 transition duration-300 transform hover:scale-105">
                        Go To Payment
                    </button>
                </a>


            </form>

            <div id="confirmation-message" class="hidden mt-6 text-center text-purple-600 text-lg font-semibold">
                Order Confirmed! Thank you for your purchase.
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('checkout-container');
            container.classList.add('visible');
        });

        const startDateInput = document.getElementById('waktu_pinjam');
        const endDateInput = document.getElementById('waktu_pengembalian');
        const hargaPerHari = parseInt(document.getElementById('harga').textContent);
        const totalHargaOutput = document.getElementById('totalHarga');


        function calculateDifference() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (!isNaN(startDate) && !isNaN(endDate) && endDate > startDate) {
                const timeDifference = endDate - startDate;
                const dayDifference = timeDifference / (1000 * 60 * 60 * 24);

                const totalHarga = dayDifference * hargaPerHari;

                totalHargaOutput.value = totalHarga.toLocaleString('id-ID');
            } else {
                totalHargaOutput.value = 0;
            }

        }

        // Tambahkan event listener ke input tanggal
        startDateInput.addEventListener('change', calculateDifference);
        endDateInput.addEventListener('change', calculateDifference);
    </script>

</body>

</html>
