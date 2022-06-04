
<!-- <div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
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
</div> -->

<!-- tabel data penjualan  -->
<div class="w-full overflow-hidden rounded-lg shadow-xs " style="margin-bottom: 30px;">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3 text-center">Produk</th>
                      <th class="px-4 py-3">Pelanggan</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">Aksi</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >

                    <?php 

                      global $totaljual;
                      $row = $koneksi->prepare('SELECT * , produkobat.namaobat FROM orderproduk INNER JOIN produkobat ON orderproduk.idobat=produkobat.idobat; ');
                      
                      try {
                        $row->execute();
                       }
                       catch (PDOException $e) {
                        return 'Error: ' . $e->getMessage();
                       }
                      $totaljual = $row->rowCount();
                      $datajual = $row->fetchAll();

                      foreach ($datajual as $key) {
                        
                    ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          >
                            
                            
                          </div>
                          <div>
                            <p class="font-semibold"><a href="<?= $key['linkproduk'] ?>"><?= $key['namaobat'] ?></a></p>
                      
                            <br>
                            <span>Jumlah beli : <?= $key['jumlahorder'] ?></span>
                            <br>
                            <span>Catatan beli : <?= $key['catatanpel'] ?></span>
                          </div>
                        </div>
                      </td>
         
                      <td class="px-4 py-3 text-xs">
                        <div>
                            <p class="font-semibold"><?= $key['namapel'] ?></p>
                            <span><a href="telp:<?= $key['telponpel'] ?>"><?= $key['telponpel'] ?></a></span>
                            <br>
                            <span>Email : <?= $key['emailpel'] ?></span>
                            <br>
                            <span>Alamat : <?= substr($key['alamatpel'], 0, 45) ?>...</span>
                          </div>
                      </td>
                      <td class="px-4 py-3">
                          <span
                          <?= $key['statusorder'] == 2 ? 
                                'class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"'
                                  :
                                'class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"' ?>
                        >
                          <?= $key['statusorder'] == 2 ? 'Selesai':'Belum Selesai' ?>
                        </span>
                      </td>
                 

                      <td class="px-4 py-3 text-xs"> 
                      <div class="flex flex-col flex-wrap mb-8 space-y-4 md:flex-row md:items-end md:space-x-4">
                      <div>
                        <!-- tombol edit  -->
                        <button 
                            onclick="document.getElementById('orderidedit').value=this.value"
                            @click="openModal"
                            id="modal" 
                            value="<?= $key['idorder'] ?>"
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" aria-label="Like">
                          
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                        </button>
                      
                      </div>
                      
                      <!-- tombol hapus  -->
                 
                          <form action=""
                                name="hapuspenjualan"
                                method="post"
                          >

                          <input type="hidden" name="idorder" value="<?=$key['idorder']?>">
                          <div>
                            
                              <button
                              name="hapuspenjualan"

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

                    <?= $totaljual > 0 ? '':'
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
                  Total <?= $totaljual ?> Penjualan
                </span>
                <span class="col-span-2"></span>
                <!-- Pagination -->
                
              </div>
</div>
<!-- end tabel penjualan  -->



<?=
  $hasil = NULL;
  
  if (isset($_POST['updatestatus'])) {
    include 'closehtml.php';
    $updatestatusid = $_POST['updatestatusid'];
    $orderidedit = $_POST['orderidedit'];
    $row = $koneksi->prepare("
    UPDATE `orderproduk` SET `statusorder` = '$updatestatusid' WHERE `orderproduk`.`idorder` = $orderidedit;       
    ");
    try {
        $row->execute();
        $updates = 'index.php?adminpage=mpenjualan&berhasil_update=yes';
              
        echo '<script>window.location.href="'.$updates.'"</script>';
        }
    catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();      
    }
    
      
  }

  if (isset($_GET['berhasil_update'])) {
    include 'closehtml.php';
    echo '<script>
            swal("Success!", "Status order berhasil diupdate!", "success");
          </script>';
  }

  if (isset($_GET['berhasil_hapus_penjualan'])) {
    include 'closehtml.php';
    echo '<script>
            swal("Success!", "Penjualan Berhasil dihapus!", "success");
          </script>';
  }

  

?>

<!-- hapus penjualan  -->

<?= 

$hasil = NULl;

if (isset($_POST['hapuspenjualan']) && isset($_POST['idorder'])) {
  $idpenjualan = $_POST['idorder'];
  $row = $koneksi->prepare("DELETE FROM `orderproduk` WHERE `orderproduk`.`idorder` = $idpenjualan");
  try {
    if ($row->execute()) {

      $hapus = 'index.php?adminpage=mpenjualan&berhasil_hapus_penjualan=yes';
              
      echo '<script>window.location.href="'.$hapus.'"</script>';
      
    }
   }
   catch (PDOException $e) {
    return 'Error: ' . $e->getMessage();
   }

  
}
?>





<!-- modal input penjualan  -->
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
            action="?adminpage=mpenjualan"
            method="post"
            enctype="multipart/form-data"> 
            <input type="hidden" name="updatestatusid" id="updatestatusid" value="1">
            <input type="hidden" name="orderidedit" id="orderidedit" value="">
        <div class="mt-4 mb-6">
          <!-- Modal title -->
          <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
            Edit Status Penjualan
          </p>
          <!-- Modal description -->
          <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Status ( Selesai diproses / belum )
                </span>
                <select
                  name="statuspenjualan"
                  onchange="document.getElementById('updatestatusid').value=this.value"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                >

                <option value="1">
                    Belum Selesai
                    <!-- jika baru order dan belum dibayarkan tagihan nnya  -->
                </option> 

                <option value="2">
                    Selesai
                    <!-- jika order sudah dibayarkan pelanggan dan diproses pembeli  -->
                </option>
                </select>
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
            name="updatestatus"
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
