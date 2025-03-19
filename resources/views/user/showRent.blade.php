<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mobil yang Sudah Dirental</title>
  <script src="https://cdn.tailwindcss.com"></script>
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
</head>
<body class="bg-gray-100 text-gray-800">

  <main class="container mx-auto py-8 px-4">
    <h2 class="text-3xl font-bold mb-6 text-center">Mobil yang Sudah Anda Rental</h2>

    @if ($getNewRentalbyUser && count($getNewRentalbyUser) > 0)
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" id="dataRental">
        @foreach ($getNewRentalbyUser as $rental)
        
          <div class="hidden-card bg-white shadow-md rounded-lg overflow-hidden">
            <img src="{{'storage/' .  $rental->product->image }}" alt="" class="w-full h-48 object-cover">
            <div class="p-4">
              <h3 class="text-xl font-semibold">{{ $rental->product->nama_mobil}}</h3>
              <p class="text-gray-600">Tanggal Rental: {{ $rental->waktu_pinjam}}</p>
              <p class="text-gray-600">Tanggal Pengembalian: {{ $rental->waktu_pengembalian }}</p>
              <p class="text-gray-600">Status: 
                <span class="{{ $rental->status === 'Dibayar' ? 'text-green-600' : 'text-red-600' }} font-semibold">
                  {{ $rental->status }}
                </span>
              </p>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-center text-gray-500">
        <p>Anda belum merental mobil apa pun.</p>
      </div>
    @endif
  </main>

  <!-- Footer -->
  <footer class="bg-blue-600 text-white py-4 mt-8">
    <div class="container mx-auto text-center">
      <p>&copy; 2024 Rental Mobil. All Rights Reserved.</p>
    </div>
  </footer>

  <!-- Script untuk Animasi -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const cards = document.querySelectorAll('.hidden-card');
      cards.forEach((card, i) => {
        setTimeout(() => {
          card.classList.remove('hidden-card');
          card.classList.add('visible-card');
        }, i * 200); // Animasi tiap kartu ditunda 200ms
      });
    });
  </script>
</body>
</html>
