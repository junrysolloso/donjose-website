 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <?php
        session_start();
        require_once '../../../admin/pages/class/content.php';
        require_once '../../../admin/pages/class/data.php';
        $init = new initContents();
        $init->getTitle();
        $init->getStyle();
        $data = new process();
        $edit = new process();
        $flag = 1; $msg = $msgClass = "";
       if($_SERVER['REQUEST_METHOD'] == "POST") {
         if(isset($_POST['freshmenBtn'])) {
           // Validate and Sanitize
           $editFresh = $data->iAvoidInject($_POST['editFreshmen']);
           // Check if empty
           if(empty($editFresh)) {
             $flag = 0;
             $msgClass = $edit->iGetMsg('cError');
             $msg = $edit->iGetMsg('empty');
           }
           // Try to update
           if ($flag !== 0) {
             $r = $edit->iUpdateRequirements("fresh", $editFresh);
             if ($r == 1) {
               $msgClass = $edit->iGetMsg('cSuccess');
               $msg = $edit->iGetMsg('sUpdate');
             } else {
               $msgClass = $edit->iGetMsg('cError');
               $msg = $edit->iGetMsg('error');
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
               <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                 <div class="box box-default">
                   <div class="box-header with-border">
                     <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg; ?></h4>
                     <h4 class="text-center">Freshmen Requirements</h4>
                   </div>
                   <div class="box-body">
                     <?php $fresh = $data->iShowRequirements("requirementsFresh"); ?>
                     <textarea class="form-control" name="editFreshmen" id="editFreshmen" style="height: 250px"><?php echo $fresh; ?></textarea>
                   </div>
                   <div class="box-footer">
                     <button type="submit" name="freshmenBtn" class="btn btn-primary">Save Changes</button>
                   </div>
                 </div>
               </form>
             </div>
           <div class="col-sm-1"></div>
         </div>
       </div>
      </div>
      <?php
         $init->getScript();
       ?>
     <script>
      $(function () {
        $(window).load(function () {
          $(".mainButton").eq(3).addClass("mainBtn");
          $(".subBtnAdmission").eq(1).addClass("subBtn");
          $("#navAdmission").slideDown('slow');
        })
        $('#editFreshmen').wysihtml5();
       })
     </script>
   </body>
 </html>
