<?php 
global $oldkat;

if ($_GET['id']) {
    $idkat= $_GET['id'];
    $editkat = $koneksi->prepare("SELECT * FROM `kategoriobat` WHERE idkategori=$idkat; ");
    try {
        $editkat->execute();
        $oldkat = $editkat->fetch();
    } catch (PDOException $e) {
        //throw $th;
    }
}


//
?>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mt-4 mb-6">
          <!-- Modal title -->
          <!-- <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
            Edit Kategori
          </p> -->
          <!-- Modal description -->
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama Kategori</span>
                <input
                  name="namakategori"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Ultraflu"
                  value="<?=$oldkat['namakategori'] ?>"
                />
              </label>


              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Deskripsi Kategori</span>
                <textarea
                  name="deskripsikategori"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  rows="3"
                  placeholder="............."
                  value="<?=$oldkat['deskripsikategori'] ?>"
                ><?=$oldkat['deskripsikategori'] ?></textarea>
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Gambar Kategori</span>
                <input
                  type="file"
                  name="filekategori"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  rows="3"
                ></input>
              </label>
           </div>
           <div>
                <button
                name="simpankategori"
                type="submit"
                  class="px-10 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Simpan
                </button>
            </div>
        </div>
        </form>
<?php 


if (isset($_POST['simpankategori'])) {
    include 'closehtml.php';

    


    global $hasil;


    // $idkategori = $_POST['idkategori'];
    $namakategori = $_POST['namakategori'];


    $nama_file_kategori = $_FILES['filekategori']['name'];
    $size_file_kategori = $_FILES['filekategori']['size'];

    $deskripsikategori = $_POST['deskripsikategori'];

    if ($size_file_kategori > 2097152) {
        echo '<script>
                  swal("Gagal!", "Ukuran file tidak boleh lebih dari 2MB!", "error");
              </script>';
    }else{
      if ($nama_file_kategori != NULL) {
        $truext = array('png','jpg','jepg');
        $ambilext = explode('.', $nama_file_kategori); 
        $ekstensi = strtolower(end($ambilext));

        $idkat= $oldkat['idkategori'];
        $file_tmp = $_FILES['filekategori']['tmp_name'];    // simpan sementara
        $tanggal_upload = md5(date('Y-m-d h:i:s'));
        // Menyatukan angka/huruf acak dengan nama file aslinya
        $gambarkategori = $tanggal_upload.'-'.str_replace(' ', '',$nama_file_kategori);
        
        if(in_array($ekstensi, $truext) === true)  {

          move_uploaded_file($file_tmp, 'gambarkategori/'.$gambarkategori); // simpan file ke folder gambarobat

          $row = $koneksi->prepare("
          UPDATE `kategoriobat` 
            SET `namakategori` = '$namakategori', 
            `deskripsikategori` = '$deskripsikategori', 
            `gambarkategori` = '$gambarkategori' 
            WHERE `kategoriobat`.`idkategori` = $idkat ");
          try {
            $row->execute();
          }
          catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
          }
          $count = $row->rowCount();

          if($count > 0){ 
      
            // $hasil = $row->fetch();
            $success = 'index.php?adminpage=mkategori&berhasil_simpan_kategori=yes';
            
            echo '<script>window.location.href="'.$success.'"</script>';
            

          }else{
              $gagal = 'index.php?adminpage=mkategori&berhasil_simpan_kategori=no';
              // echo '<script>window.location.href="'.$gagal.'"</script>';
              echo '<script>
                        swal("Gagal!", "Kategori Gagal disimpan!", "error");
                    </script>';
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