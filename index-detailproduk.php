
<?php
 require 'dbcon/conn_obat.php';

 global $db;
 global $koneksi;
 global $detailobat;
 global $idobat;
 global $relateobat;
 global $kolset;

 $db = new DbConnect();
 $koneksi = $db->DBConnect();

 //  $relateobat = 

 $dataset = $koneksi->prepare("SELECT * FROM `setting` ");
 
 try {
    $dataset->execute();
    $kolset = $dataset->fetch();
 } catch (\Throwable $th) {
     //throw $th;
 }
 if (isset($_GET['idobat'])) {
    $idobat = $_GET['idobat'];

    if ($idobat == NULL) {
        header('Location: index.php');
    }else{
        $kolomproduk = $koneksi->prepare('
        SELECT * ,kategoriobat.namakategori, kategoriobat.idkategori FROM produkobat INNER JOIN kategoriobat ON produkobat.idkategori=kategoriobat.idkategori WHERE produkobat.idobat ='.$idobat.'; 
                            ');
        
        try {
            $kolomproduk->execute();
        }
        catch (PDOException $e) {
            return 'Error : ' . $e->getMessage();
        }
        $count = $kolomproduk->rowCount();
        $detailobat = $kolomproduk->fetch();
    }  
 }else if ($_GET['idobat'] == NULL) {
     header('Location: index.php');
 }else{
     header('Location: index.php');
 }

 $idkategoris = $detailobat['idkategori'];
 $relateobats = $koneksi->prepare("SELECT * FROM `produkobat` WHERE idkategori = $idkategoris");
 
 try {
    $relateobats->execute();
 }
 catch (PDOException $e) {
    return 'Error : ' . $e->getMessage();
 }
 $relateobat = $relateobats->fetchAll();



 
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
                        <h2><?= $detailobat['namaobat'] ?></h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <a href="index-semuaproduk.php">Semua Produk</a>
                            <span><?= $detailobat['namakategori'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Header detail produk -->
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="admin/gambarobat/<?= $detailobat['gambarobat'] ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?= $detailobat['namaobat'] ?></h3>
                        <!-- jadikan total yang sudah order  -->
                        <!-- <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div> -->
                        <div class="product__details__price">Rp.<?= $detailobat['hargaobat'] ?></div>
                        <p><?= $detailobat['deskripsiobat'] ?></p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input class="jumlahbelispan" type="text" value="1" id="jumlahbeli_form" name="jumlahbeli_form">
                                </div>
                            </div>
                        </div>
                        <a href="#tampil_tidakformpembelian" class="primary-btn" id="beliobat"   <?= $detailobat['stokobat'] <= 0 ? 'aria-disabled="true"':'onclick="tampilkanFormPembelian()"'?> ><?= $detailobat['stokobat'] > 0 ? 'BELI':'Stok Kosong'?></a>
                        
                        <ul>
                            <li><b>Stok</b> <span><?= $detailobat['stokobat'] ?></span></li>
                            <li><b>Kategori</b> <span> <samp><?= $detailobat['namakategori'] ?></samp></span></li>
                            <li><b>Bagikan</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- order  -->
    <!-- Checkout Section Begin -->
    <section class="checkout spad" hidden id="tampil_tidakformpembelian">
        <div class="container">
            
            <div class="checkout__form">
                <h4>Detail Pelanggan</h4>
                <form action="" method="post">
                    <input type="hidden" name="jumlahorder" id="jumlahorder_form">
                    <input type="hidden" name="linkproduk" id="linkproduk" value="<?= $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>">
                    <input type="hidden" name="tagihan" id="tagihan" value="">
                    <input type="hidden" name="oldstok" id="oldstok" value="<?= $detailobat['stokobat']?>">
                    
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Nama Depan<span>*</span></p>
                                        <input
                                            name="namadepan_form" 
                                            id="namadepan_form" 
                                            type="text" id="namadepan_form">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Nama Belakang<span>*</span></p>
                                        <input
                                            name="namabelakang_form" 
                                            id="namabelakang_form" 
                                            type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Alamat Lengkap<span>*</span></p>
                                <textarea 
                                    name="alamat_form"
                                    id="alamat_form"
                                    style="width: 100%;border-radius:4px;border:1px solid #ebebeb;color:#b2b2b2;"></textarea>
                            </div>
                            <div class="checkout__input">
                                <p>Kode pos / ZIP<span>*</span></p>
                                <input
                                    name="kodepos_form" 
                                    id="kodepos_form" 
                                    type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Telepon<span>*</span></p>
                                        <input
                                            name="telp_form" 
                                            id="telp_form" 
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input
                                            name="email_form" 
                                            id="email_form" 
                                            type="text">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="checkout__input">
                                <p>Catatan Order<span>*</span></p>
                                <input type="text"
                                    name="catatan_form"
                                    id="catatan_form"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Pesanan Anda</h4>
                                <div class="checkout__order__products">Produk <span>Total</span></div>
                                <ul>
                                    <li><?= substr($detailobat['namaobat'], 0,20); ?>.... <span>Rp.<?= $detailobat['hargaobat']?></span></li>
                
                                </ul>
                                <div class="checkout__order__products">Jumlah <span id="jumlahbelispan"></span></div>
                                <div class="checkout__order__subtotal">Subtotal <span id="totalbayar"></span></div>
                                
                                <div class="checkout__order__total">Total <span id="totalbayartotal"></span></div>

                                <button type="submit" name="pesanskarang" class="site-btn">Pesan Sekarang</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- hide order  -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Produk Terkait</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
                foreach ($relateobat as $relat) {
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="admin/gambarobat/<?= $relat['gambarobat'] ?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="index-detailproduk.php?idobat=<?= $relat['idobat'] ?>"><?= $relat['namaobat'] ?> </a></h6>
                            <h5>Rp.<?= $relat['hargaobat'] ?></h5>
                        </div>
                    </div>
                </div>
                <?php 
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

$namaobat = $detailobat['namaobat'];
 
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
    $linkwa = 'https://wa.me/'.$kolset['setphone'].'?text='.urlencode($isiwa);
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
