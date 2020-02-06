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
         if (isset($_POST['orgBtn'])) {
           $targetDir = "../../../upload/gallery/";
           $tmpName = $_FILES['Image']['tmp_name'];
           $imgName = $_FILES['Image']['name'];
           $imgSize = $_FILES['Image']['size'];
           $targetFile = $targetDir .basename($imgName);
           $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
           // Validate and sanitize
           $orgName = $upload->iAvoidInject($_POST['orgName']);
           $orgCat = $upload->iAvoidInject($_POST['orgCat']);
           $orgDesc = $upload->iAvoidInject($_POST['orgDesc']);
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
           if (empty($orgName) || empty($orgCat) || empty($orgDesc)) {
             $flag = 0;
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('empty');
           }
           // Check for chars
           if($upload->iCheckLettersAll($orgName) === 0 || $upload->iCheckLettersAll($orgCat) === 0) {
             $flag = 0;
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('lAllowed');
           }
           // Try to add
           if($flag !== 0) {
             if(move_uploaded_file($tmpName, $targetFile)) {
               if($upload->iAddOrg($orgName, $orgDesc, $imgName, $orgCat)) {
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
            $editOrg = "Organizations";
            $editId = $upload->iAvoidInject($_POST['editId']);
            $editName = $upload->iAvoidInject($_POST['editName']);
            $editDesc = $upload->iAvoidInject($_POST['editDesc']);
           // Check for special chars
           if($upload->iCheckLettersAll($editName) == 0) {
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('lAllowed');
             $flag = 0;
           }
           // Check for empty inputs
           if(empty($editId) || empty($editName) || empty($editDesc)) {
             $msgClass = $upload->iGetMsg('cError');
             $msg = $upload->iGetMsg('empty');
             $flag = 0;
           }
          // Validate int
          if (filter_var($editId, FILTER_VALIDATE_INT) === false) {
            $msgClass = $upload->iGetMsg('cError');
            $msg = $upload->iGetMsg('iInvalid');
            $flag = 0;
          }
           if(empty($imgName)) {
             if($flag !== 0) {
               if($upload->iUpdateOrg($editName, $editDesc, "", $editOrg, $editId)) {
                 $msgClass = $upload->iGetMsg('cSuccess');
                 $msg = $upload->iGetMsg('sUpdate');
               } else {
                 $msgClass = $upload->iGetMsg('cError');
                 $msg = $upload->iGetMsg('error');
               }
             }
           } else {
             // Check image
             $imgOk = $upload->iCheckImage($tmpName, $targetFile, $imgName, $fileType);
             $flag = $imgOk['uploadOk'];
             $msg = $imgOk['msg'];
             $msgClass = $imgOk['msgClass'];
             // Try to upload file
             if($flag !== 0) {
               if(move_uploaded_file($tmpName, $targetFile)) {
                 if($upload->iUpdateOrg($editName, $editDesc, $imgName, $editOrg, $editId)) {
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
             if($upload->iDeleteOrg($deleteId) !== false) {
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
         <h4 class="text-center">Organizations</h4>
         <br>
         <div class="row">
           <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <div class="form-group">
                <div class="input-group-btn">
                  <a href="#newOrg" data-toggle="modal" class="btn btn-primary">Post New</a>
                </div>
              </div>
             <?php
                $org = new process();
                $t  = '<table id="orgTable">';
                $t .= '<thead><tr><th></th></tr></thead>';
                $t .= '<tbody>';
                $f = $org->iGetStudentActivity("Organizations");
                while ($r = $f->fetch_array()) {
                  $t .= '<tr><td>';
                  $t .= '<div class="box box-default">';
                  $t .= '<div class="box-header with-border">';
                  $t .= '<h4 class="text-center">'.$r["activityName"].'</h4>';
                  $t .= '</div>';
                  $t .= '<div class="box-body">';
                  $t .= '<div class="row">';
                  $t .= '<div class="col-sm-3">';
                  $t .= '<img src="../../../upload/gallery/'.$r["activityImage"].'" height="200px" width="100%">';
                  $t .= '</div>';
                  $t .= '<div class="col-sm-9">';
                  $t .= '<input type="hidden" id="name'.$r["activityId"].'" value="'.$r["activityName"].'">';
                  $t .= '<textarea class="hide" id="desc'.$r["activityId"].'">'.$r["activityDesc"].'</textarea>';
                  $t .= '<p class="text-justify">'.$r["activityDesc"].'</p>';
                  $t .= '</div>';
                  $t .= '</div>';
                  $t .= '</div>';
                  $t .= '<div class="box-footer">';
                  $t .= '<a href="#" class="btn btn-primary edit" id="'.$r["activityId"].'">Edit Content</a>';
                  $t .= '&nbsp;';
                  $t .= '<a href="#" class="btn btn-danger remove" id="'.$r["activityId"].'">Remove</a>';
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
     <div class="modal fade" id="newOrg">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">New</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-sm-2"></div>
                 <div class="col-sm-8">
                   <div class="form-group">
                     <label for="orgName">Name</label>
                     <input type="text" class="form-control" name="orgName" id="orgName">
                   </div>
                   <div class="form-group hide">
                     <label for="orgCat">Category</label>
                     <input type="hidden" class="form-control" name="orgCat" id="orgCat" value="Organizations">
                   </div>
                   <div class="form-group">
                     <label for="orgImage">Choose Image</label>
                     <input type="file" class="form-control" name="Image" id="orgImage">
                   </div>
                 </div>
                 <div class="col-sm-2"></div>
                 <div class="col-sm-12">
                   <div class="form-group">
                     <label for="orgDesc">Description</label>
                     <textarea class="form-control" name="orgDesc" id="orgDesc"style="height: 150px"></textarea>
                   </div>
                   <div class="form-group">
                     <button type="submit" name="orgBtn" value="edit" class="btn btn-primary btn-block add">Post</button>
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
     <a href="#editOrg" data-toggle="modal" class="hide" id="editModal"></a>
     <div class="modal fade" id="editOrg">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Update</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-sm-3"></div>
                 <div class="col-sm-6">
                   <div class="form-group hide">
                     <label for="editId">Id</label>
                     <input type="hidden" class="form-control" name="editId" id="editId">
                   </div>
                   <div class="form-group">
                     <label for="editName">Title</label>
                     <input type="text" class="form-control" name="editName" id="editName">
                   </div>
                   <div class="form-group">
                     <label for="editImage">Choose Image</label>
                     <input type="file" class="form-control" name="Image" id="editImage">
                   </div>
                 </div>
                 <div class="col-sm-3"></div>
                 <div class="col-sm-12">
                   <div class="form-group">
                     <label for="editDesc">Description</label>
                     <textarea class="form-control" name="editDesc" id="editDesc"style="height: 400px"></textarea>
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
                       <label for="deleteId">Id</label>
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
          $(".mainButton").eq(5).addClass("mainBtn");
          $(".subBtnStudentLife").eq(2).addClass("subBtn");
          $("#navStudent").slideDown('slow');
        })
        $(".edit").click(function (e) {
          e.preventDefault();
          var id = $(this).attr("id");
          var name = $("#name" + id).val();
          var desc = $("#desc" + id).val();
          $("#editName").val(name);
          $("#editDesc").val(desc);
          $("#editId").val(id);
          $("#editModal").trigger('click');
        })
        $(".remove").click(function (e) {
          e.preventDefault();
          var id = $(this).attr("id");
          $("#deleteId").val(id);
          $("#deleteModal").trigger('click');
        })
        $("#orgTable").DataTable({
          'paging'      : true,
      		'lengthChange': false,
      		'searching'   : false,
      		'ordering'    : false,
      		'info'        : false,
      		'autoWidth'   : false
        })
        $('#orgDesc').wysihtml5();
       })
     </script>
   </body>
 </html>
