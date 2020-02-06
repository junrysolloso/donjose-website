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
         if(isset($_POST['transBtn'])) {
           // Validate and Sanitize
           $editTrans = $data->iAvoidInject($_POST['editTrans']);
           // Check if empty
           if(empty($editTrans)) {
             $flag = 0;
             $msgClass = $edit->iGetMsg('cError');
             $msg = $edit->iGetMsg('empty');
           }
           // Try to update
           if ($flag !== 0) {
             $r = $edit->iUpdateRequirements("trans", $editTrans);
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
                     <h4 class="text-center">Tranferees Requirements</h4>
                   </div>
                   <div class="box-body">
                     <?php $trans = $data->iShowRequirements("requirementsTrans"); ?>
                     <textarea class="form-control" name="editTrans" id="editTrans" style="height: 250px"><?php echo $trans; ?></textarea>
                   </div>
                   <div class="box-footer">
                     <button type="submit" name="transBtn" class="btn btn-primary">Save Changes</button>
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
          $(".subBtnAdmission").eq(2).addClass("subBtn");
          $("#navAdmission").slideDown('slow');
        })
        $('#editTrans').wysihtml5();
       })
     </script>
   </body>
 </html>
