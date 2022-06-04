<section class="featured spad" id="semuaobat">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Produk Terbaru</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>

                            <?php 
                                foreach ($datakategori as $key) {
                                    echo '<li data-filter=".'.str_replace(' ', '',$key['namakategori']).'">'.$key['namakategori'].'</li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php 
                    foreach ($produkterbaru as $key) {

                    
                ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix <?= str_replace(' ', '',$key['namakategori'])?> ">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="admin/gambarobat/<?= $key['gambarobat'];?>">
                            <!-- <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul> -->
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="index-detailproduk.php?idobat=<?= $key['idobat'] ?>"><?= $key['namaobat'];?></a></h6>
                            <h5>Rp. <?= $key['hargaobat'];?></h5>
                        </div>
                    </div>
                </div>

                <?php 
                    }
                ?>
               
            </div>
        </div>
    </section>