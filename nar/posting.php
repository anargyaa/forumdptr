<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.8.3/dist/full.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>

	<title></title>
</head>
<body>
	<div class="flex justify-center items-center h-screen w-screen">
		<form action="" method="post" class="bg-slate-100 shadow-xl h-fit w-3/12 p-4 rounded-xl">
			<div class="form-control">
			  	<label class="label">
			    	<span class="label-text">Judul diskusi anda</span>
			  	</label>
		    <input type="text" placeholder="Rekomendasi makanan untuk sarapan" class="input input-bordered w-full" />
			</div>
			<div class="form-control">
				<label class="label">
			    	<span class="label-text">Isi diskusi anda</span>
			    </label>
				<textarea class="textarea textarea-bordered h-24 resize-none" placeholder="Simple pastry"></textarea>
			</div>
			<div class="form-control">
			  	<label class="label">
				    <span class="label-text">Pilih kategori diskusi anda</span>
			  	</label>	
			  	<select class="select select-bordered w-full">
				    <option disabled selected>Pilih salah satu</option>
				    <option>Kategori 1</option>
				    <option>Kategori 2</option>
				    <option>Kategori 3</option>
			  	</select>
			</div>
			<!-- <div class="max-w-xl">
				<label class="label">
			    	<span class="label-text">Upload File</span>
			  	</label>
			    <label
			        class="flex justify-center w-full h-12 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
			        <span class="flex items-center space-x-2">
			            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24"
			                stroke="currentColor" stroke-width="2">
			                <path stroke-linecap="round" stroke-linejoin="round"
			                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
			            </svg>
			            <span class="font-medium text-gray-600">
			                Drop files to Attach, or
			                <span class="text-blue-600 underline">browse</span>
			            </span>
			        </span>
			        <input type="file" name="file" class="file-input hidden">
			    </label>
			<section class="progress-area"></section>
			<section class="uploaded-area"></section>
			</div> -->
			<label class="label">
			    <span class="label-text">Upload file</span>
		  	</label>
			<input type="file" name="file" multiple id="file" class="file-input w-full">

			<br>
			<button class="btn">Posting</button>
		</form>
	</div>

	<script src="https://kit.fontawesome.com/bb6d1abaef.js" crossorigin="anonymous"></script>
	<script src="script.js"></script>
	<script type="text/javascript" charset="utf-8" async defer>
		const fileInputs = document.getElementById('file');
		fileInputs.onchange = () => {
		  const selectedFiles = [...fileInputs.files];
		  console.log(selectedFiles);
		  console.log({selectedFiles.name});
		}
	</script>
</body>
</html>