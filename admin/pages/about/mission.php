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
         $desc = $data->iAvoidInject($_POST['missionDesc']);
         // Check if empty
         if(empty($desc)) {
           $msgClass = $data->iGetMsg('cError');
           $msg = $data->iGetMsg('empty');
           $flag = 0;
         }
         // Try to update
         if($flag !== 0) {
           $r = $data->iUpdateMissionVision("editMission", $desc);
           if($r == 1) {
             $msgClass = $data->iGetMsg('cSuccess');
             $msg = $data->iGetMsg('sUpdate');
           } else {
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('error');
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
                     <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg ?></h4>
                     <h4 class="text-center">Mission</h4>
                   </div>
                   <div class="box-body">
                     <h4 id="rDveditMission"></h4>
                     <?php
                        $mission = new process();
                        $r = $mission->getSchoolData("mission");
                        $f = $r->fetch_array();
                      ?>
                      <div class="form-group">
                        <textarea class="form-control" name="missionDesc" id="texteditMission" style="height: 250px"><?php echo $f[0]; ?></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary" id="editMission">Save Changes</button>
                   </div>
                   <div class="box-footer"></div>
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
          $(".mainButton").eq(1).addClass("mainBtn");
          $(".subBtnAbout").eq(1).addClass("subBtn");
          $("#navAbout").slideDown('slow');
        })
        $('#texteditMission').wysihtml5();
       })
     </script>
   </body>
 </html>