<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://kit.fontawesome.com/bb6d1abaef.js" crossorigin="anonymous"></script>
	<script>
	  tailwind.config = {
	    theme: {
	      extend: {
	        colors: {
	          aksenGray: '#6B7280',
	          aksenRed: '#EF4444',
	          aksenGreen: '#10B981',
	          primaryBlue: '#3B82F6',
	          primaryIndigo: '#071952',
	        }
	      }
	    }
	  }
	</script>
	<title>beranda</title>
</head>
<body class="bg-gradient-to-tr from-sky-400 via-sky-600 to-indigo-800">
	<?php include 'component/Navbar.php';?>
	
	<?php 
	if (isset($_GET['page'])) {
	if ($_GET['page'] == "beranda") {
		include 'component/Carousel.php';
		}
	} else {
		include 'component/Carousel.php';	
	}
	?>

	<div class="min-h-screen mx-0 md:mx-10 lg:mx-40">
		<?php 
		if(isset($_GET['page'])){
			$page = $_GET['page'];
	 
			switch ($page) {
				case 'beranda':
					include "beranda.php";
					break;
				case 'topik':
					include "topik.php";
					break;
				case 'post':
					include "post.php";
					break;
				case 'newpost':
					include "newpost.php";
					break;
				case 'kategori':
					include "kategori.php";
					break;
				case 'signup':
					include "signup.php";
					break;
				case 'signin':
					include "signin.php";
					break;
				case 'profile':
					include "profile.php";
					break;
				case 'logout':
					include "logout.php";
					break;			
				default:
					echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
					break;
			}
		}else{
			include "beranda.php";
		}
		?>
	</div>

	<?php include 'component/Footer.php' ?>	
</body>
</html>