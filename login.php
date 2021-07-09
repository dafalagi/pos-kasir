<?php 

require_once("config/mainconfig.php");

if(isset($_SESSION['user'])) {
	header('location:index.php');
}

$error = "";
if(isset($_POST['login'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM pegawai WHERE username=:username";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":username" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["user"] = $user['username'];
            // login sukses, alihkan ke halaman timeline
            header("Location: index.php");
        } else {
            $error = "pass";
        }
    } else {
        $error = "akun";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>CORK Admin Template - Login Page</title>
    <link rel="icon" type="image/x-icon" href="<?php echo $cfg_baseurl ?>/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="<?php echo $cfg_baseurl ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $cfg_baseurl ?>/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $cfg_baseurl ?>/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo $cfg_baseurl ?>/assets/css/elements/alert.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cfg_baseurl ?>/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $cfg_baseurl ?>/assets/css/forms/switches.css">
    <link href="<?php echo $cfg_baseurl ?>/assets/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $cfg_baseurl ?>/assets/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $cfg_baseurl ?>/assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
</head>
<body class="form">
   

<div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Masuk Kasir</h1>
                        <p class="">Gunakan kredensial yang telah diberikan.</p>
                        <?php if($error == "akun") { ?>
                            <div class="alert alert-gradient" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                <strong>Akun Tidak Terdaftar!</strong>.</button>
                            </div> 
                        <?php } ?>
                        
                        <?php if($error == "pass") { ?>
                            <div class="alert alert-gradient" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                <strong>Password Salah!</strong>.</button>
                            </div> 
                        <?php } ?>
                        <form class="text-left" method=POST>
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USERNAME</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" name="username" type="text" class="form-control" placeholder="e.g John_Doe">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        <a href="auth_pass_recovery_boxed.html" class="forgot-pass-link">Forgot Password?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" name="login" class="btn btn-primary" value="">Log In</button>
                                    </div>
                                </div>
                                <br>
                                <div  class="text-center">
                                    <span>Dibuat oleh kelompok Fedora</span>
                                </div>

                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>
</body>                       
      <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
  <script src="<?php echo $cfg_baseurl ?>/assets/js/libs/jquery-3.1.1.min.js"></script>
  <script src="<?php echo $cfg_baseurl ?>/assets/bootstrap/js/popper.min.js"></script>
  <script src="<?php echo $cfg_baseurl ?>/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo $cfg_baseurl ?>/assets/plugins/sweetalerts/sweetalert2.min.js"></script>
  <script src="<?php echo $cfg_baseurl ?>/assets/plugins/sweetalerts/custom-sweetalert.js"></script>

  <!-- END GLOBAL MANDATORY SCRIPTS -->
  <script src="<?php echo $cfg_baseurl ?>/assets/js/authentication/form-2.js"></script>
</html>