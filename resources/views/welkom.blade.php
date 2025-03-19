<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>


    <div class="relative overflow-hidden bg-cover bg-no-repeat p-12 text-center h-screen"
        style="background-image: url('/images/neon.jpg');">
        <div class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-fixed"
            style="background-color: rgba(0, 0, 0, 0.6)">
            <div class="flex h-full items-center justify-center">
                <div class="text-white">
                    <h2 class="mb-4 text-4xl font-semibold">Welcome to Rental Mobil</h2>
                    <h4 class="mb-6 text-xl font-semibold">Website prototype yang memiliki fitur untuk merental mobil
                    </h4>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('home') }}">
                                <button type="button"
                                    class="rounded border-2  border-neutral-50 px-7 pb-[8px] pt-[10px] text-sm font-medium uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-neutral-100 hover:bg-neutral-300 hover:bg-opacity-10 hover:text-neutral-100 focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0 active:border-neutral-200 active:text-neutral-200 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                    data-twe-ripple-init data-twe-ripple-color="light">
                                    Go To Your Dashboard
                                </button>
                            </a>
                        @else
                            <a href="{{ url('login') }}">
                                <button type="button"
                                    class="rounded border-2  border-neutral-50 px-7 pb-[8px] pt-[10px] text-sm font-medium uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-neutral-100 hover:bg-neutral-300 hover:bg-opacity-10 hover:text-neutral-100 focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0 active:border-neutral-200 active:text-neutral-200 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                    data-twe-ripple-init data-twe-ripple-color="light">
                                    Login
                                </button>
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ url('register') }}">
                                    <button type="button"
                                        class="rounded border-2  border-neutral-50 px-7 pb-[8px] pt-[10px] text-sm font-medium uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-neutral-100 hover:bg-neutral-300 hover:bg-opacity-10 hover:text-neutral-100 focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0 active:border-neutral-200 active:text-neutral-200 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                        data-twe-ripple-init data-twe-ripple-color="light">
                                        Register
                                    </button>
                                </a>
                            @endif
                        @endauth
                    @endif

                </div>
            </div>
        </div>
    </div>

    

</body>

</html>
