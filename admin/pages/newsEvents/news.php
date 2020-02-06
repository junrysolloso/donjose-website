 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <?php
        session_start();
        require_once '../../../admin/pages/class/content.php';
        require_once '../../../admin/pages/class/data.php';
        $init = new initContents();
        $upload = new process();
        $init->getTitle();
        $init->getStyle();
        $n = date('m:d:y');
        $today = date('Y-m-d', strtotime($n));
        $flag = 1; $imgClass = ""; $msg = "";
       if($_SERVER["REQUEST_METHOD"] == "POST") {
         if (isset($_POST['eventBtn'])) {
           $targetDir = "../../../upload/gallery/";
           $tmpName = $_FILES['Image']['tmp_name'];
           $imgName = $_FILES['Image']['name'];
           $imgSize = $_FILES['Image']['size'];
           $targetFile = $targetDir .basename($imgName);
           $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
           // Validate and sanitize
           $eventTitle = $upload->iAvoidInject($_POST['eventTitle']);
           $eventDate = $upload->iAvoidInject($_POST['eventDate']);
           $eventDesc = $upload->iAvoidInject($_POST['eventDesc']);
           // Check if image is empty
           if (empty($imgName)) {
             $flag = 0;
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('nFile');
           } else {
             // Check image
             $imgOk = $upload->iCheckImage($tmpName, $targetFile, $imgSize, $fileType);
             $flag = $imgOk['uploadOk'];
             $msg = $imgOk['msg'];
             $msgClass = $imgOk['msgClass'];
           }
           // Check for empty input
           if (empty($eventTitle) || empty($eventDate) || empty($eventDesc)) {
             $flag = 0;
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('empty');
           }
           // Check for chars
           if($upload->iCheckLettersAll($eventTitle) === 0) {
             $flag = 0;
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('lAllowed');
           }
           // Try to add
           if($flag !== 0) {
             if(move_uploaded_file($tmpName, $targetFile)) {
               if($upload->iAddNews($eventTitle, $today, $eventDesc, $imgName, $today)) {
                 $msgClass = $upload->iGetMsg('cSuccess');
                 $msg = $upload->iGetMsg('sAdd');
                 $flag = 0;
               } else {
                 $msgClass = $upload->iGetMsg('cError');
                 $msg = $upload->iGetMsg('error');
               }
             }
           }
         } elseif(isset($_POST['editBtn'])) {
           $targetDir = "../../../upload/gallery/";
           $tmpName = $_FILES['Image']['tmp_name'];
           $imgSize = $_FILES['Image']['size'];
           $imgName = $_FILES['Image']['name'];
           $targetFile = $targetDir .basename($imgName);
           $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
            $editTitle    = $upload->iAvoidInject($_POST['editTitle']);
            $editDate  = $upload->iAvoidInject($_POST['editDate']);
            $editDesc = $upload->iAvoidInject($_POST['editDesc']);
            $eventId = $upload->iAvoidInject($_POST['eventId']);
           // Check for special chars
           if($upload->iCheckLettersAll($editTitle) == 0) {
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('lAllowed');
             $flag = 0;
           }
           // Check for empty inputs
           if(empty($editTitle) || empty($editDate) || empty($editDesc)) {
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('empty');
             $flag = 0;
           }
          // Validate int
          if (filter_var($eventId, FILTER_VALIDATE_INT) === false) {
            $msgClass = $upload->iGetMsg('cError');
            $msg = $upload->iGetMsg('iInvalid');
            $flag = 0;
          }
           if(empty($imgName)) {
             if($flag !== 0) {
               if($upload->iUpdateNews($editDate, $editTitle, $editDesc, "", $eventId)) {
                 $msgClass = $upload->iGetMsg('cSuccess');
                 $msg = $upload->iGetMsg('sUpdate');
               } else {
                 $msgClass = $upload->iGetMsg('cError');
                 $msg = $upload->iGetMsg('error');
               }
             }
           } else {
             // Check image
             $imgOk = $upload->iCheckImage($tmpName, $targetFile, $imgSize, $fileType);
             $flag = $imgOk['uploadOk'];
             $msg = $imgOk['msg'];
             $msgClass = $imgOk['msgClass'];
             // Try to upload file
             if($flag !== 0) {
               if(move_uploaded_file($tmpName, $targetFile)) {
                 if($upload->iUpdateNews($editDate, $editTitle, $editDesc, $imgName, $eventId)) {
                   $msgClass = $upload->iGetMsg('cSuccess');
                   $msg = $upload->iGetMsg('sUpdate');
                   $flag = 0;
                 } else {
                   $msgClass = $upload->iGetMsg('cError');
                   $msg = $upload->iGetMsg('error');
                 }
               }
             }
           }
         } else {
           // Validate
           $deleteId = $upload->iAvoidInject($_POST['deleteId']);
           if(empty($deleteId)) {
             $flag = 0;
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('empty');
           }
           // Check chars
           if($upload->iCheckLettersAll($deleteId) === 0) {
             $flag = 0;
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('iInvalid');
           }
           // Validate int
           if(filter_var($deleteId, FILTER_VALIDATE_INT) === false) {
             $flag = 0;
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('iInvalid');
           }
           // Update
           if($flag !== 0) {
             if($upload->iDeleteNews($deleteId)) {
               $msgClass = $upload->iGetMsg('cSuccess');
               $msg = $upload->iGetMsg('sDelete');
             } else {
               $msgClass = $upload->iGetMsg('cError');
               $msg = $upload->iGetMsg('error');
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
         <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg; ?></h4>
         <h4 class="text-center">News List</h4>
         <br>
         <div class="row">
           <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <div class="form-group">
                <div class="input-group-btn">
                  <a href="#newEvent" data-toggle="modal" class="btn btn-primary">Post a News</a>
                </div>
              </div>
             <?php
                $eventsInfo = new process();
                $t  = '<table id="newsTable">';
                $t .= '<thead><tr><th></th></tr></thead>';
                $t .= '<tbody>';
                $f = $eventsInfo->iGetNewsEvents("news");
                while ($r = $f->fetch_array()) {
                  $e = date($r["newsDate"]);
                  $n = date('l M d, Y',strtotime($e));
                  $t .= '<tr><td>';
                  $t .= '<div class="box box-default">';
                  $t .= '<div class="box-header with-border">';
                  $t .= '<h3>'.$r["newsTitle"].'</h3>';
                  $t .= '<h4>'.$n.'</h4>';
                  $t .= '</div>';
                  $t .= '<div class="box-body">';
                  $t .= '<div class="row">';
                  $t .= '<div class="col-sm-3">';
                  $t .= '<img src="../../../upload/gallery/'.$r["newsImage"].'" height="200px" width="100%">';
                  $t .= '</div>';
                  $t .= '<div class="col-sm-9">';
                  $t .= '<input type="hidden" id="title'.$r["newsId"].'" value="'.$r["newsTitle"].'">';
                  $t .= '<input type="hidden" id="date'.$r["newsId"].'" value="'.$r["newsDate"].'">';
                  $t .= '<textarea id="desc'.$r["newsId"].'" class="hide">'.$r["newsDesc"].'</textarea>';
                  $t .= '<p class="text-justify">'.$r["newsDesc"].'</p>';
                  $t .= '</div>';
                  $t .= '</div>';
                  $t .= '</div>';
                  $t .= '<div class="box-footer">';
                  $t .= '<a href="#" class="btn btn-primary edit" id="'.$r["newsId"].'">Edit Content</a>';
                  $t .= '&nbsp;';
                  $t .= '<a href="#" class="btn btn-danger remove" id="'.$r["newsId"].'">Remove</a>';
                  $t .= '</div>';
                  $t .= '</div>';
                  $t .= '</td></tr>';
                }
                $t .= '</tbody>';
                $t .= '</table>';
                echo $t;
              ?>
            </div>
           <div class="col-sm-1"></div>
         </div>
       </div>
     </div>
     <div class="modal fade" id="newEvent">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Add News</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-sm-3"></div>
                 <div class="col-sm-6">
                   <div class="form-group">
                     <label for="eventTitle">News Title</label>
                     <input type="text" class="form-control" name="eventTitle" id="eventTitle">
                   </div>
                   <div class="form-group hide">
                     <label for="eventDate">News Date</label>
                     <input type="text" class="form-control" name="eventDate" id="eventDate" value="none">
                   </div>
                   <div class="form-group">
                     <label for="eventPic">Choose Image</label>
                     <input type="file" class="form-control" name="Image" id="eventPic">
                   </div>
                 </div>
                 <div class="col-sm-3"></div>
                 <div class="col-sm-12">
                   <div class="form-group">
                     <label for="eventDesc">News Description</label>
                     <textarea class="form-control" name="eventDesc" id="eventDesc"style="height: 400px"></textarea>
                   </div>
                   <div class="form-group">
                     <button type="submit" name="eventBtn" value="edit" class="btn btn-primary btn-block">Post</button>
                   </div>
                 </div>
               </div>
             </form>
           </div>
           <div class="modal-footer">
             <h5 class="text-center">&copy; DJEMFCST 2018</h5>
           </div>
         </div>
       </div>
     </div>
     <a href="#editEvent" data-toggle="modal" class="hide" id="editModal"></a>
     <div class="modal fade" id="editEvent">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Update News</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-sm-3"></div>
                 <div class="col-sm-6">
                   <div class="form-group hide">
                     <label for="eventId">News Id</label>
                     <input type="hidden" class="form-control" name="eventId" id="eventId">
                   </div>
                   <div class="form-group">
                     <label for="editTitle">News Title</label>
                     <input type="text" class="form-control" name="editTitle" id="editTitle">
                   </div>
                   <div class="form-group">
                     <label for="editDate">News Date</label>
                     <input type="date" class="form-control" name="editDate" id="editDate">
                   </div>
                   <div class="form-group">
                     <label for="editImage">Choose Image</label>
                     <input type="file" class="form-control" name="Image" id="editImage">
                   </div>
                 </div>
                 <div class="col-sm-3"></div>
                 <div class="col-sm-12">
                   <div class="form-group">
                     <label for="editDesc">News Description</label>
                     <textarea class="form-control" name="editDesc" id="editDesc"style="height: 250px"></textarea>
                   </div>
                   <div class="form-group">
                     <button type="submit" name="editBtn" value="edit" class="btn btn-primary btn-block">Update</button>
                   </div>
                 </div>
               </div>
             </form>
           </div>
           <div class="modal-footer">
             <h5 class="text-center">&copy; DJEMFCST 2018</h5>
           </div>
         </div>
       </div>
     </div>
     <a href="#deleteCourse" class="hide" data-toggle="modal" id="deleteModal"></a>
     <div class="modal fade" id="deleteCourse">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Are you sure?</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <div class="row">
               <div class="col-sm-2"></div>
                 <div class="col-sm-8">
                   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                     <div class="form-group hide">
                       <label for="deleteId">Course Id</label>
                       <input type="hidden" class="form-control" name="deleteId" id="deleteId">
                     </div>
                     <button type="submit" name="deleteButton" value="delete" class="btn btn-danger btn-block">Ok</button>
                   </form>
                 </div>
               <div class="col-sm-2"></div>
             </div>
           </div>
           <div class="modal-footer">
             <h5 class="text-center">&copy; DJEMFCST 2018</h5>
           </div>
         </div>
       </div>
     </div>
     <?php $init->getScript() ?>
     <script>
      $(function () {
        $(window).load(function () {
          $(".mainButton").eq(6).addClass("mainBtn");
          $(".subBtnNewsEvents").eq(0).addClass("subBtn");
          $("#navNews").slideDown('slow');
        })
        $(".edit").click(function (e) {
          e.preventDefault();
          var id = $(this).attr("id");
          var title = $("#title" + id).val();
          var date = $("#date" + id).val();
          var desc = $("#desc" + id).text();
          $("#editTitle").val(title);
          $("#editDate").val(date);
          $("#editDesc").val(desc);
          $("#eventId").val(id);
          $("#editModal").trigger('click');
        })
        $(".remove").click(function (e) {
          e.preventDefault();
          var id = $(this).attr("id");
          $("#deleteId").val(id);
          $("#deleteModal").trigger('click');
        })
        $("#newsTable").DataTable({
          'paging'       : true,
          'lengthChange' : false,
          'searching'    : false,
          'ordering'     : false,
          'info'         : false,
          'autoWidth'    : false
        })
        $('#eventDesc').wysihtml5();
       })
     </script>
   </body>
 </html>
