SUDAH BISAAA !!!

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.8.3/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-control">
            <label class="label">
                <span class="label-text">Judul diskusi anda</span>
            </label>
            <input type="text" name="judul" placeholder="Rekomendasi makanan untuk sarapan" class="input input-bordered w-full" />
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Isi diskusi anda</span>
            </label>
            <textarea name="isi" class="textarea textarea-bordered h-24 resize-none" placeholder="Simple pastry"></textarea>
        </div>
        <div class="form-control">
            <label class="label">
                <span class="label-text">Pilih kategori diskusi anda</span>
            </label>    
            <select name="kategori" class="select select-bordered w-full">
                <option disabled selected>Pilih salah satu</option>
                <option value="Kategori 1">Kategori 1</option>
                <option value="Kategori 2">Kategori 2</option>
                <option value="Kategori 3">Kategori 3</option>
            </select>
        </div>
        <div>
            <div class="max-w-xl drop-zone">
                <label class="label">
                    <span class="label-text">Upload File</span>
                </label>
                <label class="flex justify-center w-full h-12 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                    <span class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <span class="font-medium text-gray-600">
                            Drop files to Attach, or
                            <span class="text-blue-600 underline">browse</span>
                        </span>
                    </span>
                    <input type="file" name="file[]" multiple class="file-input hidden">
                </label>
            </div>
            <div class="mt-4" id="progress-container">
                <!-- Daftar file yang akan diupload -->
                <div id="fileList" class="mt-4"></div>
            </div>
        </div>

        <br>
        <button type="submit" class="btn">Posting</button>
    </form>

    <script>
        // Fungsi untuk menghitung ukuran file dengan format yang tepat
        function formatBytes(bytes) {
            if (bytes === 0) return '0 Bytes';

            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));

            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Fungsi untuk menampilkan file yang akan diupload
        function displayFile(file) {
            const fileList = document.getElementById('fileList');

            // Membuat elemen div untuk file yang akan diupload
            const fileCard = document.createElement('div');
            fileCard.classList.add('file-card', 'bg-white', 'rounded-lg', 'shadow', 'p-[12px]', 'flex', 'justify-between', 'items-center', 'mb-2', 'w-full');
            fileList.appendChild(fileCard);

            // Menampilkan nama file dalam kartu
            const fileNameElement = document.createElement('div');
            fileNameElement.innerHTML = `<i class="fa fa-file pr-2"></i> <span class="name">${file.name}</span>`;
            fileCard.appendChild(fileNameElement);

            // Menampilkan progress bar dalam kartu
            const progressBarContainer = document.createElement('div');
            progressBarContainer.classList.add('progress-bar-container');
            fileCard.appendChild(progressBarContainer);

            const progressBar = document.createElement('div');
            progressBar.classList.add('progress-bar');
            progressBarContainer.appendChild(progressBar);

            // Menampilkan ukuran file dalam kartu
            const fileSizeElement = document.createElement('div');
            fileSizeElement.textContent = `Size: ${formatBytes(file.size)}`;
            fileCard.appendChild(fileSizeElement);

            return progressBar;
        }

        // Menangani peristiwa drag dan drop
        const dropZone = document.querySelector('.drop-zone');
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-blue-500');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-blue-500');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-blue-500');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                for (const file of files) {
                    // Menampilkan file yang akan diupload
                    const progressBar = displayFile(file);

                    // Upload file menggunakan XMLHttpRequest (gantilah dengan logika upload Anda)
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'upload.php');
                    xhr.upload.addEventListener('progress', (event) => {
                        if (event.lengthComputable) {
                            const percent = Math.round((event.loaded / event.total) * 100);
                            progressBar.style.width = percent + '%';
                        }
                    });

                    xhr.onreadystatechange = () => {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Handle response from the server here
                            console.log('File uploaded successfully');
                        }
                    };

                    const formData = new FormData();
                    formData.append('file[]', file);
                    xhr.send(formData);
                }
            }
        });

        // Menangani peristiwa pemilihan file
        const fileInput = document.querySelector('.file-input');
        fileInput.addEventListener('change', () => {
            const files = fileInput.files;
            if (files.length > 0) {
                for (const file of files) {
                    // Menampilkan file yang akan diupload
                    const progressBar = displayFile(file);

                    // Upload file menggunakan XMLHttpRequest (gantilah dengan logika upload Anda)
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'upload.php');
                    xhr.upload.addEventListener('progress', (event) => {
                        if (event.lengthComputable) {
                            const percent = Math.round((event.loaded / event.total) * 100);
                            progressBar.style.width = percent + '%';
                        }
                    });

                    xhr.onreadystatechange = () => {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Handle response from the server here
                            console.log('File uploaded successfully');
                        }
                    };

                    const formData = new FormData();
                    formData.append('file[]', file);
                    xhr.send(formData);
                }
            }
        });
    </script>
</body>
</html>
