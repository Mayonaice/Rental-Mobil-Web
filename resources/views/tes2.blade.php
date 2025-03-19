<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tab Grid Animasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex p-10">
    <div class="container mx-auto opacity-0 transition-opacity duration-1000" id="tableContainer">
        <h1 class="text-2xl font-bold mb-4 text-purple-700">Simple Table</h1>
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

            <!-- Approved Tab -->
            <div class="hidden grid grid-cols-3 gap-4 opacity-0 transition-opacity duration-700 ease-in-out" id="approved">
                <table class="w-full bg-white border border-gray-200 rounded-lg table-auto">
                    <thead>
                        <tr class="bg-purple-200">
                            <th class="py-2 px-4 border-b text-purple-800">Name</th>
                            <th class="py-2 px-4 border-b text-purple-800">Age</th>
                            <th class="py-2 px-4 border-b text-purple-800">Email</th>
                            <th class="py-2 px-4 border-b text-purple-800">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b text-gray-700">Saya</td>
                            <td class="py-2 px-4 border-b text-gray-700">27</td>
                            <td class="py-2 px-4 border-b text-gray-700">saya@example.com</td>
                            <td class="py-2 px-4 border-b">
                                <button onclick="showImage('{{ asset('/images/aa.jpg') }}')" class="bg-purple-500 text-white px-4 py-1 rounded">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Waiting Tab (Default Active) -->
            <div class="grid grid-cols-3 gap-4 opacity-100 transition-opacity duration-700 ease-in-out" id="waiting">
                <table class="w-full bg-white border border-gray-200 rounded-lg table-auto">
                    <thead>
                        <tr class="bg-purple-200">
                            <th class="py-2 px-4 border-b text-purple-800">Name</th>
                            <th class="py-2 px-4 border-b text-purple-800">Age</th>
                            <th class="py-2 px-4 border-b text-purple-800">Email</th>
                            <th class="py-2 px-4 border-b text-purple-800">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b text-gray-700">John Doe</td>
                            <td class="py-2 px-4 border-b text-gray-700">28</td>
                            <td class="py-2 px-4 border-b text-gray-700">john@example.com</td>
                            <td class="py-2 px-4 border-b">
                                <button onclick="showImage('{{ asset('/images/aa.jpg') }}')" class="bg-purple-500 text-white px-4 py-1 rounded">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Gambar -->
    <div class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-60 flex items-center justify-center" id="imageModal">
        <div class="bg-white p-5 rounded-lg max-w-3xl relative overflow-auto" style="max-height: 90%; max-width: 90%;">
            <span class="absolute top-0 right-0 text-3xl cursor-pointer text-purple-500" onclick="closeModal()">&times;</span>
            <img src="" alt="Profile Image" id="modalImage" class="w-full rounded-lg">
        </div>
    </div>

    <script>
        const buttons = document.querySelectorAll('.tab-button');
        const contents = document.querySelectorAll('.grid');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const tab = this.dataset.tab;

                // Reset semua tombol
                buttons.forEach(btn => {
                    btn.classList.remove('bg-purple-700', 'text-white');
                    btn.classList.add('bg-white', 'text-purple-700');
                });

                // Sembunyikan semua tab
                contents.forEach(content => {
                    content.classList.add('hidden', 'opacity-0');
                });

                // Tampilkan tab yang aktif
                const activeTab = document.getElementById(tab);
                activeTab.classList.remove('hidden');
                setTimeout(() => activeTab.classList.remove('opacity-0'), 10);

                // Gaya tombol aktif
                this.classList.add('bg-purple-700', 'text-white');
            });
        });

        // Default: Tab Waiting Approval aktif saat load
        window.addEventListener('load', () => {
            const tableContainer = document.getElementById('tableContainer');
            const defaultButton = document.querySelector('button[data-tab="waiting"]');
            const defaultTab = document.getElementById('waiting');

            // Animasi dan status awal
            tableContainer.classList.remove('opacity-0');
            tableContainer.classList.add('opacity-100');
            defaultButton.classList.add('bg-purple-700', 'text-white');
            defaultTab.classList.remove('hidden', 'opacity-0');
        });
    </script>
</body>
</html>
