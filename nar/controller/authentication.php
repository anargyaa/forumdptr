<?php

include 'koneksion.php';
session_start();

if (isset($_SESSION['status']) && $_SESSION['status'] === true) {
	header("location: index.php");
	exit;
}

$email = $password = "";
$email_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty(trim($_POST['email']))) {
		$email_err = "Tolong masukan email!";
	} else {
		$email = trim($_POST['email']);
	}

	if (empty(trim($_POST['password']))) {
		$password_err = "Tolong masukan password!";
	} else {
		$password = trim($_POST['password']);
	}

	if (empty($email_err) && empty($password_err)) {
		$stmt = "SELECT id_user, email, password FROM user WHERE email = ?";
		if ($stmt = mysqli_prepare($conn, $stmt)) {
			mysqli_stmt_bind_param($stmt, "s", $param_email);
			$param_email = $email;

			if (mysqli_stmt_execute($stmt)) {
				mysqli_stmt_store_result($stmt);
				if (mysqli_stmt_num_rows($stmt) == 1) {
					mysqli_stmt_bind_result($stmt, $id_user, $email, $hashed_password);
					if (mysqli_stmt_fetch($stmt)) {
						if (password_verify($password, $hashed_password)) {
							session_start();

							$_SESSION['status'] = true;
							$_SESSION['id_user'] = $id_user;
							$_SESSION['email'] = $email;

							header("location: ../index.php");
						} else {
							$login_err = "Email atau Password salah";	
							header("location: ../login.php");
						}
					}
				} else {
					$login_err = "Email atau Password salah";
					header("location: ../login.php");
				}
			} else {
				echo "ERROR 505";
				header("location: ../login.php");
			}
			mysqli_stmt_close($stmt);
		}
	}
	mysqli_close($conn);

}

?>