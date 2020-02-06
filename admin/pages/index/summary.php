 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <?php
        session_start();
        require_once '../../../admin/pages/class/content.php';
        require_once '../../../admin/pages/class/data.php';
        $init = new initContents();
        $data = new process();
        $init->getTitle();
        $init->getStyle();
        $flag = 1; $msg = $msgClass = "";
        if($_SERVER['REQUEST_METHOD'] == "POST") {
          if (isset($_POST['editSum'])) {
            // Validate
            $faculty = $data->iAvoidInject($_POST['faculty']);
            $parttime = $data->iAvoidInject($_POST['parttime']);
            $staff = $data->iAvoidInject($_POST['staff']);
            // Check if empty
            if(empty($faculty) || empty($parttime) || empty($staff)) {
              $msgClass = $data->iGetMsg('cError');
              $msg = $data->iGetMsg('empty');
              $flag = 0;
            }
            // Validate int
            if (filter_var($faculty ,FILTER_VALIDATE_INT) === false
               || filter_var($parttime ,FILTER_VALIDATE_INT) === false
               || filter_var($staff ,FILTER_VALIDATE_INT) === false) {
              $msgClass = $data->iGetMsg('cError');
              $msg = $data->iGetMsg('iInvalid');
              $flag = 0;
            }
            // Try to update
            if($flag !== 0) {
              if($data->iUpdateSum($faculty, $parttime, $staff)) {
                $msgClass = $data->iGetMsg('cSuccess');
                $msg = $data->iGetMsg('sUpdate');
              } else {
                $msgClass = $data->iGetMsg('cError');
                $msg = $data->iGetMsg('error');
              }
            }
          }
        }
       $r = $data->iGetSummary();
       if ($r) {
         $f = $r->fetch_array();
       }
      ?>
   </head>
   <body>
     <?php $init->getHeader() ?>
     <div class="container-fluid">
       <div class="container">
         <div class="row">
           <div class="col-sm-1"></div>
             <div class="col-sm-10">
               <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                 <div class="box box-default">
                   <div class="box-header with-border">
                     <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg ?></h4>
                     <h4 class="text-center">Summary Data</h4>
                   </div>
                   <div class="box-body">
                     <div class="form-group">
                       <label for="faculty">Faculty</label>
                       <input class="form-control" type="text" name="faculty" id="faculty" value="<?php echo $f[1] ?>">
                     </div>
                     <div class="form-group">
                       <label for="parttime">Part-Time</label>
                       <input class="form-control" type="text" name="parttime" id="parttime" value="<?php echo $f[3] ?>">
                     </div>
                     <div class="form-group">
                       <label for="staff">Staff</label>
                       <input class="form-control" type="text" name="staff" id="staff" value="<?php echo $f[2] ?>">
                     </div>
                   </div>
                   <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="editSum" id="editSum">Save Changes</button>
                   </div>
                 </div>
               </form>
             </div>
           <div class="col-sm-1"></div>
         </div>
       </div>
      <?php
         $init->getFooter();
         $init->getScript();
       ?>
     </div>
     <script>
      $(function () {
        $(window).load(function () {
          $(".mainButton").eq(0).addClass("mainBtn");
          $(".subBtnHome").eq(0).addClass("subBtn");
          $("#navHome").slideDown('slow');
        })
       })
     </script>
   </body>
 </html>
