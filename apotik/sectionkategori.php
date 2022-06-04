<section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <!-- list kategori  -->
                    <?php

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
                    
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="admin/gambarkategori/<?= $key['gambarkategori']?>">
                            <h5><a href="produk.php?catid=<?= base64_encode($key['idkategori']) ?>"><?= $key['namakategori']?></a></h5>
                        </div>
                    </div>

                    <?php
                        
                        } 
                    
                    ?>
                    <!-- kategori  -->
                </div>
            </div>
        </div>
</section>