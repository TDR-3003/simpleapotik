<?php

    global $db;
    global $koneksi;
   
    global $allproduk;
    global $produkkategori;
    global $getkategori;
    global $kolset;

    if (isset($_GET['cari'])) {

        $db = new DbConnect();
        $koneksi = $db->DBConnect();
        $dataset = $koneksi->prepare("SELECT * FROM `setting` ");
        $cari = $_GET['cari'];

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
           $tanpakategori = $koneksi->prepare('SELECT * FROM `produkobat` WHERE CONCAT(produkobat.namaobat, " ", produkobat.deskripsiobat) LIKE "%'.$cari.'%";');
           try {
              $tanpakategori->execute();
              $allproduk = $tanpakategori->fetchAll();
           } catch (\PDOException $e) {
               echo 'Error : '.$e->getMessage();
           }
       
        }

   
    }

?>

    <!-- Header detail produk -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Obat yang anda cari</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Header detail produk -->


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