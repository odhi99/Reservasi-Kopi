<?php
session_start();
require "conn.php";


$req = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk = '$_GET[id]'");
$data = mysqli_fetch_assoc($req);

$now_date = Date('Y-m-d');
$now_time = Date('H:i');

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $res_user = mysqli_query($conn, "SELECT nama, hp FROM tb_users WHERE role = 'user' AND id_user = '$id'");
    $data_user = mysqli_fetch_assoc($res_user);
} else {
    $data_user['nama'] = '';
    $data_user['hp'] = '';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Futsal</title>



    <!-- JQUERY -->
    <script src="assets/jquery/dist/jquery.min.js"></script>
    <script src="assets/DataTables/datatables.js"></script>

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Sh3wGKHVSP3NM6lF" async></script>
    <link rel="stylesheet" href="assets/DataTables/datatables.css">

    <!-- SWEETALERT -->
    <link rel="stylesheet" href="assets/sweetalert2/dist/sweetalert2.min.css">
    <script src="assets/sweetalert2/dist/sweetalert2.min.js"></script>
</head>

<body>



    <?php
    include("layout/navbar.php");

    ?>



    <section id="detail-product">
        <img src="assets/img/produk/<?= $data['foto'] ?>" alt="">
        <div class="detail">

            <div class="text">
                <div class="title">Produk <?= $data['id_produk'] ?></div>
                <div class="subtitle">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores nesciunt
                    blanditiis mollitia totam odio voluptates repellendus facere, maxime at fuga?</div>
            </div>
            <ul>Feature
                <li>Lorem ipsum dolor sit amet.</li>
                <li>Lorem ipsum dolor sit amet.</li>
                <li>Lorem ipsum dolor sit amet.</li>
                <li>Lorem ipsum dolor sit amet.</li>
            </ul>
            <div class="price">
                Rp <?= number_format($data['harga']) ?> / Jam
            </div>

        </div>

    </section>



    <section id="reservasi">

        <div>
            <div class="input-form">
                <p>Nama</p>
                <input type="text" id="nama" value="<?= $data_user['nama'] ?>">
            </div>

            <div class="input-form">
                <p>No. Hp</p>
                <input type="text" id="hp" value="<?= $data_user['hp'] ?>">
            </div>

            <div class="divide-input">
                <div class="input-form">
                    <p>Stok </p>
                    <input type="number" min="1" value="<?= $data['jumlah'] ?>" readonly>
                </div>
                <div class="input-form">
                    <p>Jumlah </p>
                    <input type="number" id="jumlah" min="1" value="1" onchange="hitungHarga()">
                </div>
            </div>
            <div class="input-form">
                <p>Total Harga</p>
                <input type="text" id="harga" value="<?= number_format($data['harga']) ?>" readonly>
            </div>

            <div class="input-form">
                <button onclick="reserve()" id="reservasi-btn" data-id="<?= $data['id_produk'] ?>">Submit</button>
            </div>


        </div>

        <img src="assets/coffe.jpg" alt="" width="550px">


    </section>



    <script type="text/javascript">
        function hitungHarga() {
            let harga = <?= $data['harga'] ?>;
            let jumlah = $('#jumlah').val()

            document.getElementById('harga').value = (harga * jumlah).toLocaleString()


        }
    </script>
    <script src="reservasi.js"></script>

</body>

</html>