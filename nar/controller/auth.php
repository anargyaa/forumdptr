<?php 

	if (isset($_POST['reg'])) {
		if ($stmt = $conn->prepare("SELECT id_user,password FROM user WHERE email = ?")) {
			$stmt->bind_param('s', $_POST['email']);
			$stmt->execute();

			$stmt->store_result();
			
			if ($stmt->num_rows > 0) {
				$stmt->bind_result($id, $password);
				$stmt->fetch();

				if (password_verify($_POST['password'], $password)) {
					session_regenerate_id();
					$_SESSION['status'] = TRUE;
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['nama_lengkap'] = $_POST['nama_lengkap'];
					$_SESSION['id_user'] = $id;
					echo "Selamat Datang" . $_SESSION['nama_lengkap'] . "!";
					header('Location: ../home.php');
				} else {
					echo "Email atau Password Salah";
					header('Location: ../login.php');
				}
			} else {
				echo "Email atau Password Salah";
				header('Location: ../login.php');
			}

			$stmt->close();

		}

	}

?>