<?php 
 global $kolset;
 $dataset = $koneksi->prepare("SELECT * FROM `setting` ");
 
 try {
    $dataset->execute();
    $kolset = $dataset->fetch();
 } catch (\Throwable $th) {
     //throw $th;
 }
 
?>
<div class="w-full overflow-hidden rounded-lg shadow-xs " style="margin-bottom: 30px;">
    <div class="w-full overflow-x-auto">
              <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <form action="" method="post" enctype="multipart/form-data">
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Email</span>
                <input
                  name="setemail"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  value="<?= $kolset['setemail'] ?>"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nomor WA</span>
                <input
                  name="setphone"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  value="<?= $kolset['setphone'] ?>"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Facebook</span>
                <input
                  name="setfb"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  value="<?= $kolset['setfb'] ?>"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Instagram</span>
                <input
                  name="setig"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  value="<?= $kolset['setig'] ?>"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Twitter</span>
                <input
                  name="settwit"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  value="<?= $kolset['settwit'] ?>"
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Pinterest</span>
                <input
                  name="setpin"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  value="<?= $kolset['setpin'] ?>"
                />
              </label>
              
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Alamat</span>
                <textarea
                  name="setalamat"
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  rows="3"
                  value="<?= $kolset['setalamat'] ?>"
                ><?= $kolset['setalamat'] ?></textarea>
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Icon
                </span>
                <div class="relative">
 
                  <input
                    name="seticon"
                    type="file"
                    class="block w-full pl-20 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    value="Jane Doe"
                  />
                  <button 
                    disabled

                    style="background-image: url('gambarsetting/<?= $kolset['seticon'] ?>');background-size: cover;background-position: center;"
                    class="absolute inset-y-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-l-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  >
                  </button>
                </div>
              </label>

              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Logo
                </span>
                <div class="relative">
 
                  <input
                    name="setlogo"
                    type="file"
                    class="block w-full pl-20 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray form-input"
                    value="Jane Doe"
                  />
                  <button 
                    disabled

                    style="background-image: url('gambarsetting/<?= $kolset['setlogo'] ?>');background-size: cover;background-position: center;"
                    class="absolute inset-y-0 px-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-l-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  >
                  </button>
                </div>
              </label>
              
            </div>
            <div>
                <button
                name="simpanset"
                type="submit"
                  class="px-10 py-4 font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                  Simpan
                </button>
            </div>
            </form>
    </div>
</div>

<?php 

if (isset($_POST['simpanset'])) {
    include 'closehtml.php';


    $setemail = $_POST['setemail'];
    $setphone = $_POST['setphone'];
    $setfb = $_POST['setfb'];
    $setig = $_POST['setig'];
    $settwit = $_POST['settwit'];
    $setpin = $_POST['setpin'];
    $setalamat = $_POST['setalamat'];
    // $seticon = $_FILES['seticon'];
    $setlogo = $_FILES['setlogo']['name'];
    $setlogo_size = $_FILES['setlogo']['size'];


    $seticon = $_FILES['seticon']['name'];
    $seticon_size = $_FILES['seticon']['size'];

    if ($seticon_size > 2097152 && $setlogo_size > 2097152) {
        echo '<script>
                  swal("Gagal!", "Ukuran file tidak boleh lebih dari 2MB!", "error");
              </script>';
    }else{
      if ($seticon != NULL && $setlogo != NULL) {
        $truext = array('png','jpg','jepg');
        $ambilext = explode('.', $seticon); 
        $ekstensi = strtolower(end($ambilext));


        $file_tmp_icon = $_FILES['seticon']['tmp_name'];    // simpan sementara
        $file_tmp_logo = $_FILES['setlogo']['tmp_name'];    // simpan sementara
        $tanggal_upload = md5(date('Y-m-d h:i:s'));
        // Menyatukan angka/huruf acak dengan nama file aslinya
        $seticon_file = $tanggal_upload.'-'.str_replace(' ', '',$seticon);
        $setlogo_file = $tanggal_upload.'-'.str_replace(' ', '',$setlogo);
        

        $upset = $koneksi->prepare("UPDATE 
                `setting` SET 
                    `setlogo` = '$setlogo_file', 
                    `seticon` = '$seticon_file', 
                    `setalamat` = '$setalamat', 
                    `setphone` = '$setphone', 
                    `setemail` = '$setemail', 
                    `setfb` = '$setfb', 
                    `setig` = '$setig', 
                    `settwit` = '$settwit', 
                    `setpin` = '$setpin' 
                WHERE `setting`.`idset` = 1; ");


        if(in_array($ekstensi, $truext) === true)  {
            move_uploaded_file($file_tmp_icon, 'gambarsetting/'.$seticon_file); // simpan file ke folder gambarobat
            move_uploaded_file($file_tmp_logo, 'gambarsetting/'.$setlogo_file); // simpan file ke folder gambarobat

            try {
                $upset->execute();
                $success = 'index.php?adminpage=msetting&berhasil_update_set=yes';
                echo '<script>window.location.href="'.$success.'"</script>';
            } catch (\PDOException $e) {
                $gagal = 'index.php?adminpage=msetting&gagal_update_set=yes';
            
                echo '<script>window.location.href="'.$gagal.'"</script>';
            }

        }
      }else{
        $upset = $koneksi->prepare("UPDATE 
                `setting` SET 
                    
                    `setalamat` = '$setalamat', 
                    `setphone` = '$setphone', 
                    `setemail` = '$setemail', 
                    `setfb` = '$setfb', 
                    `setig` = '$setig', 
                    `settwit` = '$settwit', 
                    `setpin` = '$setpin' 
                WHERE `setting`.`idset` = 1; ");
        try {
          $upset->execute();
          $success = 'index.php?adminpage=msetting&berhasil_update_set=yes';
          echo '<script>window.location.href="'.$success.'"</script>';
        } catch (\PDOException $e) {
            $gagal = 'index.php?adminpage=msetting&gagal_update_set=yes';
        
            echo '<script>window.location.href="'.$gagal.'"</script>';
        }
      }
}



    
}

if (isset($_GET['berhasil_update_set'])) {
    include 'closehtml.php';
    echo '<script>
            swal("Success!", "Pengaturan berhasil diupdate!", "success");
        </script>';
}else if(isset($_GET['gagal_update_set'])){
    include 'closehtml.php';
    echo '<script>
            swal("Gagal!", "Pengaturan gagal diupdate!", "error");
          </script>';
}

?>