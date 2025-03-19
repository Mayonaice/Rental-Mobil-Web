@extends('layout')

@section('content')
    <style>
        .fade-in {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .fade-in.visible {
            opacity: 1;
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
        <div class="text-3xl font-semibold mt-6">
            Kamu Masuk Sebagai <span class="text-purple-500 font-bold">Admin</span>
        </div>

        

       

        <p class="text-sm mt-2">
            Author : <span class="text-purple-500 font-semibold">Penantian Salvador Dali</span><br>
            Kelas : <span class="text-purple-500 font-semibold">XII RPL 1</span>
        </p>
    </div>


    <script>
        window.addEventListener('load', () => {
            document.getElementById('tableContainer').classList.add('visible');
        });
    </script>
@endsection
