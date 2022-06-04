<?php 
global $oldobat;


if (isset($_GET['id'])) {
    $idobat= $_GET['id'];
    $editobat = $koneksi->prepare("SELECT * FROM `produkobat` WHERE idobat=$idobat; ");
    try {
        $editobat->execute();
        $oldobat = $editobat->fetch();
    } catch (PDOException $e) {
        //throw $th;
    }
}


//
?>


        <form
            action=""
            method="post"
            enctype="multipart/form-data"> 
        <div class="mt-4 mb-6">
          <!-- Modal title -->
          <!-- <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
            Tambah Obat
          </p> -->
          <!-- Modal description -->
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama Obat</span>
                <input
                  name="namaobat"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Ultraflu"
                  value="<?=$oldobat['namaobat']?>"
                />
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Kategori Obat
                </span>

                <!-- menampilkan data dari tabel kategori obat   -->
                <?php
                    
                    global $listkat;
                    global $totalkat;

                    $row = $koneksi->prepare("SELECT * FROM `kategoriobat`");
                    try {
                      $row->execute();
                     }
                     catch (PDOException $e) {
                      return 'Error: ' . $e->getMessage();
                     }
                    $totalkat = $row->rowCount();
                    if($totalkat > 0){            
                        $listkat = $row->fetchAll();
                        
                    }
                    
                ?>

                <select
                  name="idkategori"
                   <?= 
                    $totalkat > 0 ? '':'disabled="disabled"';
                   ?>
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                  <?php
                    if ($totalkat > 0 ) {
                      foreach ($listkat as $key) {
                        echo '<option value="'.$key['idkategori'].'">'.$key['namakategori'].'</option>';
                      }
                    }else{
                      echo '<option value="">Harap tambahkan kategori dahulu</option>';
                    }
                    
                  ?>
  
                  
                </select>

                <!--end  menampilkan data dari tabel kategori obat   -->
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Stok Obat</span>
                <input
                  type="number"
                  name="stokobat"
                  value="<?=$oldobat['stokobat']?>"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                />
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Harga Obat</span>
                <!-- focus-within sets the color for the icon when input is focused -->
                <div
                  class="relative text-gray-500 focus-within:text-purple-600 dark:focus-within:text-purple-400"
                >
                  <input
                  
                    name="hargaobat"
                    value="<?=$oldobat['hargaobat']?>"
                    class="block w-full pl-10 mt-1 text-sm text-black dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    placeholder="..."
                  />
                  <div
                    class="absolute inset-y-0 flex items-center ml-3 pointer-events-none"
                  >
                    Rp
                  </div>
                </div>
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Deskripsi Obat</span>
                <textarea
                  name="deskripsiobat"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  rows="3"
                  placeholder="............."
                ><?=$oldobat['deskripsiobat']?></textarea>
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Gambar Obat</span>
                <input
                  type="file"
                  name="fileobat"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  rows="3"
                ></input>
              </label>
           </div>
           <div>
                <button
                name="simpanobat"
                type="submit"
                  class="px-10 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Simpan
                </button>
            </div>
          
        </div>
        </form>

<?php
if (isset($_POST['simpanobat'])) {
    include 'closehtml.php';

    


    global $hasil;
    $idobat = $oldobat['idobat'];

    $idkategoris = $_POST['idkategori'];
    $namaobat = $_POST['namaobat'];
    $hargaobat = $_POST['hargaobat'];

    $nama_file_obat = $_FILES['fileobat']['name'];
    $size_file_obat = $_FILES['fileobat']['size'];

    $deskripsiobat = $_POST['deskripsiobat'];
    $stokobat = $_POST['stokobat'];

    if ($size_file_obat > 2097152) {
        echo '<script>
                  swal("Gagal!", "Ukuran file tidak boleh lebih dari 2MB!", "error");
              </script>';
    }else{
      if ($nama_file_obat != NULL) {
        $truext = array('png','jpg','jepg');
        $ambilext = explode('.', $nama_file_obat); 
        $ekstensi = strtolower(end($ambilext));


        $file_tmp = $_FILES['fileobat']['tmp_name'];    // simpan sementara
        $tanggal_upload = md5(date('Y-m-d h:i:s'));
        // Menyatukan angka/huruf acak dengan nama file aslinya
        $gambarobat = $tanggal_upload.'-'.str_replace(' ', '',$nama_file_obat);
        
        if(in_array($ekstensi, $truext) === true)  {

          move_uploaded_file($file_tmp, 'gambarobat/'.$gambarobat); // simpan file ke folder gambarobat

          $row = $koneksi->prepare("
          UPDATE `produkobat` SET 
          `idkategori` = '$idkategoris', 
          `namaobat` = '$namaobat', 
          `hargaobat` = '$hargaobat', 
          `gambarobat` = '$gambarobat', 
          `deskripsiobat` = '$deskripsiobat', 
          `stokobat` = '$stokobat' 
          WHERE `produkobat`.`idobat` = $idobat 
          ");
          try {
            $row->execute();
            $success = 'index.php?adminpage=mobat&berhasil_simpan_obat=yes';
            
            echo '<script>window.location.href="'.$success.'"</script>';
           }
           catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
           }
          

        }else{
          
          echo '<script>
                  swal("Gagal!", "Ekstensi file tidak diizinkan!", "error");
                </script>';
        }
      }
    }    
  }

?>