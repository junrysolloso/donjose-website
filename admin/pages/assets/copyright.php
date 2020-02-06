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
         if (isset($_POST['submit'])) {
           $desc = $data->iAvoidInject($_POST['editCopyright']);
           // Check if empty
           if(empty($desc)) {
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('empty');
             $flag = 0;
           }
           // Try to update
           if($flag !== 0) {
             $r = $data->iUpdateAssets("editCopyright", $desc);
             if($r == 1) {
               $msgClass = $data->iGetMsg('cSuccess');
               $msg = $data->iGetMsg('sUpdate');
             } else {
               $msgClass = $data->iGetMsg('cError');
               $msg = $data->iGetMsg('error');
             }
           }
         }
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
               <div class="box box-default">
                 <div class="box-header with-border">
                   <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg; ?></h4>
                   <h4 class="text-center">Disclaimer</h4>
                 </div>
                 <div class="box-body">
                   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                     <?php
                     $copyright = new process();
                     $copyTxt = $copyright->iShowAssets("copy");
                     ?>
                     <div class="form-group">
                       <textarea class="form-control" name="editCopyright" id="editCopyright" style="height: 250px"><?php echo $copyTxt; ?></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                   </form>
                 </div>
                 <div class="box-footer"></div>
               </div>
             </div>
           <div class="col-sm-1"></div>
         </div>
       </div>
      <?php $init->getScript(); ?>
     </div>
     <script>
      $(function () {
        $(window).load(function () {
          $(".mainButton").eq(7).addClass("mainBtn");
          $(".subBtnAssets").eq(0).addClass("subBtn");
          $("#navAssets").slideDown('slow');
        })
        $('#editCopyright').wysihtml5();
       })
     </script>
   </body>
 </html>