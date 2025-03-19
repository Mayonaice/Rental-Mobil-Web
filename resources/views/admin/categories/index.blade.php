

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
                    Kategori
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
                            <span class="mr-3 font-semibold text-dark">List Kategori</span>
                        </h3>
                        <div class="relative flex flex-wrap items-center my-2">
                            <a href="{{ route('categories.create') }}"
                                class="inline-block text-[.925rem] font-medium leading-normal text-center align-middle cursor-pointer rounded-2xl transition-colors duration-150 ease-in-out text-light-inverse bg-light-dark border-light shadow-none border-0 py-2 px-5 hover:bg-secondary active:bg-light focus:bg-light">
                                Tambah Kategori Baru</a>
                        </div>
                    </div>

                    @foreach ($categories as $category)
                        <div class="flex-auto block py-8 pt-6 px-9">
                            <div class="overflow-x-auto">
                                <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                    <thead class="align-bottom">
                                        <tr class="font-semibold sm:text-[0.7rem] lg:text-[0.95rem]  text-secondary-dark">
                                            <th class="pb-3 text-center ">Nama Kategori</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-dashed last:border-b-0">
                                            
                                            <td class="p-3 pr-0 text-center">
                                                <span
                                                    class="font-semibold text-light-inverse sm:text-[0.8rem] lg:text-[1.2rem] text-md/normal">{{ $category->name }}</span>
                                            </td>
                                            <td class="ps-16">
                                                <a href="{{ route('categories.edit', $category) }}">
                                                    <button
                                                        class="relative lg:px-4 lg:py-2 sm:px-3 sm:py-2 font-semibold sm:text-[0.6rem] lg:text-lg text-white bg-gradient-to-r from-blue-500 via-cyan-500 to-cyan-300 rounded-lg shadow-lg hover:scale-105 transition-transform"
                                                        style="animation: pulseGlow 2s infinite;">
                                                        Edit
                                                    </button></a>
                                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
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

