 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <title>Don Jose</title>
     <meta charset="utf-8">
     <meta name="viewport" content = "width = device-width, initial-scale=1">
     <link type="image" rel="icon" href="../upload/images/icon.png">
     <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="../assets/css/adminStyle.css">
     <?php
      require_once '../admin/pages/class/data.php';
      $data = new process();
      $flag = 1; $msgClass = $msg = "";
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['loginBtn'])) {
          // Validate
          $name = $data->iAvoidInject($_POST['username']);
          $pass = $data->iAvoidInject($_POST['password']);
          // Check if empty
          if (empty($name) || empty($pass)) {
            $msgClass = $data->iGetMsg('cError');
            $msg = $data->iGetMsg('empty');
            $flag = 0;
          }
          // Allow only letters
          if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            $msgClass = $data->iGetMsg('cError');
            $msg = $data->iGetMsg('lAllowed');
            $flag = 0;
          }
          // Try to check
          if ($flag !== 0) {
            $r = $data->iCheckUser($name, $pass);
            if ($r !== 0) {
              session_start();
              $_SESSION['userId'] = $r;
              if ($_SESSION['userId']) {
                echo '<script>window.location.href="index.php"</script>';
              }
            } else {
              $msgClass = $data->iGetMsg('cError');
              $msg = $data->iGetMsg('iUser');
            }
          }
        }
      }
    ?>
   </head>
   <body style="overflow-x: hidden">
     <div style="margin-top: 11%">
       <div class="row">
         <div class="col-sm-4"></div>
           <div class="col-sm-4">
             <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
               <div class="box box-default" style="box-shadow: 0px 0px 1px #000">
                <div class="box-header with-border">
                  <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg ?></h4>
                  <h3 class="text-center">User Login</h3>
                </div>
               <div class="box-body">
                 <div class="row">
                   <div class="col-sm-1"></div>
                     <div class="col-sm-10">
                       <div class="form-group">
                         <label for="username">Username</label>
                         <input type="text" class="form-control" name="username" placeholder="Username">
                       </div>
                       <div class="form-group">
                         <label for="password">Password</label>
                         <input type="password" class="form-control" name="password" placeholder="Password">
                       </div>
                       <div class="form-group">
                         <button type="submit" name="loginBtn" class="btn btn-primary center-block">Login</button>
                       </div>
                     </div>
                   <div class="col-sm-1"></div>
                 </div>
               </div>
               <div class="box-footer">
                 <h5 class="text-center">&copy; DJEMFCST 2018</h5>
               </div>
             </div>
           </form>
           </div>
         <div class="col-sm-4"></div>
       </div>
     </div>
   </body>
 </html>
