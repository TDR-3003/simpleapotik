
<div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
    <div>
        <button
            @click="openModal"
            id="modal"
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <span>Tambah Kategori</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 -mr-1" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
            </svg>
        </button>
    </div>
</div>

<!-- tabel data obat  -->
<div class="w-full overflow-hidden rounded-lg shadow-xs " style="margin-bottom: 30px;">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Kategori</th>
                      <th class="px-4 py-3">Deskripsi</th>
                      <th class="px-4 py-3">Aksi</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >

                    <?php 

                      global $totalobat;
                      $row = $koneksi->prepare('SELECT * FROM kategoriobat');
                      
                      try {
                        $row->execute();
                       }
                       catch (PDOException $e) {
                        return 'Error: ' . $e->getMessage();
                       }
                      $totalobat = $row->rowCount();
                      $dataobat = $row->fetchAll();

                      foreach ($dataobat as $key) {
                        
                    ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          >
                            <img
                              class="object-cover w-full h-full rounded-full"
                              src="../admin/gambarkategori/<?= $key['gambarkategori'] ?>"
                              alt=""
                              loading="lazy"
                            />
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="font-semibold"><?= $key['namakategori'] ?></p>
                            
                          </div>
                        </div>
                      </td>
         
                      <td class="px-4 py-3 text-xs">
                        <p class="font-semibold"><?= $key['deskripsikategori'] ?></p>
                      </td>
                 

                      <td class="px-4 py-3"> 
                      <div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
                      <div>
                        <!-- tombol edit  -->
                        <button 
                        onclick="window.location.href='index.php?adminpage=editkategori&id=<?=$key['idkategori']?>';"
                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Like">
                          
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                        </button>
                      
                      </div>
                      
                      <!-- tombol hapus  -->
                 
                          <form action=""
                                name="hapuskategori"
                                method="post"
                          >

                          <input type="hidden" name="idkategori" value="<?=$key['idkategori']?>">
                          <div>
                            
                              <button
                              name="hapuskategori" 
                              type="submit"
                                class="px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Like">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                              </button>
                          </div>                            
                          </form>

        
                      </div>
                      </td>
                    </tr>



                    <?php
                      }
                    ?>

                    <?= $totalobat > 0 ? '':'
                      <tr>
                      <td colspan=4>
                      <div
                      class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
                      >
                      <span class="flex items-center col-span-3 text-center">Data kosong</span>
                      </div>
                      </td>
                      </tr>
                      ' ?>

                  </tbody>
                </table>
              </div>
              <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
              >
                <span class="flex items-center col-span-3">
                  Total <?= $totalobat ?> Kategori
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->

              </div>
</div>
<!-- end tabel obat  -->



<?=
  $hasil = NULL;
  
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


        $file_tmp = $_FILES['filekategori']['tmp_name'];    // simpan sementara
        $tanggal_upload = md5(date('Y-m-d h:i:s'));
        // Menyatukan angka/huruf acak dengan nama file aslinya
        $gambarkategori = $tanggal_upload.'-'.str_replace(' ', '',$nama_file_kategori);
        
        if(in_array($ekstensi, $truext) === true)  {

          move_uploaded_file($file_tmp, 'gambarkategori/'.$gambarkategori); // simpan file ke folder gambarobat

          $row = $koneksi->prepare("
          INSERT INTO `kategoriobat` (`idkategori`,`namakategori`, `deskripsikategori`, `gambarkategori`) VALUES 
                                  (NULL,'$namakategori', '$deskripsikategori', '$gambarkategori');");
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

  if (isset($_GET['berhasil_simpan_kategori'])) {
    include 'closehtml.php';
    echo '<script>
            swal("Success!", "Kategori Berhasil disimpan!", "success");
          </script>';
  }

  if (isset($_GET['berhasil_hapus_kategori'])) {
    include 'closehtml.php';
    echo '<script>
            swal("Success!", "Kategori Berhasil dihapus!", "success");
          </script>';
  }

  

?>

<!-- hapus obat  -->

<?= 

$hasil = NULl;

if (isset($_POST['hapuskategori']) && isset($_POST['idkategori'])) {
  $idkategori = $_POST['idkategori'];
  $row = $koneksi->prepare("DELETE FROM `kategoriobat` WHERE `kategoriobat`.`idkategori` = $idkategori");
  try {
    if ($row->execute()) {

      $hapus = 'index.php?adminpage=mkategori&berhasil_hapus_kategori=yes';
              
      echo '<script>window.location.href="'.$hapus.'"</script>';
      
    }
   }
   catch (PDOException $e) {
    return 'Error: ' . $e->getMessage();
   }

  
}
?>





<!-- modal input obat  -->
    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div
      x-show="isModalOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    >
      <!-- Modal -->
      <div
        x-show="isModalOpen"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0  transform translate-y-1/2"
        @click.away="closeModal"
        @keydown.escape="closeModal"
        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
        role="dialog"
        id="modal">
        <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
        <header class="flex justify-end">
          <button
            class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
            aria-label="close"
            @click="closeModal"
          >
            <svg
              class="w-4 h-4"
              fill="currentColor"
              viewBox="0 0 20 20"
              role="img"
              aria-hidden="true"
            >
              <path
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
                fill-rule="evenodd"
              ></path>
            </svg>
          </button>
        </header>
        <!-- Modal body -->
        <!-- start form  -->
        <form
            action="?adminpage=mkategori"
            method="post"
            enctype="multipart/form-data"> 
        <div class="mt-4 mb-6">
          <!-- Modal title -->
          <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
            Tambah Kategori
          </p>
          <!-- Modal description -->
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama Kategori</span>
                <input
                  name="namakategori"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Ultraflu"
                />
              </label>


              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Deskripsi Kategori</span>
                <textarea
                  name="deskripsikategori"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  rows="3"
                  placeholder="............."
                ></textarea>
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
          
        </div>
        <footer
          class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
        >
          <button
            @click="closeModal"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
          >
            Cancel
          </button>
          <input
            value="Simpan"
            type="submit"
            name="simpankategori"
            class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
          >
          </input>
        </footer>
        </form>
        <!-- end form  -->
      </div>
    </div>
<!-- End of modal backdrop -->

<!-- end modal  -->
