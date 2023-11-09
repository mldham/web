<?php
include 'connect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
}

$menu1 = isset($_POST['Menu1']) ? (int) $_POST['Menu1'] : 0;
$menu2 = isset($_POST['Menu2']) ? (int) $_POST['Menu2'] : 0;
$menu3 = isset($_POST['Menu3']) ? (int) $_POST['Menu3'] : 0;
$menu4 = isset($_POST['Menu4']) ? (int) $_POST['Menu4'] : 0;
$menu5 = isset($_POST['Menu5']) ? (int) $_POST['Menu5'] : 0;

$harga1 = 7000;
$harga2 = 12000;
$harga3 = 14000;
$harga4 = 5000;
$harga5 = 5000;

$jumlah1 = isset($_POST['Jumlah1']) ? (int) $_POST['Jumlah1'] : 0;
$jumlah2 = isset($_POST['Jumlah2']) ? (int) $_POST['Jumlah2'] : 0;
$jumlah3 = isset($_POST['Jumlah3']) ? (int) $_POST['Jumlah3'] : 0;
$jumlah4 = isset($_POST['Jumlah4']) ? (int) $_POST['Jumlah4'] : 0;
$jumlah5 = isset($_POST['Jumlah5']) ? (int) $_POST['Jumlah5'] : 0;

$total1 = $harga1 * $jumlah1;
$total2 = $harga2 * $jumlah2;
$total3 = $harga3 * $jumlah3;
$total4 = $harga4 * $jumlah4;
$total5 = $harga5 * $jumlah5;


$totalMenu = $total1 + $total2 + $total3 + $total4 + $total5;

$alamat = isset($_POST['alamatkirim']) ? $_POST['alamatkirim'] : "";
$kurir = isset($_POST['kurir']) ? $_POST['kurir'] : "";

$biayaKurir = 0;

if ($kurir === "Gojek") {
    $biayaKurir = 12000;
} elseif ($kurir === "Grab") {
    $biayaKurir = 14000;
} elseif ($kurir === "Shopee") {
    $biayaKurir = 10000;
}

$metode = isset($_POST['payment']) ? $_POST['payment'] : "";

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $alamatkirim = filter_input(INPUT_POST, 'alamatkirim', FILTER_SANITIZE_STRING);
    // $kurir = filter_input(INPUT_POST, 'kurir', FILTER_SANITIZE_STRING);
    // $payment = filter_input(INPUT_POST, 'payment', FILTER_SANITIZE_STRING);

    $selected_products = [];

    if (isset($_POST['Menu1']) && $_POST['Menu1'] == 'Bakso Biasa') {
        $selected_products[] = 1;
    }

    if (isset($_POST['Menu2']) && $_POST['Menu2'] == 'Bakso Jumbo') {
        $selected_products[] = 2;
    }

    if (isset($_POST['Menu3']) && $_POST['Menu3'] == 'Bakso Urat') {
        $selected_products[] = 3;
    }

    if (isset($_POST['Menu4']) && $_POST['Menu4'] == 'Joshua') {
        $selected_products[] = 4;
    }

    if (isset($_POST['Menu5']) && $_POST['Menu5'] == 'Es Degan') {
        $selected_products[] = 5;
    }

    if (empty($selected_products)) {
        echo "Pilih setidaknya satu produk.";
    } else {
        $conn->begin_transaction();

        $query = "INSERT INTO pemesanan ( no_user, alamat, pengiriman, payment, total_bayar) VALUES ( ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issss", $user_id, $alamatkirim, $kurir, $payment, $totalMenu);
        if ($stmt->execute()) {
            echo "Query berhasil dieksekusi.";
        } else {
            echo "Terjadi kesalahan saat menyimpan data pesanan ke dalam database: " . $stmt->error;
            $conn->rollback();
        }

        $last_id = $conn->insert_id;

        foreach ($selected_products as $product_id) {
            if ($product_id === 1) { // Bakso Biasa
                $jumlah = $jumlah1;
                $harga = 7000;
                $total = $harga * $jumlah1;
            } elseif ($product_id === 2) { // Bakso Jumbo
                $jumlah = $jumlah2;
                $harga = 12000;
                $total = $harga * $jumlah2;
            } elseif ($product_id === 3) { // Bakso Urat
                $jumlah = $jumlah3;
                $harga = 14000;
                $total = $harga * $jumlah3;
            } elseif ($product_id === 4) { // Joshua
                $jumlah = $jumlah4;
                $harga = 5000;
                $total = $harga * $jumlah4;
            } elseif ($product_id === 5) { // Es Degan
                $jumlah = $jumlah5;
                $harga = 5000;
                $total = $harga * $jumlah5;
            }

            $query = "INSERT INTO detail_pesanan (pesanan_id, produk_id , jumlah , harga, total_harga) VALUES ( ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iisss", $last_id, $product_id, $jumlah, $harga, $total);
            if ($stmt->execute()) {
                echo "Query berhasil dieksekusi.";
            } else {
                echo "Terjadi kesalahan saat menyimpan data pesanan ke dalam database: " . $stmt->error;
                $conn->rollback();
            }
        }

        $stmt->close();

        $conn->commit();

        exit();
    }
}
?>