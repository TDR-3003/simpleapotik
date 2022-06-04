    <section class="hero 
                <?php 
                $reqs = $_SERVER['REQUEST_URI'];
                if (strpos($reqs, 'index-detailproduk') !== false) {echo 'hero-normal';} ?>
                ">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Semua kategori</span>
                        </div>
                        <ul>

                        <?php

                            global $datakategori;

                            $row = $koneksi->prepare('SELECT * FROM `kategoriobat`');
                            try {
                                $row->execute();
                             }
                             catch (PDOException $e) {
                                return 'Error: ' . $e->getMessage();
                             }
                            $count = $row->rowCount();
                            $datakategori = $row->fetchAll();
            
                            foreach ($datakategori as $key) {
                                
                            ?>
                            <li><a href="produk.php?catid=<?= base64_encode( $key['idkategori']) ?>"><?= $key['namakategori'] ?></a></li>
                        <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="" name="cari" method="get">
                                
                                
                                <input type="text" name="cari" placeholder="Ingin cari obat apa?">
                                <button type="submit" class="site-btn">CARI</button>
                            </form>
                        </div>
                        
                    </div>
                    <?php 
                        global $req;
                        $req = $_SERVER['REQUEST_URI'];
                        if (strpos($req, 'index-detailproduk') !== false) {
                            // jika yang diakses halaman index-detailproduk.php maka tidak menampilkan banner
                        }else if(strpos($req, 'produk.php') !== false){
                         // null
                        }else if(isset($_GET['cari'])){
                            
                        }
                        else{
                    ?>
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                        <div class="hero__text">
                            <h2 style="color:#e83e8c;">Semua Produk <br />100% Asli</h2>
                            <p style="color: #e83e8c; ">Tersedia free ongkir</p>
                            <a href="#semuaobat" class="primary-btn">PESAN SEKARANG</a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>