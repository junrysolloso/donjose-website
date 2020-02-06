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
        $flag = 1; $msgClass = $msg = "";
       if($_SERVER["REQUEST_METHOD"] == "POST") {
         $targetDir = "../../../upload/faculty/";
         $tmpName = $_FILES["Image"]["tmp_name"];
         $imgSize = $_FILES["Image"]["size"];
         $imgName = $_FILES['Image']['name'];
         $targetFile = $targetDir .basename($imgName);
         $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
         $name = $data->iAvoidInject($_POST['messageName']);
         $pos  = $data->iAvoidInject($_POST['messagePos']);
         $desc = $data->iAvoidInject($_POST['messageDesc']);
         // Check for special chars
         if($data->iCheckLetters($name) == 0 || $data->iCheckLetters($pos) == 0) {
           $msgClass = $data->iGetMsg('cError');
           $msg = $data->iGetMsg('lAllowed');
           $flag = 0;
         }
         // Check for empty inputs
         if(empty($name) || empty($pos) || empty($desc)) {
           $msgClass = $data->iGetMsg('cError');
           $msg = $data->iGetMsg('empty');
           $flag = 0;
         }
         // Check whether image input is empty
         if(empty($imgName)) {
           if($flag !== 0) {
             if($data->iUpdateMessageInfo($name, $pos, $desc, "")) {
               $msgClass = $data->iGetMsg('cSuccess');
               $msg = $data->iGetMsg('sUpdate');
             } else {
               $msgClass = $data->iGetMsg('cError');
               $msg = $data->iGetMsg('error');
             }
           }
         } else {
           // Check image
           $imgOk = $data->iCheckImage($tmpName, $targetFile, $imgSize, $fileType);
           $flag = $imgOk['uploadOk'];
           $msg = $imgOk['msg'];
           $msgClass = $imgOk['msgClass'];
           // Try to upload file
           if($flag !== 0) {
             if($data->iUpdateMessageInfo($name, $pos, $desc, $imgName)) {
               if(move_uploaded_file($tmpName, $targetFile)) {
                 $msgClass = $data->iGetMsg('cSuccess');
                 $msg = $data->iGetMsg('sUpdate');
               } else {
                 $msgClass = $data->iGetMsg('cError');
                 $msg = $data->iGetMsg('error');
               }
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
               <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                 <div class="box box-default">
                  <div class="box-header with-border">
                    <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg ?></h4>
                    <h4 class="text-center">Welcome Message</h4>
                  </div>
                 <div class="box-body">
                 <?php
                   $image  = new process();
                   $getImg = $image->getMessageData();
                   $r      = $getImg->fetch_array();
                 ?>
                   <div class="row">
                     <div class="col-sm-3">
                       <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="messageName" value="<?php echo stripslashes($r[1]) ?>">
                       </div>
                       <div class="form-group">
                         <label for="pos">Position</label>
                         <input type="text" class="form-control" id="pos" name="messagePos" value="<?php echo stripslashes($r[0]) ?>">
                       </div>
                       <div class="form-group">
                        <label for="pic">Picture</label>
                        <input type="file" class="form-control file-bg" id="pic" name="Image">
                      </div>
                     </div>
                     <div class="col-sm-9 border-left">
                     <div class="form-group">
                       <label for="texteditMessage">Message Description</label>
                       <textarea class="form-control" name="messageDesc" id="texteditMessage" style="height: 250px"><?php echo stripslashes($r[2]) ?></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary" name="submit">Save Changes</button>
                    </div>
                   </div>
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
          $(".subBtnAbout").eq(0).addClass("subBtn");
          $("#navAbout").slideDown('slow');
        })
        $('#texteditMessage').wysihtml5();
       })
     </script>
   </body>
 </html>
