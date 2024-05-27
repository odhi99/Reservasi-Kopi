<?php
session_start();
require "conn.php";

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $res_user = mysqli_query($conn, "SELECT * FROM tb_users WHERE role = 'user' AND id_user = '$id'");
    $data_user = mysqli_fetch_assoc($res_user);
} else {
  redirectBack();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Kopi</title>



    <!-- JQUERY -->
    <script src="assets/jquery/dist/jquery.min.js"></script>
    <script src="assets/DataTables/datatables.js"></script>


    <link rel="stylesheet" href="assets/DataTables/datatables.css">

    <!-- SWEETALERT -->
    <link rel="stylesheet" href="assets/sweetalert2/dist/sweetalert2.min.css">
    <script src="assets/sweetalert2/dist/sweetalert2.min.js"></script>
</head>

<body>



    <?php
    include("layout/navbar.php");

    ?>

    <section id="detail-user">
        <img src="assets/img/users/<?= $data_user['foto']?>" alt="">
        <div class="detail">

            <div class="text">
                <div class="title">Selamat Datang, <?= $data_user['nama']?> </div>
                <div class="subtitle">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores nesciunt
                    blanditiis mollitia totam odio voluptates repellendus facere, maxime at fuga?</div>
            </div>
            <ul>Data Pribadi
                <li>
                    <div>Alamat:</div>
                    <div><?= $data_user['nama']?></div>
                </li>
                <li>
                    <div>Hp:</div>
                    <div><?= $data_user['hp']?></div>
                </li>
                <li>
                    <div>Username:</div>
                    <div><?= $data_user['username']?></div>
                </li>
                <li>
                    <div>Password:</div>
                    <div><?= $data_user['password']?></div>
                </li>

            </ul>


        </div>

    </section>


   
    <section id="jadwal">
        <p class="header">History transaksi</p>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                    <th>Nota</th>


                </tr>
            </thead>
            <tbody>
            <?php
                $q_l = "SELECT * FROM view_transaksi WHERE id_user = '$_SESSION[id]'";
                $res_l = mysqli_query($conn, $q_l);
                $count_l = 1;
                while($data_l = mysqli_fetch_assoc($res_l)){
                ?>

                <tr>
                    <td><?= $count_l++?>.</td>
                    <td><?= $data_l['nama_produk']?></td>
                    <td>Rp <?= number_format($data_l['harga_produk'])?></td>
                    <td><?= $data_l['jumlah']?></td>
                    <td>Rp <?= number_format($data_l['total_harga'])?></td>
                    <td><?= $data_l['tanggal']?></td>
                    <td><a class="btn p-3" href="nota.php?id=<?= $data_l['id_transaksi']?>" style="padding: 30px; color:yellow; text-decoration: none; ">Print</a></td>



                </tr>

                <?php
                }
                ?>
            </tbody>
        </table>

    </section>

    <script type="text/javascript">
    
    
    let table = new DataTable('#myTable', {
        // options
        lengthChange: false,
        pageLength: 6,
        responsive: true,
    });

   
    </script>

</body>

</html>