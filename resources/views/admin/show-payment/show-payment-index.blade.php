@extends('layout')

@section('content')
    <nav class = "flex px-5 py-3 text-gray-700 mb-8 rounded-lg bg-gray-50 dark:bg-[#1E293B] " aria-label="Breadcrumb">
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
                    List Payment
                </a>
            </li>
        </ol>
    </nav>

    <body class="bg-gray-100 flex p-10">
        <div class="container mx-auto opacity-0 transition-opacity duration-1000" id="tableContainer">

            <div class="overflow-x-auto">
                <div class="flex mb-4">
                    <button
                        class="text-purple-700 border-2 border-purple-700 px-4 py-2 rounded-l-lg hover:bg-purple-700 hover:text-white outline-none active:bg-purple-700 active:text-white"
                        data-tab="approved">Approved</button>
                    <button
                        class="text-white bg-purple-700 border-2 border-purple-700 px-4 py-2 rounded-r-lg outline-none hover:bg-purple-700 hover:text-white"
                        data-tab="waiting">Waiting Approval</button>
                </div>

                <div class="hidden grid grid-cols-3 gap-4 opacity-0 transition-opacity duration-700 ease-in-out"
                    id="approved">
                    <table class="w-full bg-white border border-gray-200 rounded-lg table-auto">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="py-2 px-16 border-b text-blue-800">Nama Akun</th>
                                <th class="py-2 px-16 border-b text-blue-800">No HP</th>
                                <th class="py-2 px-16 border-b text-blue-800">No Rek</th>
                                <th class="py-2 px-6 border-b text-blue-800">Bukti Pembayaran</th>
                            </tr>
                        </thead>
                        @php
                            $approvedPayment = $getPayment->where('status', 'CONFIRMED');
                        @endphp

                        @foreach ($approvedPayment as $payment)
                            <tbody>
                                <tr>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $payment->nama_akun }}</td>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $payment->no_hp }}</td>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $payment->no_rek }}</td>
                                    <td class="py-2 px-6 border-b">
                                        <button onclick="showImage('{{ asset('storage/' . $payment->bukti_pembayaran) }}')"
                                            class="bg-blue-500 text-white px-4 py-1 rounded">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>

                <div class="grid grid-cols-3 gap-4 opacity-100 transition-opacity duration-700 ease-in-out"
                    id="waiting">
                    <table class="w-full bg-white border border-gray-200 rounded-lg table-auto">
                        <thead>
                            <tr class="bg-yellow-200">
                                <th class="py-2 px-16 border-b text-yellow-800">Nama Akun</th>
                                <th class="py-2 px-16 border-b text-yellow-800">No HP</th>
                                <th class="py-2 px-16 border-b text-yellow-800">No Rek</th>
                                <th class="py-2 px-14 border-b text-yellow-800">Nominal</th>
                                <th class="py-2 px-16 border-b text-yellow-800">Bukti Pembayaran</th>
                                <th class="py-2 px-14 border-b text-yellow-800"></th>
                            </tr>
                        </thead>
                        @php
                            $waitingPayment = $getPayment->where('status', 'WAITING_CONFIRMED');
                        @endphp

                        @foreach ($waitingPayment as $payment)
                            <tbody>
                                <tr>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $payment->nama_akun }}</td>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $payment->no_hp }}</td>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $payment->no_rek }}</td>
                                    <td class="py-2 px-14 border-b text-gray-700">{{ $payment->rental->total_harga }}</td>
                                    <td class="py-2 px-16 border-b">
                                        <button onclick="showImage('{{ asset('storage/' . $payment->bukti_pembayaran) }}')"
                                            class="bg-yellow-500 text-white px-4 py-1 rounded">View</button>
                                    </td>
                                    <td class="py-2 px-14 border-b">
                                        <form action="{{ route('showpayment.confirm', $payment) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button onclick="confirm('Anda yakin ini mengapprove pembayaran ini?')"
                                                class="bg-blue-500 text-white px-4 py-1 rounded">
                                                Confirm
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="hidden fixed top-10 left-0 w-[100%] h-[100%] bg-black bg-opacity-60 flex items-center justify-center"
            id="imageModal">
            <div class="bg-white p-5 rounded-lg max-w-3xl relative overflow-auto" style="max-height: 90%; max-width: 90%;">
                <span class="absolute top-0 right-0 text-4xl cursor-pointer text-red-500"
                    onclick="closeModal()">&times;</span>
                <img src="" alt="Profile Image" id="modalImage" class="w-full rounded-lg">
            </div>
        </div>

        <script>
           const buttons = document.querySelectorAll('button[data-tab]');
        const contents = document.querySelectorAll('.grid');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const tab = this.dataset.tab;

                // Hide all tabs and reset buttons
                contents.forEach(content => {
                    content.classList.add('hidden', 'opacity-0');
                });

                buttons.forEach(btn => {
                    btn.classList.remove('bg-purple-700', 'text-white');
                    btn.classList.add('bg-white', 'text-purple-700');
                });

                // Activate selected tab and button
                const activeTab = document.getElementById(tab);
                activeTab.classList.remove('hidden');
                setTimeout(() => activeTab.classList.remove('opacity-0'), 10);
                this.classList.add('bg-purple-700', 'text-white');
            });
        });

            window.addEventListener('load', () => {
                const tableContainer = document.getElementById('tableContainer');
                tableContainer.classList.remove('opacity-0');
                tableContainer.classList.add('opacity-100');
            });

            function showImage(src) {
                const modalImage = document.getElementById('modalImage');
                modalImage.src = src;
                document.getElementById('imageModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('imageModal').classList.add('hidden');
            }
        </script>
    </body>
@endsection
