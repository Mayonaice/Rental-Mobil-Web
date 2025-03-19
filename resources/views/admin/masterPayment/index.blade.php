@extends('layout')

@section('content')
    <nav class = "flex px-5 py-3 text-gray-700  rounded-lg bg-gray-50 dark:bg-[#1E293B] " aria-label="Breadcrumb">
        <ol class = "inline-flex items-center space-x-1 md:space-x-3">
            <li class = "inline-flex items-center">
                <a href="#"
                    class = "inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    <svg class="h-4 w-4 mr-2"  width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M10 13l2.538-.003c2.46 0 4.962-2.497 4.962-4.997 0-3-1.89-5-4.962-5H7c-.5 0-1 .5-1 1L4 18c0 .5.5 1 1 1h2.846L9 14c.089-.564.43-1 1-1zm7.467-5.837C19.204 8.153 20 10 20 12c0 2.467-2.54 4.505-5 4.505h.021-2.629l-.576 3.65a.998.998 0 01-.988.844l-2.712-.002a.5.5 0 01-.494-.578L7.846 19" /></svg>

                    Master Payment
                </a>
            </li>
        </ol>
    </nav>


    <div class="flex flex-wrap -mx-3 mb-5">
        <div class="w-full max-w-full px-3 mb-6  mx-auto">
            <div
                class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
                <div
                    class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                    <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                        <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
                            <span class="mr-3 font-semibold text-dark">List Metode Payment</span>
                        </h3>
                        <div class="relative flex flex-wrap items-center my-2">
                            <a href="{{ route('masterPayment.create') }}"
                                class="inline-block text-[.925rem] font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-150 ease-in-out text-light-inverse bg-light-dark border-light shadow-none border-0 py-2 px-5 hover:bg-secondary active:bg-light focus:bg-light">
                                Tambah Metode Payment Baru</a>
                        </div>
                    </div>

                    @foreach ($mspayment as $msp)
                        <div class="flex-auto block py-8 pt-6 px-9">
                            <div class="overflow-x-auto">
                                <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                    <thead class="align-bottom">
                                        <tr class="font-semibold sm:text-[0.7rem] lg:text-[0.95rem]  text-secondary-dark">
                                            <th class="pb-3 text-center ">Qr Code</th>
                                            <th class="pb-3 text-center ">Tipe Payment</th>
                                            <th class="pb-3 text-center ">Nama Akun</th>
                                            <th class="pb-3 text-center ">No Rek</th>
                                            <th class="pb-3 text-center sm:text-[0.7rem] lg:text-base">No Hp</th>
                                            <th class="pb-3 text-center ">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-dashed last:border-b-0">
                                            <td class="p-3 pl-0">
                                                <div class="flex">
                                                    <div class="content-center flex rounded-2xl">
                                                        <img src="{{ asset('storage/' . $msp->qrcode) }}"
                                                            class=" lg:w-[140px] lg:h-[140px] sm:w-[60px] sm:h-[60px] rounded-2xl"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-3 pr-0 text-center">
                                                <span
                                                    class="font-semibold text-light-inverse sm:text-[0.8rem] lg:text-[1.2rem] text-md/normal">{{ $msp->tipe_payment }}</span>
                                            </td>
                                            <td class="p-3 pr-0 text-center">
                                                <span
                                                    class="font-semibold text-light-inverse sm:text-[0.8rem] lg:text-[1.2rem] text-md/normal">{{ $msp->nama_akun }}</span>
                                            </td>
                                            <td class="p-3 pr-0 text-center">
                                                <span
                                                    class="font-semibold text-light-inverse sm:text-[0.8rem] lg:text-[1.2rem] text-md/normal">{{ $msp->no_rek }}</span>
                                            </td>
                                            <td class="p-3 pr-0 text-center">
                                                <span
                                                    class="font-semibold text-light-inverse sm:text-[0.8rem] lg:text-[1.2rem] text-md/normal">{{ $msp->no_hp }}</span>
                                            </td>
                                            <td class="ps-16">
                                                <a href="{{ route('masterPayment.edit', $msp) }}">
                                                    <button
                                                        class="relative lg:px-4 lg:py-2 sm:px-3 sm:py-2 font-semibold sm:text-[0.6rem] lg:text-lg text-white bg-gradient-to-r from-blue-500 via-cyan-500 to-cyan-300 rounded-lg shadow-lg hover:scale-105 transition-transform"
                                                        style="animation: pulseGlow 2s infinite;">
                                                        Edit
                                                    </button></a>
                                                <form action="{{ route('masterPayment.destroy', $msp) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="confirm('Anda yakin ini menghapus data ini?')"
                                                        class="relative lg:px-4 lg:py-2 sm:px-3 sm:py-2 font-semibold sm:text-[0.6rem] lg:text-lg text-white bg-gradient-to-r from-red-500 via-pink-500 to-pink-300 rounded-lg shadow-lg hover:scale-105 transition-transform"
                                                        style="animation: pulseGlow 2s infinite;">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
