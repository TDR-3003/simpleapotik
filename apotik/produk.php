
<?php
 require 'dbcon/conn_obat.php';

 global $db;
 global $koneksi;

 global $allproduk;
 global $produkkategori;
 global $getkategori;
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
 $produkkategori = NULL;
 $allproduk = NULL;
 $getkategori = NULL;


 if (isset($_GET['catid'])) {
     $catid = base64_decode($_GET['catid']);

     $kategori = $koneksi->prepare('SELECT * FROM `kategoriobat` WHERE idkategori='.$catid);

     $dengankategori = $koneksi->prepare('SELECT * FROM `produkobat` WHERE idkategori='.$catid);
     try {
        $dengankategori->execute();
        $kategori->execute();
        $getkategori = $kategori->fetch();
        $produkkategori = $dengankategori->fetchAll();
     } catch (\PDOException $e) {
         echo 'Error : '.$e->getMessage();
     }
     
     
 }else{
    $tanpakategori = $koneksi->prepare('SELECT * FROM `produkobat`');
    try {
       $tanpakategori->execute();
       $allproduk = $tanpakategori->fetchAll();
    } catch (\PDOException $e) {
        echo 'Error : '.$e->getMessage();
    }

 }
 
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

    <!-- Header detail produk -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Daftar Semua Obat</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <a href="produk.php">Semua Produk</a>
                            <span>
                                <?php 
                                if (isset($_GET['catid'])) {
                                    echo $getkategori['namakategori'];
                                }else{
                                    echo 'Produk';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Header detail produk -->


    <!-- hide order  -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Semua produk</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 

                if (isset($_GET['catid'])) {
                    foreach ($produkkategori as $prokat) {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="admin/gambarobat/<?= $prokat['gambarobat'] ?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="index-detailproduk.php?idobat=<?= $prokat['idobat'] ?>"><?= $prokat['namaobat'] ?> </a></h6>
                            <h5>Rp.<?= $prokat['hargaobat'] ?></h5>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                }else{
                    foreach ($allproduk as $allprot) {

                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="admin/gambarobat/<?= $allprot['gambarobat'] ?>">
                            <!-- <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul> -->
                        </div>
                        <div class="product__item__text">
                            <h6><a href="index-detailproduk.php?idobat=<?= $allprot['idobat'] ?>"><?= $allprot['namaobat'] ?> </a></h6>
                            <h5>Rp.<?= $allprot['hargaobat'] ?></h5>
                        </div>
                    </div>
                </div>

                <?php 

                    }
                }
                ?>
                
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <?php 
        include 'index-footer.php';
    ?>
    <!-- Footer Section End -->
    

    <script>

        function tampilkanFormPembelian() {
            var tampil_tidakformpembelian =  document.getElementById("tampil_tidakformpembelian").removeAttribute("hidden"); 
            
            var getTotalbelis =  document.getElementById("jumlahbeli_form"); 
            console.log(getTotalbelis.value);
            var hargaasli = <?= $detailobat['hargaobat']?>;
            var total = parseFloat(hargaasli)*parseFloat(getTotalbelis.value)
            document.getElementById("jumlahbelispan").innerHTML=parseInt(getTotalbelis.value);
            document.getElementById("totalbayar").innerHTML=total;
            document.getElementById("totalbayartotal").innerHTML=total;
            document.getElementById("tagihan").value=total;
            document.getElementById("jumlahorder_form").value= parseInt(getTotalbelis.value);
            
        }
    </script>
    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <!-- end sweet alert  -->


</body>
</html>

<?php 

// $namaobat = $detailobat['namaobat'];
 
 // fungsi order
 if (isset($_POST['pesanskarang'])) {

    $jumlahorder = $_POST['jumlahorder'];
    $linkproduk = $_POST['linkproduk'];
    $namadepan_form = $_POST['namadepan_form'];
    $namabelakang_form = $_POST['namabelakang_form'];
    $alamat_form = $_POST['alamat_form'];
    $kodepos_form = $_POST['kodepos_form'];
    $telp_form = $_POST['telp_form'];
    $email_form = $_POST['email_form'];
    $catatan_form = $_POST['catatan_form'];
    $tagihan = $_POST['tagihan'];
    $idobat = $_GET['idobat'];
    $namaa = $namadepan_form. ' ' .$namabelakang_form;
    $isiwa = <<<EOD
    Hallo Obati\n
    Saya $namaa,\n
    Pesan *$namaobat*
    Link : $linkproduk\n
    Jumlah pesan : *$jumlahorder*
    Total bayar : *$tagihan*
    Kirim ke alamat : *$alamat_form*
    Nomor hp : *$telp_form*\n
    Terimakasih.
    EOD;
    $linkwa = 'https://wa.me/6288216711271?text='.urlencode($isiwa);
    $openwa = $linkwa;

    $order = $koneksi->prepare("
    INSERT INTO `orderproduk` (`idorder`, 
            `namapel`, 
            `alamatpel`, 
            `kodepospel`, 
            `telponpel`, 
            `emailpel`, 
            `catatanpel`, 
            `jumlahorder`, 
            `tagihanorder`, 
            `statusorder`, 
            `linkproduk`, 
            `idobat`) 
    VALUES (NULL, 
            '$namaa', 
            '$alamat_form', 
            '$kodepos_form',
            '$telp_form', 
            '$email_form', 
            '$catatan_form', 
            '$jumlahorder',
            '$tagihan', 
            '1', 
            '$linkproduk',
            '$idobat') 
    ");
    $oldstok = $_POST['oldstok'];
    $upstok = $oldstok - $jumlahorder;
    $kurangistok = $koneksi->prepare("UPDATE `produkobat` SET `stokobat` = '$upstok' WHERE `produkobat`.`idobat` = $idobat; ");
    
    try {
        
        if ($order->execute()) {
            $kurangistok->execute();
            echo '
            <script>
                      swal({
                        title: "Berhasil!",
                        text: "Order berhasil silahkan konfirmasi lewat wa!",
                        icon: "success",
                        buttons: {cancel: true,confirm: "Konfirmasi",},
                        }).then((result) => {
                            if (result === true) {
                                window.location.href = "'.$openwa.'";
                            }
                        })
            </script>
            ';
        }
    }
    catch (PDOException $e) {
        return 'Error : ' . $e->getMessage();
    }
 }

?>
