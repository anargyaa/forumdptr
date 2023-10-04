<?php
// Koneksi ke database MySQL
$mysqli = new mysqli("localhost", "root", "", "forum");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Ambil data dari form
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$kategori = $_POST['kategori'];

// Loop melalui setiap file yang diunggah
foreach ($_FILES['file']['name'] as $key => $name) {
    $file_name = $_FILES['file']['name'][$key];
    $file_tmp = $_FILES['file']['tmp_name'][$key];

    // Simpan file ke direktori server
    $upload_dir = "uploads/";
    move_uploaded_file($file_tmp, $upload_dir . $file_name);

    // Masukkan data ke dalam tabel database
    $query = "INSERT INTO topik (judul_topik, isi_topik, nama_file) VALUES ('$judul', '$isi', '$file_name')";
    $mysqli->query($query);
}

// Tutup koneksi ke database
$mysqli->close();

// Redirect ke halaman lain setelah upload
header("Location: sukses.php");
?>

<!-- MENYIMPAN DIKEDUA TABLE YAITU TABLE TOPIK DAN FILE_TOPIK -->
<?php
// Koneksi ke database MySQL
$host = 'localhost';
$username = 'username_db'; // Ganti dengan username MySQL Anda
$password = 'password_db'; // Ganti dengan password MySQL Anda
$database = 'nama_database'; // Ganti dengan nama database Anda

$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Mengambil data dari formulir
$judul = $_POST['judul'];
$isi = $_POST['isi'];
$kategori = $_POST['kategori'];

// Menyimpan data topik ke dalam tabel "topik"
$queryInsertTopik = "INSERT INTO topik (judul, isi, kategori, tanggal_dibuat) VALUES ('$judul', '$isi', '$kategori', NOW())";

if (mysqli_query($koneksi, $queryInsertTopik)) {
    // Mengambil ID topik yang baru saja dibuat
    $idTopikBaru = mysqli_insert_id($koneksi);

    // Menyimpan data file jika ada
    if (!empty($_FILES['file']['name'])) {
        $namaFile = $_FILES['file']['name'];
        $ukuranFile = $_FILES['file']['size'];
        $tipeFile = $_FILES['file']['type'];
        $lokasiSementara = $_FILES['file']['tmp_name'];

        // Direktori penyimpanan file (ganti dengan direktori yang sesuai)
        $direktoriTujuan = "uploads/";

        // Pindahkan file dari lokasi sementara ke direktori tujuan
        if (move_uploaded_file($lokasiSementara, $direktoriTujuan . $namaFile)) {
            // Simpan data file ke dalam tabel "file_topik"
            $queryInsertFile = "INSERT INTO file_topik (id_topik, nama_file, tipe_file, ukuran_file, path_file) VALUES ('$idTopikBaru', '$namaFile', '$tipeFile', '$ukuranFile', '$direktoriTujuan$namaFile')";

            if (mysqli_query($koneksi, $queryInsertFile)) {
                echo "Data topik dan file berhasil disimpan.";
            } else {
                echo "Error: " . $queryInsertFile . "<br>" . mysqli_error($koneksi);
            }
        } else {
            echo "File gagal diunggah.";
        }
    } else {
        echo "Data topik berhasil disimpan tanpa file.";
    }
} else {
    echo "Error: " . $queryInsertTopik . "<br>" . mysqli_error($koneksi);
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>

<!-- MULTIPLE HANDLER -->
<?php
// ...

// Menyimpan data file jika ada
if (!empty($_FILES['file']['name'][0])) {
    $totalFiles = count($_FILES['file']['name']);
    $uploadedFiles = 0;

    for ($i = 0; $i < $totalFiles; $i++) {
        $namaFile = $_FILES['file']['name'][$i];
        $ukuranFile = $_FILES['file']['size'][$i];
        $tipeFile = $_FILES['file']['type'][$i];
        $lokasiSementara = $_FILES['file']['tmp_name'][$i];

        // Direktori penyimpanan file (ganti dengan direktori yang sesuai)
        $direktoriTujuan = "uploads/";

        // Pindahkan file dari lokasi sementara ke direktori tujuan
        if (move_uploaded_file($lokasiSementara, $direktoriTujuan . $namaFile)) {
            // Simpan data file ke dalam tabel "file_topik"
            $queryInsertFile = "INSERT INTO file_topik (id_topik, nama_file, tipe_file, ukuran_file, path_file) VALUES ('$idTopikBaru', '$namaFile', '$tipeFile', '$ukuranFile', '$direktoriTujuan$namaFile')";

            if (mysqli_query($koneksi, $queryInsertFile)) {
                $uploadedFiles++;
            } else {
                echo "Error: " . $queryInsertFile . "<br>" . mysqli_error($koneksi);
            }
        } else {
            echo "File gagal diunggah.";
        }
    }

    if ($uploadedFiles === $totalFiles) {
        echo "Data topik dan file berhasil disimpan.";
    } else {
        echo "Gagal mengunggah beberapa file.";
    }
} else {
    echo "Data topik berhasil disimpan tanpa file.";
}

// ...
?>

<?php
// Fungsi untuk menghasilkan nama unik untuk setiap berkas yang diunggah
function generateUniqueFileName($originalName) {
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    $filenameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
    $uniqueName = $filenameWithoutExtension . '_' . uniqid() . '.' . $extension;
    return $uniqueName;
}

// Lokasi folder tempat berkas akan disimpan
$uploadDirectory = 'uploads/';

// Pastikan folder uploads sudah ada atau buat jika belum ada
if (!file_exists($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judulDiskusi = $_POST['judul_diskusi']; // Ambil judul diskusi dari formulir
    $isiDiskusi = $_POST['isi_diskusi']; // Ambil isi diskusi dari formulir
    $kategoriDiskusi = $_POST['kategori_diskusi']; // Ambil kategori diskusi dari formulir

    $files = $_FILES['file'];
    $uploadedFileNames = array(); // Inisialisasi array untuk nama-nama berkas

    // Loop melalui berkas yang diunggah
    foreach ($files['tmp_name'] as $key => $tempName) {
        if (!empty($tempName)) {
            $originalName = $files['name'][$key];
            $uniqueName = generateUniqueFileName($originalName);
            $uploadLocation = $uploadDirectory . $uniqueName;

            if (move_uploaded_file($tempName, $uploadLocation)) {
                // Berkas berhasil diunggah
                echo 'Berkas ' . $originalName . ' berhasil diunggah dengan nama ' . $uniqueName . '<br>';
                // Tambahkan nama berkas ke dalam array
                $uploadedFileNames[] = $uniqueName;
            } else {
                // Gagal mengunggah berkas
                echo 'Gagal mengunggah berkas ' . $originalName . '<br>';
            }
        }
    }

    // Konversi array dari nama berkas ke dalam format JSON
    $fileNamesJSON = json_encode($uploadedFileNames);

    // Simpan $fileNamesJSON ke dalam database atau tempat penyimpanan yang sesuai
    // Misalnya, Anda dapat menggunakan MySQL untuk menyimpannya dalam kolom VARCHAR atau TEXT

    // Simpan data diskusi ke database atau tempat penyimpanan yang sesuai di sini
}
?>

<!-- MENAMPILKAN NAMA FILE -->
<?php
// Array yang berisi nama-nama file
$nama_file = array("file1.jpg", "file2.pdf", "file3.txt");

// Mengonversi array ke dalam format JSON
$json_nama_file = json_encode($nama_file);

// Menampilkan hasil JSON
echo $json_nama_file;
?>