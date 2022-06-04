
<div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
    <div>
        <button
            @click="openModal"
            id="modal"
            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <span>Tambah Obat</span>
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
                      <th class="px-4 py-3">Obat</th>
                      <th class="px-4 py-3">Harga</th>
                      <th class="px-4 py-3">Stok</th>
                      <th class="px-4 py-3">Kategori</th>
                      <th class="px-4 py-3">Aksi</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >

                    <?php 

                      global $totalobat;
                      $row = $koneksi->prepare('
                      SELECT * ,kategoriobat.namakategori FROM produkobat INNER JOIN kategoriobat ON produkobat.idkategori=kategoriobat.idkategori; 
                      ');
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
                              src="../admin/gambarobat/<?= $key['gambarobat'] ?>"
                              alt=""
                              loading="lazy"
                            />
                            <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div>
                          </div>
                          <div>
                            <p class="font-semibold"><?= $key['namaobat'] ?></p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                            <?= substr($key['deskripsiobat'], 0,100) ?>
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        Rp. <?= $key['hargaobat'] ?>
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          <?= $key['stokobat'] > 0 ? 
                                'class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"'
                                  :
                                'class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"' ?>
                        >
                          <?= $key['stokobat'] ?>
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <?= $key['namakategori'] ?>
                      </td>

                      <td class="px-4 py-3"> 
                      <div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
                      <div>
                        <!-- tombol edit  -->
                        <button 
                        onclick="window.location.href='index.php?adminpage=editobat&id=<?=$key['idobat']?>';"
                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Like">
                          
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                        </button>
                      
                      </div>
                      
                      <!-- tombol hapus  -->
                 
                          <form action=""
                                name="hapusobat"
                                method="post"
                          >

                          <input type="hidden" name="idobat" value="<?=$key['idobat']?>">
                          <div>
                            
                              <button
                              name="hapusobats" 
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
                      <td colspan=5>
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
                  Total <?= $totalobat ?> Obat
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                <!-- <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                  <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                      <li>
                        <button
                          class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                          aria-label="Previous"
                        >
                          <svg
                            aria-hidden="true"
                            class="w-4 h-4 fill-current"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                              clip-rule="evenodd"
                              fill-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          1
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          2
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          3
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          4
                        </button>
                      </li>
                      <li>
                        <span class="px-3 py-1">...</span>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          8
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                        >
                          9
                        </button>
                      </li>
                      <li>
                        <button
                          class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                          aria-label="Next"
                        >
                          <svg
                            class="w-4 h-4 fill-current"
                            aria-hidden="true"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                              clip-rule="evenodd"
                              fill-rule="evenodd"
                            ></path>
                          </svg>
                        </button>
                      </li>
                    </ul>
                  </nav>
                </span> -->
              </div>
</div>
<!-- end tabel obat  -->



<?=
  $hasil = NULL;
  
  if (isset($_POST['simpanobat'])) {
    include 'closehtml.php';

    


    global $hasil;


    $idkategori = $_POST['idkategori'];
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
          INSERT INTO `produkobat` 
                      (`idobat`, `idkategori`, `namaobat`, `hargaobat`, `gambarobat`, `deskripsiobat`, `stokobat`) 
                      VALUES (NULL, '$idkategori', '$namaobat', '$hargaobat', '$gambarobat', '$deskripsiobat', '$stokobat');
          ");
          try {
            $row->execute();
           }
           catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
           }
          $count = $row->rowCount();

          if($count > 0){ 
      
            // $hasil = $row->fetch();
            $success = 'index.php?adminpage=mobat&berhasil_simpan_obat=yes';
            
            echo '<script>window.location.href="'.$success.'"</script>';
            

          }else{
              $gagal = 'index.php?adminpage=mobat&berhasil_simpan_obat=no';
              // echo '<script>window.location.href="'.$gagal.'"</script>';
              echo '<script>
                        swal("Gagal!", "Obat Gagal disimpan!", "error");
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

  if (isset($_GET['berhasil_simpan_obat'])) {
    include 'closehtml.php';
    echo '<script>
            swal("Success!", "Obat Berhasil disimpan!", "success");
          </script>';
  }

  if (isset($_GET['berhasil_hapus_obat'])) {
    include 'closehtml.php';
    echo '<script>
            swal("Success!", "Obat Berhasil dihapus!", "success");
          </script>';
  }

  

?>

<!-- hapus obat  -->

<?= 

$hasil = NULl;

if (isset($_POST['hapusobats']) && isset($_POST['idobat'])) {
  $idobat = $_POST['idobat'];
  $row = $koneksi->prepare("DELETE FROM `produkobat` WHERE `produkobat`.`idobat` = $idobat");
  try {
    if ($row->execute()) {

      $hapus = 'index.php?adminpage=mobat&berhasil_hapus_obat=yes';
              
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
            action="?adminpage=mobat"
            method="post"
            enctype="multipart/form-data"> 
        <div class="mt-4 mb-6">
          <!-- Modal title -->
          <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
            Tambah Obat
          </p>
          <!-- Modal description -->
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama Obat</span>
                <input
                  name="namaobat"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Ultraflu"
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
                ></textarea>
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
            name="simpanobat"
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
