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
        $showEn = new process();
        $flag = 1; $msg = $msgClass = "";
       if($_SERVER['REQUEST_METHOD'] == "POST") {
         if(isset($_POST['oldBtn'])) {
           // Validate and Sanitize
           $editOld = $data->iAvoidInject($_POST['editOld']);
           $editOldEn = $data->iAvoidInject($_POST['editOldEn']);
           // Check if empty
           if(empty($editOld) || empty($editOldEn)) {
             $flag = 0;
             $msgClass = $edit->iGetMsg('cError');
             $msg = $edit->iGetMsg('empty');
           }
           // Try to update
           if ($flag !== 0) {
             $r = $edit->iUpdateRequirements("old", $editOld, $editOldEn);
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
                     <h4 class="text-center">Old Students Requirements</h4>
                   </div>
                   <div class="box-body">
                     <?php
                        $old = $data->iShowRequirements("requirementsOld");
                        $oldEn = $showEn->iShowRequirements("oldEnProcess");
                      ?>
                      <div class="form-group">
                        <label for="editOld">Requirements</label>
                        <textarea class="form-control" name="editOld" id="editOld" style="height: 150px"><?php echo $old; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="editOldEn">Enrollment Process</label>
                        <textarea class="form-control" name="editOldEn" id="editOldEn" style="height: 150px"><?php echo $oldEn; ?></textarea>
                      </div>
                   </div>
                   <div class="box-footer">
                     <button type="submit" name="oldBtn" class="btn btn-primary">Save Changes</button>
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
          $(".subBtnAdmission").eq(3).addClass("subBtn");
          $("#navAdmission").slideDown('slow');
        })
        $('#editOld').wysihtml5();
        $('#editOldEn').wysihtml5();
       })
     </script>
   </body>
 </html>
