
<!DOCTYPE html>
 <html lang="zxx">
 
 <head>
     <meta charset="UTF-8">
     <meta name="description" content="Obati Template">
     <meta name="keywords" content="Obati, unica, creative, html">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Obati | Login</title>
 
     <!-- Google Font -->
     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
 
     <!-- Css Styles -->
     <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
     <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
     <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
     <link rel="stylesheet" href="css/nice-select.css" type="text/css">
     <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
     <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
     <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
     <link rel="stylesheet" href="css/style.css" type="text/css">
 </head>


 <body> 
     <!-- Hero Section Begin -->
     <section class="hero" style="margin-top:30px;">
         <div class="container">
             <div class="row">
                 
                 <div class="col-lg-12">
                     <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg" >
                         
                         <div class="checkout__form">
                         <div class="hero__text">
                             
                             <span style="font-size: 30px">Login Admin</span>
                           
                        
                         </div>
                         <form action="admin/ceklogin.php" method="post" name="formlogin">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p><b>Username</b><span>*</span></p>
                                                <input type="text" name="username">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="checkout__input">
                                                <p><b>Password</b><span>*</span></p>
                                                <input type="password" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                             
                            </div>
                         
                         <div class="hero__text">
                             
                            <input type="submit" name="login" class="btn primary-btn" value="Login"></input>
                        
                         </div>
                         </form>
                        </div>
                        
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- Hero Section End -->
 
 
 

    
 
   
 
     <!-- Js Plugins -->
     <script src="js/jquery-3.3.1.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.nice-select.min.js"></script>
     <script src="js/jquery-ui.min.js"></script>
     <script src="js/jquery.slicknav.js"></script>
     <script src="js/mixitup.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/main.js"></script>
     <!-- sweet alert -->
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
     <!-- end sweet alert  -->
     


 
 
 
 </body>
 
 </html>

 <?php 
	if(isset($_GET['status'])){
		if($_GET['status'] == "gagal"){
			echo '
            <script>
                swal("Login gagal!", "Mungkin username atau password salah!", "error");
            </script>
            ';
		}else if($_GET['status'] == "logout"){
			echo '
            <script>
                swal("Success!", "Anda berhasil keluar!", "success");
            </script>
            ';
		}else if($_GET['status'] == "belum_login"){
			echo "Anda harus login untuk mengakses halaman admin";
		}
	}
?>