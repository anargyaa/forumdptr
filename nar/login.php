<?php

session_start();
if (isset($_SESSION['status'])) {
	header('Location: index.php');
	exit;
}
?>

<!DOCTYPE html>
<html data-theme="corporate">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.8.2/dist/full.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>

	<script>
	    tailwind.config = {
	    	theme: {
	        	extend: {
	          	colors: {
	            	'red': '#EB5353',
				    'green': '#F9D923',
				    'yellow': '#36AE7C',
				    'primaryblue': '#1E3A8A',
				    'secondaryblue': '#279EFF'
	          		}
	        	}
	      	}
	    }
	 </script>

	<title>Beranda</title>
</head>
<body class="bg-gradient-to-bl from-blue-800 via-sky-600 to-sky-300 h-full">
	<div class="sticky top-0">
		<?php include 'component/Navbar.php'; ?>
	</div>

	<div class="w-full flex justify-center">
		<?php include 'component/Carousel.php'; ?>
	</div>

	<div class="w-full flex justify-center">
		<form action="controller/auth.php" method="post" class="bg-primaryblue p-4 rounded flex flex-col gap-4">
<!-- 			<input class="input w-full max-w-xs" type="text" name="nama_lengkap" value="" placeholder="John Doe">
			<input class="input w-full max-w-xs" type="text" name="jabatan" value="" placeholder="SEO">
			<input class="input w-full max-w-xs" type="number" name="no_tlpn" value="" placeholder="08xxx"> -->
			<input class="input w-full max-w-xs" type="email" name="email" value="" placeholder="example@gmail.com">
			<input id="pw" class="input w-full max-w-xs" type="password" name="password" value="" placeholder="Password">
			<!-- <input id="cpw" class="input w-full max-w-xs" type="password" name="cpassword" value="" placeholder="Confirmation Password"> -->
			<button class="btn btn-outline bg-secondaryblue" value="reg">GO</button>
		</form>
	</div>

	<!-- <script type="text/javascript">
            window.onload = function () {
                document.getElementById("pw").onchange = validatePassword;
                document.getElementById("cpw").onchange = validatePassword;
            }
            function validatePassword(){
                var pass2=document.getElementById("cpw").value;
                var pass1=document.getElementById("pw").value;
                if(pass1!=pass2)
                    document.getElementById("cpw").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
                else
                    document.getElementById("cpw").setCustomValidity('');
            }
        </script> -->
</body>
</html>