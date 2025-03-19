@extends('user.layout')

<head> 
    <style>
        /* Kartu dengan transisi dan bayangan default */
        .product-card {
          transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
    
        /* Animasi fade-in */
        .fade-in {
          opacity: 0;
          transform: translateY(20px);
          transition: opacity 0.5s, transform 0.5s;
        }
    
        .fade-in.show {
          opacity: 1;
          transform: translateY(0);
        }
      </style>
</head>

@section('content')
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
                    Mobil
                </a>
            </li>
        </ol>
    </nav>

    
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 ml-12">Mobil</h1>
        
        
        <!-- Grid Wrapper -->
        <div id="product-grid" class="grid grid-cols-1 sm:m-6 md:m-4 lg:m-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 sm:gap-8 lg:gap-10">
            @foreach ($mobil as $m)
          <!-- Repeatable Product Card -->
          <div class="product-card fade-in bg-white shadow-md rounded-lg overflow-hidden">
            <img src="{{ asset('storage/' . $m->image) }}" alt="Product Image" class="w-full h-48 object-cover" />
            <div class="p-4">
              <h2 class="text-lg font-semibold text-gray-800">{{$m->nama_mobil}}</h2>
              <h4 class="text-base font-medium text-gray-800">{{$m->category->name}}</h4>
              <h6 class="text-small font-normal text-gray-600 mt-1">{{$m->tahun}}</h6>
              <p class="text-gray-600 mt-2">Rp. {{ number_format($m->harga_sewa) }} / Hari</p>
              <a href="{{ route('rental.create', $m)}}">
              <button
                class="mt-4 w-full bg-purple-500 text-white py-2 px-4 rounded hover:bg-purple-600 transition"
              >
                Rental
              </button>
            </a>
            </div>
          </div>
        @endforeach
          </div>
      </div>

      <script>

        const showCardsWithAnimation = () => {
          const cards = document.querySelectorAll('.fade-in');
          cards.forEach((card, index) => {
            setTimeout(() => {
              card.classList.add('show');
            }, index * 200); 
          });
        };

        const handleHover = (event) => {
          const card = event.currentTarget;

          card.style.transform = 'scale(1.1)';
          card.style.boxShadow = '0px 15px 25px rgba(0, 0, 0, 0.3)';

          card.style.transition = 'transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out';
        };

        const handleMouseLeave = (event) => {
          const card = event.currentTarget;

          card.style.transform = 'scale(1)';
          card.style.boxShadow = '0px 4px 6px rgba(0, 0, 0, 0.1)';
        };

        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
          card.addEventListener('mouseenter', handleHover);
          card.addEventListener('mouseleave', handleMouseLeave);
        });

        window.addEventListener('DOMContentLoaded', showCardsWithAnimation);
      </script>
@endsection
