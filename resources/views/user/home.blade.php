@extends('user.layout')

@section('content')
    <style>
        .hidden-card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .visible-card {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <nav class = "flex px-5 py-3 text-gray-700  rounded-lg bg-gray-50 dark:bg-[#1E293B] " aria-label="Breadcrumb">
        <ol class = "inline-flex items-center space-x-1 md:space-x-3">
            <li class = "inline-flex items-center">
                <a href="#"
                    class = "inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    <svg class = "w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                    Dashboard
                </a>
            </li>
        </ol>
    </nav>

    <div class="ms-8">
        <div class="text-3xl font-semibold mt-6 mb-6">
            Kamu Masuk Sebagai <span class="text-purple-500 font-bold">User Rental</span>
        </div>

        @if ($newRental->isempty())
        @else
            <div class="container mx-auto py-8">
                <h1 class="text-xl font-base mb-6 text-start text-gray-600">Rental kamu yang belum kamu pilih
                    pembayarannya<a class="text-purple-500 font-bold" href="">></a></h1>
                <div class="w-full h-auto overflow-x-auto">

                    <div id="noDataMessage" class="hidden text-center text-gray-600 text-lg font-semibold py-4">
                        Belum ada rental apapun.
                    </div>

                    <div id="cardContainer"
                        class="flex gap-4 overflow-x-scroll scrollbar-thin scrollbar-thumb-purple-200 scrollbar-track-white">
                        @foreach ($newRental as $rental)
                            <div
                                class="min-w-[300px] p-4 bg-white border rounded shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                                <img src="{{ asset('storage/' . $rental->product->image) }}"
                                    alt="{{ $rental->product->name }}" class="w-full h-48 object-cover rounded mb-4">
                                <h2 class="text-lg font-bold mb-2 text-purple-800">{{ $rental->name }}</h2>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Rental:</span>
                                    {{ $rental->waktu_pinjam }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Pengembalian:</span>
                                    {{ $rental->waktu_pengembalian }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Total Harga:</span> Rp
                                    {{ $rental->total_harga }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Status:</span>
                                    <span class="px-2 py-1 rounded transition-colors duration-300 font-bold text-red-700">
                                        Need Choose Payment
                                    </span>
                                </p>
                                <a href="">
                                    <button>

                                    </button>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($waitingPayment->isempty())
        @else
            <div class="container mx-auto py-8">
                <h1 class="text-xl font-base mb-6 text-start text-gray-600">Rental kamu yang belum kamu lakukan pembayaran<a
                        class="text-purple-500 font-bold" href=""> ></a></h1>
                <div class="w-full h-auto overflow-x-auto">

                    <div id="noDataMessage" class="hidden text-center text-gray-600 text-lg font-semibold py-4">
                        Belum ada rental apapun.
                    </div>

                    <div id="cardContainer"
                        class="flex gap-4 overflow-x-scroll scrollbar-thin scrollbar-thumb-purple-200 scrollbar-track-white">

                        @foreach ($waitingPayment as $rental)
                            <div
                                class="min-w-[300px] p-4 bg-white border rounded shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                                <img src="{{ asset('storage/' . $rental->product->image) }}"
                                    alt="{{ $rental->product->name }}" class="w-full h-48 object-cover rounded mb-4">
                                <h2 class="text-lg font-bold mb-2 text-purple-800">{{ $rental->name }}</h2>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Rental:</span>
                                    {{ $rental->waktu_pinjam }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Pengembalian:</span>
                                    {{ $rental->waktu_pengembalian }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Total Harga:</span> Rp
                                    {{ $rental->total_harga }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Status:</span>
                                    <span
                                        class="px-2 py-1 font-semibold rounded transition-colors duration-300 text-red-500">
                                        Waiting Payment
                                    </span>
                                </p>
                                @php
                                    $bayar = $paymentNew->where('rental_id', $rental->id);
                                @endphp
                                @foreach ($bayar as $b)
                                    <a href="{{ route('payment.showPay', $b) }}">
                                        <button type="submit"
                                            class="mt-4 w-full bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Lakukan
                                            pembayaran disini!</button>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($waitingConfirm->isempty())
        @else
            <div class="container mx-auto py-8">
                <h1 class="text-xl font-base mb-6 text-start text-gray-600">Menunggu konfirmasi Admin, Mohon ditunggu ya<a
                        class="text-purple-500 font-bold" href=""> ></a></h1>
                <div class="w-full h-auto overflow-x-auto">

                    <div id="noDataMessage" class="hidden text-center text-gray-600 text-lg font-semibold py-4">
                        Belum ada rental apapun.
                    </div>

                    <div id="cardContainer"
                        class="flex gap-4 overflow-x-scroll scrollbar-thin scrollbar-thumb-purple-200 scrollbar-track-white">

                        @foreach ($waitingConfirm as $rental)
                            <div
                                class="min-w-[300px] p-4 bg-white border rounded shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                                <img src="{{ asset('storage/' . $rental->product->image) }}"
                                    alt="{{ $rental->product->name }}" class="w-full h-48 object-cover rounded mb-4">
                                <h2 class="text-lg font-bold mb-2 text-purple-800">{{ $rental->name }}</h2>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Rental:</span>
                                    {{ $rental->waktu_pinjam }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Pengembalian:</span>
                                    {{ $rental->waktu_pengembalian }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Total Harga:</span> Rp
                                    {{ $rental->total_harga }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Status:</span>
                                    <span
                                        class="px-2 py-1 font-semibold rounded transition-colors duration-300 text-pink-400">
                                        Waiting Confirmation
                                    </span>
                                </p>
                                @php
                                    $bayar = $paymentNew->where('rental_id', $rental->id);
                                @endphp
                                @foreach ($bayar as $b)
                                    <a href="{{ route('payment.showPay', $b) }}">
                                        <button type="submit"
                                            class="mt-4 w-full bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">Lakukan
                                            pembayaran disini!</button>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($onRental->isempty())
        @else
            <div class="container mx-auto py-8">
                <h1 class="text-xl font-base mb-6 text-start font-semibold text-blue-600">Mobil yang sedang kamu rental<a
                        class="text-purple-500 font-bold" href=""> ></a></h1>
                <div class="w-full h-auto overflow-x-auto">

                    <div id="noDataMessage" class="hidden text-center text-gray-600 text-lg font-semibold py-4">
                        Belum ada rental apapun.
                    </div>

                    <div id="cardContainer"
                        class="flex gap-4 overflow-x-scroll scrollbar-thin scrollbar-thumb-purple-200 scrollbar-track-white">
                        @foreach ($onRental as $rental)
                            <div
                                class="min-w-[300px] p-4 bg-white border rounded shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                                <img src="{{ asset('storage/' . $rental->product->image) }}"
                                    alt="{{ $rental->product->name }}" class="w-full h-48 object-cover rounded mb-4">
                                <h2 class="text-lg font-bold mb-2 text-purple-800">{{ $rental->name }}</h2>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Rental:</span>
                                    {{ $rental->waktu_pinjam }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Pengembalian:</span>
                                    {{ $rental->waktu_pengembalian }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Total Harga:</span> Rp
                                    {{ $rental->total_harga }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Status:</span>
                                    <span
                                        class="px-2 py-1 font-semibold rounded transition-colors duration-300 text-blue-500">
                                        On Rental
                                    </span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($waitingPengembalian->isempty())
        @else
            <div class="container mx-auto py-8">
                <h1 class="text-xl font-base mb-6 text-start text-gray-600">Ayo segera kembalikan mobil yang kamu rental!<a
                        class="text-purple-500 font-bold" href=""> ></a></h1>
                <div class="w-full h-auto overflow-x-auto">

                    <div id="noDataMessage" class="hidden text-center text-gray-600 text-lg font-semibold py-4">
                        Belum ada rental apapun.
                    </div>

                    <div id="cardContainer"
                        class="flex gap-4 overflow-x-scroll scrollbar-thin scrollbar-thumb-purple-200 scrollbar-track-white">
                        @foreach ($waitingPengembalian as $rental)
                            <div
                                class="min-w-[300px] p-4 bg-white border rounded shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                                <img src="{{ asset('storage/' . $rental->product->image) }}"
                                    alt="{{ $rental->product->name }}" class="w-full h-48 object-cover rounded mb-4">
                                <h2 class="text-lg font-bold mb-2 text-purple-800">{{ $rental->name }}</h2>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Rental:</span>
                                    {{ $rental->waktu_pinjam }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Pengembalian:</span>
                                    {{ $rental->waktu_pengembalian }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Total Harga:</span> Rp
                                    {{ $rental->total_harga }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Status:</span>
                                    <span class="px-2 py-1 font-bold rounded transition-colors duration-300 text-red-500">
                                        Menunggu Pengembalian!
                                    </span>
                                </p>
                                @if($rental)
                                    <a href="{{ route('return.show', $rental->id) }}">
                                        <button type="submit"
                                            class="mt-4 w-full bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">Lakukan
                                            pengembalian disini!</button>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($waitingReturnConf->isempty())
        @else
            <div class="container mx-auto py-8">
                <h1 class="text-xl font-base mb-6 text-start text-gray-600">Menunggu Konfirmasi return dari Admin, Mohon ditunggu!<a
                        class="text-purple-500 font-bold" href=""> ></a></h1>
                <div class="w-full h-auto overflow-x-auto">

                    <div id="noDataMessage" class="hidden text-center text-gray-600 text-lg font-semibold py-4">
                        Belum ada rental apapun.
                    </div>

                    <div id="cardContainer"
                        class="flex gap-4 overflow-x-scroll scrollbar-thin scrollbar-thumb-purple-200 scrollbar-track-white">
                        @foreach ($waitingReturnConf as $rental)
                            <div
                                class="min-w-[300px] p-4 bg-white border rounded shadow transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                                <img src="{{ asset('storage/' . $rental->product->image) }}"
                                    alt="{{ $rental->product->name }}" class="w-full h-48 object-cover rounded mb-4">
                                <h2 class="text-lg font-bold mb-2 text-purple-800">{{ $rental->name }}</h2>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Rental:</span>
                                    {{ $rental->waktu_pinjam }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Waktu Pengembalian:</span>
                                    {{ $rental->waktu_pengembalian }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Total Harga:</span> Rp
                                    {{ $rental->total_harga }}</p>
                                <p class="mb-1"><span class="font-bold text-purple-700">Status:</span>
                                    <span
                                        class="px-2 py-1 font-semibold rounded transition-colors duration-300 text-yellow-500">
                                        Menunggu Konfirmasi Return dari Admin
                                    </span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif


        <p class="text-sm mt-24">
            Author : <span class="text-purple-500 font-semibold">Penantian Salvador Dali</span><br>
            Kelas : <span class="text-purple-500 font-semibold">XII RPL 1</span>
        </p>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const cardContainer = document.getElementById('cardContainer');
            const noDataMessage = document.getElementById('noDataMessage');

            if (cardContainer.children.length === 0) {
                noDataMessage.classList.remove('hidden');
            } else {
                noDataMessage.classList.add('hidden');
            }

            const cards = document.querySelectorAll('.min-w-[300px]');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });


        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.hidden-card');
            cards.forEach((card, i) => {
                setTimeout(() => {
                    card.classList.remove('hidden-card');
                    card.classList.add('visible-card');
                }, i * 200);
            });
        });
    </script>
@endsection
