
<?php
 require 'dbcon/conn_obat.php';

 global $db;
 global $koneksi;
 global $produkterbaru;
 global $kolset;

 $db = new DbConnect();
 $koneksi = $db->DBConnect();
 
 $dataset = $koneksi->prepare("SELECT * FROM `setting` ");
 
 try {
    $dataset->execute();
    $kolset = $dataset->fetch();
 } catch (\Throwable $th) {
     //throw $th;
 }

 $kolomproduk = $koneksi->prepare('
 SELECT * ,kategoriobat.namakategori FROM produkobat INNER JOIN kategoriobat ON produkobat.idkategori=kategoriobat.idkategori LIMIT 8; 
                      ');
 
 try {
    $kolomproduk->execute();
 }
 catch (PDOException $e) {
    return 'Error: ' . $e->getMessage();
 }
 $count = $kolomproduk->rowCount();
 $produkterbaru = $kolomproduk->fetchAll();

 
?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php 
    include 'headmeta.php';
?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <?php 
        include 'index-humberger.php';
    ?>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <?php 
        include 'index-header.php';
    ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <?php 
        include 'sectionhero.php'
    ?>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->

    <?php 
        if (isset($_GET['cari'])) {
            # code...
        }else{
            include 'sectionkategori.php';
        }
        
    ?>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <!-- section produk terbaru dan berdasarkan kategori  -->
    <?php 
        if (isset($_GET['cari'])) {
            include 'cari.php';
        }else{
            include 'sectionprodukterbaru.php';
        }
        
    ?>
    <!-- end  -->
    <!-- Featured Section End -->

    <!-- Footer Section Begin -->
    <?php 
        include 'index-footer.php';
    ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>
</html>

