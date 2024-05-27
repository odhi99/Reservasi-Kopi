<?php
$URL = "index.php"


?>
<link rel="stylesheet" href="style.css">

<nav>
    <div class="logo">
        <a href="<?= $URL?>">KEDAI <u>Kopi<i>Ku</i></u> </a>
    </div>
    <div class="navbar">
        <ul>
            <a href="<?= $URL?>#banner">Home</a>
            <a href="<?= $URL?>#about-us">Tentang Kami</a>
            <a href="<?= $URL?>#layanan">Produk Kami</a>
        </ul>
    </div>
    <div class="actions">
        <?= (isset($_SESSION['id'])) ? '<a href="akun.php">Akun</a>':'<a href="logout.php">Masuk</a>'?>
        <a href="logout.php">Logout</a>
        
    </div>
</nav>


