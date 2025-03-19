@extends('layout')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
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
                    List Bukti Pengembalian
                </a>
            </li>
        </ol>
    </nav>

    <body class="bg-gray-100 flex p-10">
        <div class="container mx-auto opacity-0 transition-opacity duration-1000" id="tableContainer">

            <div class="overflow-x-auto">
                <div class="flex mb-4">
                    <!-- Tombol Approved -->
                    <button 
                        class="tab-button border-2 border-purple-700 px-4 py-2 rounded-l-lg transition bg-white text-purple-700 hover:bg-purple-700 hover:text-white" 
                        data-tab="approved">
                        Approved
                    </button>
                    <!-- Tombol Waiting Approval (Default Active) -->
                    <button 
                        class="tab-button border-2 border-purple-700 px-4 py-2 rounded-r-lg transition bg-white text-purple-700 hover:bg-purple-700 hover:text-white" 
                        data-tab="waiting">
                        Waiting Approval
                    </button>
                </div>

                <div class="hidden grid grid-cols-3 gap-4 opacity-0 transition-opacity duration-700 ease-in-out"
                    id="approved">
                    <table class="w-full bg-white border border-gray-200 rounded-lg table-auto">
                        <thead>
                            <tr class="bg-blue-200">
                                <th class="py-2 px-20 border-b text-blue-800">Nama Produk</th>
                                <th class="py-2 px-16 border-b text-blue-800">Gambar</th>
                                <th class="py-2 px-16 border-b text-blue-800">Tanggal Dirental</th>
                                <th class="py-2 px-16 border-b text-blue-800">Tanggal Pengembalian</th>
                                <th class="py-2 px-16 border-b text-blue-800">Bukti Pengembalian</th>
                            </tr>
                        </thead>
                        @php
                            $approvedReturn = $getReturn->where('status', 'DONE');
                        @endphp

                        @foreach ($approvedReturn as $return)
                            <tbody>
                                <tr>
                                    <td class="py-2 px-20 border-b text-gray-700">{{ $return->product->nama_mobil }}</td>
                                    <td class="py-2 px-16 border-b">
                                        <button onclick="showImage('{{ asset('storage/' . $return->product->image) }}')"
                                            class="bg-blue-500 text-white px-4 py-1 rounded">View</button>
                                    </td>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $return->waktu_pinjam }}</td>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $return->waktu_pengembalian }}</td>

                                    <td class="py-2 px-16 border-b">
                                        <button onclick="showImage('{{ asset('storage/' . $return->bukti_pengembalian) }}')"
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
                                <th class="py-2 px-16 border-b text-yellow-800">Nama Produk</th>
                                <th class="py-2 px-16 border-b text-yellow-800">Gambar</th>
                                <th class="py-2 px-16 border-b text-yellow-800">Tanggal Dirental</th>
                                <th class="py-2 px-16 border-b text-yellow-800">Tanggal Pengembalian</th>
                                <th class="py-2 px-16 border-b text-yellow-800">Bukti Pengembalian</th>
                                <th class="py-2 px-16 border-b text-yellow-800"></th>
                            </tr>
                        </thead>
                        @php
                            $waitingReturn = $getReturn->where('status', 'WAITING_PENGEMBALIAN_CONFIRMED');
                        @endphp

                        @foreach ($waitingReturn as $return)
                            <tbody>
                                <tr>
                                    <td class="py-2 px-20 border-b text-gray-700">{{ $return->product->nama_mobil }}</td>
                                    <td class="py-2 px-16 border-b">
                                        <button onclick="showImage('{{ asset('storage/' . $return->product->image) }}')"
                                            class="bg-yellow-500 text-white px-4 py-1 rounded">View</button>
                                    </td>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $return->waktu_pinjam }}</td>
                                    <td class="py-2 px-16 border-b text-gray-700">{{ $return->waktu_pengembalian }}</td>

                                    <td class="py-2 px-16 border-b">
                                        <button onclick="showImage('{{ asset('storage/' . $return->bukti_pengembalian) }}')"
                                            class="bg-yellow-500 text-white px-4 py-1 rounded">View</button>
                                    </td>
                                    <td class="py-2 px-14 border-b">
                                        <form action="{{ route('confirmReturn.confirm', $return) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button onclick="confirm('Anda yakin ini mengapprove pengembalian ini?')"
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
           const buttons = document.querySelectorAll('.tab-button');
        const contents = document.querySelectorAll('.grid');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const tab = this.dataset.tab;

                buttons.forEach(btn => {
                    btn.classList.remove('bg-purple-700', 'text-white');
                    btn.classList.add('bg-white', 'text-purple-700');
                });

                contents.forEach(content => {
                    content.classList.add('hidden', 'opacity-0');
                });

                const activeTab = document.getElementById(tab);
                activeTab.classList.remove('hidden');
                setTimeout(() => activeTab.classList.remove('opacity-0'), 10);

                this.classList.add('bg-purple-700', 'text-white');
            });
        });

        window.addEventListener('load', () => {
            const tableContainer = document.getElementById('tableContainer');
            const defaultButton = document.querySelector('button[data-tab="waiting"]');
            const defaultTab = document.getElementById('waiting');

            tableContainer.classList.remove('opacity-0');
            tableContainer.classList.add('opacity-100');
            defaultButton.classList.add('bg-purple-700', 'text-white');
            defaultTab.classList.remove('hidden', 'opacity-0');
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
