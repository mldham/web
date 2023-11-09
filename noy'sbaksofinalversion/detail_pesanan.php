<?php
session_start();
include 'connect.php';
$query = "SELECT * FROM pemesanan ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($query);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $pesanan = $result->fetch_assoc();

    $alamat = '';
    $pengiriman = '';
    $payment = '';
    $totalBayar = '';
    $biayaKurir = 0;
    $totalMenu = 0;
    $payment = '';
    if ($result->num_rows == 1) {
       $alamat = $pesanan['alamat'];
       $pengiriman = $pesanan['pengiriman'];
       $totalBayar = $pesanan['total_bayar'];
       $biayaKurir = $pesanan['ongkir'];
       $totalMenu = $pesanan['total_bayar'];
       $payment = $pesanan['payment'];
    }

    $query = "SELECT * FROM detail_pesanan WHERE pesanan_id = " . $pesanan['id'];
    $stmt = $conn->prepare($query);

    if ($stmt->execute()) {
      $result = $stmt->get_result();

      $jumlah1 = 0;
      $jumlah2 = 0;
      $jumlah3 = 0;
      $jumlah4 = 0;
      $jumlah5 = 0;

      $total1 = 0;
      $total2 = 0;
      $total3 = 0;
      $total4 = 0;
      $total5 = 0;
      foreach($result as $item) {
        if($item['produk_id'] == 1) {
          $jumlah1 = $item['jumlah'];
          $total1 = $item['total_harga'];
        }
        if($item['produk_id'] == 2) {
          $jumlah2 = $item['jumlah'];
          $total2 = $item['total_harga'];
        }
        if($item['produk_id'] == 3) {
          $jumlah3 = $item['jumlah'];
          $total3 = $item['total_harga'];
        }
        if($item['produk_id'] == 4) {
          $jumlah4 = $item['jumlah'];
          $total4 = $item['total_harga'];
        }
        if($item['produk_id'] == 5) {
          $jumlah5 = $item['jumlah'];
          $total5 = $item['total_harga'];
        }
      }
  
  } else {
      echo "Error executing the query: " . $stmt->error;
  }
} else {
    echo "Error executing the query: " . $stmt->error;
}

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
      <?php echo $pengiriman; ?>
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
      <?php echo $payment; ?>
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