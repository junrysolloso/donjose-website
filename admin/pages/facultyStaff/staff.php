 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <?php
        session_start();
        require_once '../../../admin/pages/class/content.php';
        require_once '../../../admin/pages/class/data.php';
        $init = new initContents();
        $faculty = new process();
        $data = new process();
        $get = new process();
        $add = new process();
        $init->getTitle();
        $init->getStyle();
        $flag = $count = 1; $imgClass = $msg = $t = "";
       if($_SERVER["REQUEST_METHOD"] == "POST") {
         if(isset($_POST['staffBtn'])) {
           $targetDir = "../../../upload/faculty/";
           $tmpName = $_FILES['Image']['tmp_name'];
           $imgName = $_FILES['Image']['name'];
           $imgSize = $_FILES['Image']['size'];
           $targetFile = $targetDir .basename($imgName);
           $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
           // Validate and sanitize
           $staffName = $data->iAvoidInject($_POST['staffName']);
           $staffPos = $data->iAvoidInject($_POST['staffPos']);
           $staffProgram = $data->iAvoidInject($_POST['staffProgram']);
           $staffQual = $data->iAvoidInject($_POST['staffQual']);
           // Check if image is empty
           if (empty($imgName)) {
             $flag = 0;
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('nFile');
           } else {
             // Check image
             $imgOk = $data->iCheckImage($tmpName, $targetFile, $imgSize, $fileType);
             $flag = $imgOk['uploadOk'];
             $msg = $imgOk['msg'];
             $msgClass = $imgOk['msgClass'];
           }
           // Check for empty input
           if (empty($staffName) || empty($staffPos) || empty($staffProgram) || empty($staffQual)) {
             $flag = 0;
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('empty');
           }
           // Check for chars
           if($data->iCheckLettersAll($staffName) === 0
             || $data->iCheckLettersAll($staffPos) === 0
             || $data->iCheckLettersAll($staffProgram) === 0) {
             $flag = 0;
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('lAllowed');
           }
           // Try to add
           if($flag !== 0) {
             if(move_uploaded_file($tmpName, $targetFile)) {
               if($data->iAddStaff($staffName, $imgName, $staffPos, $staffProgram)) {
                 $r = $get->iGetStaffId();
                 $f = $r->fetch_array();
                 $id = $f[0];
                 if($id !== 0) {
                   if($add->iAddStaffQual($id, $staffQual)) {
                     $msgClass = $data->iGetMsg('cSuccess');
                     $msg = $data->iGetMsg('sAdd');
                     $flag = 0;
                   } else {
                     $msgClass = $data->iGetMsg('cError');
                     $msg = $data->iGetMsg('error');
                   }
                 }
               }
             }
           }
         } elseif (isset($_POST['deleteButton'])) {
           // Avoid inject
           $staffId = $data->iAvoidInject($_POST['deleteId']);
           // Validate int
           if(filter_var($staffId, FILTER_VALIDATE_INT) === false) {
             $flag = 0;
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('iInvalid');
           }
           // Try to delete
           if ($flag !== 0) {
             if ($data->iDeleteStaff($staffId)) {
               if ($get->iDeleteStaffQual($staffId)) {
                 $msgClass = $data->iGetMsg('cSuccess');
                 $msg = $data->iGetMsg('sDelete');
               } else {
                 $msgClass = $data->iGetMsg('cError');
                 $msg = $data->iGetMsg('error');
               }
             }
           }
         } else {
           // Image info
           $targetDir = "../../../upload/faculty/";
           $tmpName = $_FILES['Image']['tmp_name'];
           $imgSize = $_FILES['Image']['size'];
           $imgName = $_FILES['Image']['name'];
           $targetFile = $targetDir .basename($imgName);
           $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
            $editStaffId = $data->iAvoidInject($_POST['editStaffId']);
            $editStaffName = $data->iAvoidInject($_POST['editStaffName']);
            $editStaffPos = $data->iAvoidInject($_POST['editStaffPos']);
            $editStaffProgram = $data->iAvoidInject($_POST['editStaffProgram']);
            $editStaffQual = $data->iAvoidInject($_POST['editStaffQual']);
           // Check for special chars
           if($data->iCheckLetters($editStaffName) == 0
             || $data->iCheckLettersAll($editStaffPos) == 0
             || $data->iCheckLettersAll($editStaffProgram) == 0) {
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('lAllowed');
             $flag = 0;
           }
           // Check for empty inputs
           if(empty($editStaffName) || empty($editStaffPos) || empty($editStaffProgram) || empty($editStaffQual)) {
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('empty');
             $flag = 0;
           }
           if(empty($imgName)) {
             if($flag !== 0) {
               if($add->iUpdateStaff($editStaffName, "", $editStaffPos, $editStaffProgram, $editStaffId)) {
                 if ($get->iUpdateStaffQual($editStaffQual, $editStaffId)) {
                   $msgClass = $data->iGetMsg('cSuccess');
                   $msg = $data->iGetMsg('sUpdate');
                 } else {
                   $msgClass = $data->iGetMsg('cError');
                   $msg = $data->iGetMsg('error');
                 }
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
               if(move_uploaded_file($tmpName, $targetFile)) {
                 if($add->iUpdateStaff($editStaffName, $imgName, $editStaffPos, $editStaffProgram, $editStaffId)) {
                   if ($get->iUpdateStaffQual($editStaffQual, $editStaffId)) {
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
               <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg; ?></h4>
               <h4 class="text-center">Staff Directory</h4>
               <br>
               <div class="box box-default">
                 <div class="box-header with-border">
                   <button data-target="#newStaff" type="button" class="btn btn-primary" data-toggle="modal">New Staff</button>
                 </div>
                   <div class="box-body">
                     <?php
                       $t .= '<table class="table table-hover table-bordered" id="staffTable">';
                       $t .= '<thead class="bg-success">';
                       $t .= '<tr>';
                       $t .= '<th width="5%">No</th>';
                       $t .= '<th width="25%">Name</th>';
                       $t .= '<th width="55%">Assignment</th>';
                       $t .= '<th width="15%" class="text-center">Action</th>';
                       $t .= '</tr>';
                       $t .= '</thead>';
                       $t .= '<tbody>';
                       $f = $faculty->iShowStaff("all", "");
                       while ($s = $f->fetch_array()) {
                         $t .= '<tr>';
                         $t .= '<td>'.$count.'</td>';
                         $t .= '<td><a href="#" class="view" id="'.$s["staffId"].'">'.$s["staffName"].'</a></td>';
                         $t .= '<td>'.$s["staffAssign"].'</td>';
                         $t .= '<td>';
                         $t .= '<a href="#" class="btn btn-primary btn-sm view" id="'.$s["staffId"].'"><i class="fa fa-eye"></i></a>';
                         $t .= '&nbsp;&nbsp;';
                         $t .= '<input type="hidden" id="fName'.$s["staffId"].'" value="'.$s["staffName"].'">';
                         $t .= '<input type="hidden" id="fPos'.$s["staffId"].'" value="'.$s["staffCat"].'">';
                         $t .= '<input type="hidden" id="fProgram'.$s["staffId"].'" value="'.$s["staffAssign"].'">';
                         $t .= '<textarea class="hide" id="fQual'.$s["staffId"].'">'.$s["staffQual"].'</textarea>';
                         $t .= '<a href="#" class="btn btn-primary btn-sm edit" id="'.$s["staffId"].'"><i class="fa fa-pencil"></i></a>';
                         $t .= '&nbsp;&nbsp;';
                         $t .= '<a href="#" class="btn btn-danger btn-sm remove" id="'.$s["staffId"].'"><i class="fa fa-minus"></i></a>';
                         $t .= '</td>';
                         $t .= '</tr>';
                         $count++;
                       }
                       $t .= '</tbody>';
                       $t .= '</table>';
                       echo $t;
                      ?>
                   </div>
                 <div class="box-footer"></div>
               </div>
             </div>
           <div class="col-sm-1"></div>
         </div>
       </div>
     </div>
     <a href="#personalInfoData" class="hide" data-toggle="modal" id="personalInfoModal"></a>
     <div class="modal fade" id="personalInfoData">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Personal Information</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <div id="personalInfo"></div>
           </div>
           <div class="modal-footer">
             <h5 class="text-center">&copy; DJEMFCST 2018</h5>
           </div>
         </div>
       </div>
     </div>
     <div class="modal fade" id="newStaff">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Add new Staff</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
               <div class="row">
                 <div class="col-sm-6">
                   <div class="form-group">
                     <label for="staffName">Name</label>
                     <input type="text" class="form-control" name="staffName" id="staffName">
                   </div>
                   <div class="form-group">
                     <label for="staffPos">Position</label>
                     <select class="form-control" name="staffPos" id="staffPos">
                       <option value="Staff">Staff</option>
                       <option value="Head">Head of Staff</option>
                     </select>
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div class="form-group">
                     <label for="staffProgram">Program</label>
                     <select class="form-control" name="staffProgram" id="staffProgram">
                       <option value="Computer laboratory Incharge">Computer laboratory Incharge</option>
                       <option value="Science Laboratory Incharge">Science Laboratory Incharge</option>
                     </select>
                   </div>
                   <div class="form-group">
                     <label for="staffImage">Picture</label>
                     <input type="file" class="form-control" name="Image" id="staffImage">
                   </div>
                 </div>
                 <div class="col-sm-12">
                   <div class="form-group">
                     <label for="staffQual">Qualifications</label>
                     <textarea class="form-control" name="staffQual" style="height:300px" id="staffQual">Qualifications list</textarea>
                   </div>
                 </div>
                 <div class="col-sm-12">
                   <button type="submit" name="staffBtn" value="new" class="btn btn-primary btn-block">Add</button>
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
     <a href="#deleteFaculty" class="hide" data-toggle="modal" id="deleteModal"></a>
     <div class="modal fade" id="deleteFaculty">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Remove Staff?</h3>
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
                     <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">No</button>
                     <button type="submit" name="deleteButton" value="delete" class="btn btn-danger btn-block">Yes</button>
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
     <a href="#editStaff" class="hide" data-toggle="modal" id="editStaffModal"></a>
     <div class="modal fade" id="editStaff">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Edit Staff</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
               <div class="row">
                 <div class="col-sm-4">
                   <div class="form-group hide">
                     <label for="editStaffId">Id</label>
                     <input type="hidden" class="form-control" name="editStaffId" id="editStaffId">
                   </div>
                   <div class="form-group">
                     <label for="editStaffName">Name</label>
                     <input type="text" class="form-control" name="editStaffName" id="editStaffName">
                   </div>
                   <div class="form-group">
                     <label for="editStaffPos">Position</label>
                     <select class="form-control" name="editStaffPos" id="editStaffPos">
                       <option value="Staff">Staff</option>
                       <option value="Head">Head of Staff</option>
                     </select>
                   </div>
                   <div class="form-group">
                     <label for="editStaffProgram">Program</label>
                     <select class="form-control" name="editStaffProgram" id="editStaffProgram">
                       <option value="Computer laboratory Incharge">Computer laboratory Incharge</option>
                       <option value="Science Laboratory Incharge">Science Laboratory Incharge</option>
                     </select>
                   </div>
                   <div class="form-group">
                     <label for="editStaffImage">Picture</label>
                     <input type="file" class="form-control" name="Image" id="editStaffImage">
                   </div>
                 </div>
                 <div class="col-sm-8">
                   <div class="form-group">
                     <label for="editStaffQual">Qualifications</label>
                     <textarea class="form-control" name="editStaffQual" rows="15" cols="80" id="editStaffQual"></textarea>
                   </div>
                 </div>
                 <div class="col-sm-12">
                   <button type="submit" name="editStaffBtn" value="new" class="btn btn-primary btn-block">Update</button>
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
      <?php
         $init->getScript();
       ?>
     <script>
      $(function () {
        $(window).load(function () {
          $(".mainButton").eq(4).addClass("mainBtn");
          $(".subBtnFacultyStaff").eq(2).addClass("subBtn");
          $("#navFaculty").slideDown('slow');
          $("#staffQual").wysihtml5();
        })
        $(".view").click(function (e) {
          e.preventDefault();
          var id = $(this).attr("id");
          var ajax = new XMLHttpRequest();
          ajax.onreadystatechange = function () {
            if(ajax.readyState == 4) {
              var r = ajax.responseText;
              var d = document.getElementById("personalInfo");
              d.innerHTML = r;
              $("#personalInfoModal").trigger('click');
            }
          }
          var q = "?Id=" + id;
          ajax.open('GET', 'staffOne.php' + q, true);
          ajax.send(null);
        })
        $(".remove").click(function () {
          var id = $(this).attr("id");
          $("#deleteId").val(id);
          $("#deleteModal").trigger('click');
        })
        $(".edit").click(function (e) {
          e.preventDefault();
          var id = $(this).attr("id");
          var name = $("#fName" + id).val();
          var pos = $("#fPos" + id).val();
          var program = $("#fProgram" + id).val();
          var qual = $("#fQual" + id).text();
          $("#editStaffName").val(name);
          $("#editStaffPos").val(pos);
          $("#editStaffQual").text(qual);
          $("#editStaffProgram").val(program);
          $("#editStaffId").val(id);
          $("#editStaffModal").trigger('click');
        })
        $("#staffTable").DataTable({
          'paging'       : false,
          'lengthChange' : false,
          'searching'    : true,
          'ordering'     : false,
          'info'         : false,
          'autoWidth'    : false
        })
       })
     </script>
   </body>
 </html>
