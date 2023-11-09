<?php
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
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Noy's Bakso</title>
</head>

<body class="formpage">
  <nav class="menu">
    <img src="img/bakso.png" alt="" width="80">
    <label>NOY'S BAKSO</label>
    <ul>
      <li><a href="index.html">home</a></li>
      <li><a href="info.html">Information</a></li>
      <li><a href="https://wa.me/+6281217981811" target="_blank">contact us</a></li>
      <li><a href="about.html">about us</a></li>
    </ul>
  </nav>
  <div class="form">
    <form action="bakso.php" method="post">

      <h2>Detail Menu</h2>

      <div class="total Menu1">
        <?php if ($jumlah1 > 0): ?>
          <hr>
          <img src="img/img2.png" alt="Gambar Bakso Biasa" width="100"> Bakso Biasa
          <p>Jumlah : x
            <?php echo $jumlah1; ?>
          </p><br>
        <?php endif; ?>
      </div>

      <div class="total Menu2">
        <?php if ($jumlah2 > 0): ?>
          <hr>
          <img src="img/img1.png" alt="Gambar Bakso Jumbo" width="100"> Bakso Jumbo
          <p>Jumlah : x
            <?php echo $jumlah2; ?>
          </p><br>
        <?php endif; ?>
      </div>

      <div class="total Menu3">
        <?php if ($jumlah3 > 0): ?>
          <hr>
          <img src="img/img3.png" alt="Gambar Bakso Urat" width="100"> Bakso Urat
          <p>Jumlah : x
            <?php echo $jumlah3; ?>
          </p><br>
        <?php endif; ?>
      </div>

      <div class="total Menu4">
        <?php if ($jumlah4 > 0): ?>
          <hr>
          <img src="img/img4.png" alt="Gambar Joshua" width="100"> Joshua
          <p>Jumlah : x
            <?php echo $jumlah4; ?>
          </p><br>
        <?php endif; ?>
      </div>

      <div class="total Menu5">
        <?php if ($jumlah5 > 0): ?>
          <hr>
          <img src="img/img5.png" alt="Gambar Es Degan" width="100"> Es Degan
          <p>Jumlah : x
            <?php echo $jumlah5; ?>
          </p>
          <hr><br>
        <?php endif; ?>
      </div>

    </form>
  </div>

  <div class="infokirim">
    <h2>Info Pengiriman</h2>
    Kurir:
    <p>
      <?php echo $kurir; ?>
    </p><br>
    Alamat:
    <p>
      <?php echo $alamat; ?>
    </p>
    <hr><br>
  </div>

  <div class="rincian-bayar">
    <h2>Rincian Pembayaran</h2>
    Metode Pembayaran:
    <p>
      <?php echo $metode; ?>
    </p>
    <hr><br>
    Total Menu:
    <p>
      <?php echo $totalMenu; ?>
    </p><br>
    Jasa Pengiriman:
    <p>
      <?php echo $biayaKurir; ?>
    </p>
    <hr><br>
    Total Bayar:
    <p>
      <?php echo $totalBayar; ?>
    </p><br>
  </div>

  <footer>
    <div class="footer">
      <div class="imgbakso">
        <img src="img/bakso.png" alt="" width="120">
      </div>
      <h2>NOY'S BAKSO</h2>
      <div class="footer-content">
        <div class="location">
          <p class="wa"><a href="https://wa.me/+6281217981811" target="_blank"><img src="img/wa.png" alt=""
                width="22">+6281217981811
          </p></a>
          <p class="instagram"><a href="#" target="_blank"><img src="img/instagramicon.png" alt="" width="22">@NoyzBakso
          </p></a>
          <p class="map"><a href="#" target="_blank"><img src="img/map.png" alt="" width="18">Depan Angga's Haircut,Ds
              Ringinpitu</p></a>
        </div>
        <h4>Available at</h4>
        <div class="logo">
          <p class="shopee"><a href="#" target="_blank"><img src="img/shopeehp.png" alt="" width="30"></p></a>
          <p class="gojek"><a href="#" target="_blank"><img src="img/gojek.png" alt="" width="45"></p></a>
          <p class="grab"><a href="#" target="_blank"><img src="img/grab.png" alt="" width="60"></p></a>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>