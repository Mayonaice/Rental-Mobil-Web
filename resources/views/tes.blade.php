<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }
        .fade-in.visible {
            opacity: 1;
        }
        .hidden {
            display: none;
        }
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            position: relative;
            max-width: 90%;
            max-height: 90%;
            overflow: auto;
        }
        .modal img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
        }
        .close-btn {
            position: absolute;
            top: -14px;
            right: -5px;
            font-size: 30px;
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-gray-100 p-10">
    <div class="container mx-auto fade-in" id="tableContainer">
        <h1 class="text-2xl font-bold mb-4 text-purple-700">Simple Table</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-purple-200">
                        <th class="py-2 px-4 border-b text-navy-800">Name</th>
                        <th class="py-2 px-4 border-b text-navy-800">Age</th>
                        <th class="py-2 px-4 border-b text-navy-800">Email</th>
                        <th class="py-2 px-4 border-b text-navy-800">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b text-navy-700">John Doe</td>
                        <td class="py-2 px-4 border-b text-navy-700">28</td>
                        <td class="py-2 px-4 border-b text-navy-700">john@example.com</td>
                        <td class="py-2 px-4 border-b">
                            <button onclick="showImage('{{ asset('/images/aa.jpg') }}')" class="bg-purple-500 text-white px-4 py-1 rounded">View</button>
                        </td>
                    </tr>
                    <tr class="bg-purple-50">
                        <td class="py-2 px-4 border-b text-navy-700">Jane Smith</td>
                        <td class="py-2 px-4 border-b text-navy-700">34</td>
                        <td class="py-2 px-4 border-b text-navy-700">jane@example.com</td>
                        <td class="py-2 px-4 border-b">
                            <button onclick="showImage('{{ asset('storage/images/jane.jpg') }}')" class="bg-purple-500 text-white px-4 py-1 rounded">View</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b text-navy-700">Mike Johnson</td>
                        <td class="py-2 px-4 border-b text-navy-700">45</td>
                        <td class="py-2 px-4 border-b text-navy-700">mike@example.com</td>
                        <td class="py-2 px-4 border-b">
                            <button onclick="showImage('{{ asset('storage/images/mike.jpg') }}')" class="bg-purple-500 text-white px-4 py-1 rounded">View</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="hidden modal" id="imageModal">
        <div class="modal-content">
            <span class="close-btn text-purple-500" onclick="closeModal()">&times;</span>
            <img src="" alt="Profile Image" id="modalImage">
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            document.getElementById('tableContainer').classList.add('visible');
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
</html>
