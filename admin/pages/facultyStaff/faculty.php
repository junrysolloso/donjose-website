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
         if(isset($_POST['facultyBtn'])) {
           $targetDir = "../../../upload/faculty/";
           $tmpName = $_FILES['Image']['tmp_name'];
           $imgName = $_FILES['Image']['name'];
           $imgSize = $_FILES['Image']['size'];
           $targetFile = $targetDir .basename($imgName);
           $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
           // Validate and sanitize
           $catName = "Faculty";
           $firstname = $data->iAvoidInject($_POST['firstname']);
           $middlename = $data->iAvoidInject($_POST['middlename']);
           $lastname = $data->iAvoidInject($_POST['lastname']);
           $facultyPos = $data->iAvoidInject($_POST['facultyPos']);
           $facultyDept = $data->iAvoidInject($_POST['facultyDept']);
           $facultyQual = $data->iAvoidInject($_POST['facultyQual']);
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
           if (empty($firstname) || empty($facultyPos) || empty($facultyDept) || empty($facultyQual) || empty($middlename) || empty($lastname)) {
             $flag = 0;
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('empty');
           }
           // Check for chars
           if($data->iCheckLettersAll($firstname) === 0
             || $data->iCheckLettersAll($facultyPos) === 0
             || $data->iCheckLettersAll($facultyDept) === 0
             || $data->iCheckLettersAll($middlename) === 0
             || $data->iCheckLettersAll($lastname) === 0) {
             $flag = 0;
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('lAllowed');
           }
           // Try to add
           if($flag !== 0) {
             if(move_uploaded_file($tmpName, $targetFile)) {
               if($data->iAddFaculty($firstname, $middlename, $lastname, $imgName, $catName, $facultyPos, $facultyDept, $facultyQual)) {
                 $msgClass = $data->iGetMsg('cSuccess');
                 $msg = $data->iGetMsg('sAdd');
                 $flag = 0;
               } else {
                 $msgClass = $data->iGetMsg('cError');
                 $msg = $data->iGetMsg('error');
               }
             }
           }
         } elseif (isset($_POST['deleteButton'])) {
           // Avoid inject
           $facultyId = $data->iAvoidInject($_POST['deleteId']);
           // Validate int
           if(filter_var($facultyId, FILTER_VALIDATE_INT) === false) {
             $flag = 0;
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('iInvalid');
           }
           // Try to delete
           if ($flag !== 0) {
             if ($data->iDeleteFaculty($facultyId)) {
               $msgClass = $data->iGetMsg('cSuccess');
               $msg = $data->iGetMsg('sDelete');
             } else {
               $msgClass = $data->iGetMsg('cError');
               $msg = $data->iGetMsg('error');
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
            $editFacultyId = $data->iAvoidInject($_POST['editFacultyId']);
            $editFirst = $data->iAvoidInject($_POST['editFirst']);
            $editMiddle = $data->iAvoidInject($_POST['editMiddle']);
            $editLast = $data->iAvoidInject($_POST['editLast']);
            $editFacultyPos = $data->iAvoidInject($_POST['editFacultyPos']);
            $editDept = $data->iAvoidInject($_POST['editDept']);
            $editFacultyQual = $data->iAvoidInject($_POST['editFacultyQual']);
            $editCat = $data->iAvoidInject($_POST['editCat']);
           // Check for special chars
           if($data->iCheckLetters($editFirst) == 0
             || $data->iCheckLettersAll($editFacultyPos) == 0
             || $data->iCheckLettersAll($editDept) == 0
             || $data->iCheckLettersAll($editMiddle) == 0
             || $data->iCheckLettersAll($editLast) == 0
             || $data->iCheckLettersAll($editCat) == 0) {
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('lAllowed');
             $flag = 0;
           }
           // Check for empty inputs
           if(empty($editFirst) || empty($editFacultyPos) || empty($editCat) || empty($editDept) || empty($editFacultyQual) || empty($editMiddle) || empty($editLast)) {
             $msgClass = $data->iGetMsg('cError');
             $msg = $data->iGetMsg('empty');
             $flag = 0;
           }
           if(empty($imgName)) {
             if($flag !== 0) {
               if($add->iUpdateFaculty($editFirst, $editMiddle, $editLast, "", $editCat, $editFacultyPos, $editDept, $editFacultyQual, $editFacultyId)) {
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
               if(move_uploaded_file($tmpName, $targetFile)) {
                 if($add->iUpdateFaculty($editFirst, $editMiddle, $editLast, $imgName, $editCat, $editFacultyPos, $editDept, $editFacultyQual, $editFacultyId)) {
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
               <h4 class="text-center">Faculty Directory</h4>
               <br>
               <div class="box box-default">
                 <div class="box-header with-border">
                   <button data-target="#newFaculty" type="button" class="btn btn-primary" data-toggle="modal">New Faculty</button>
                 </div>
                   <div class="box-body">
                     <?php
                       $t .= '<table class="table table-hover table-bordered" id="facultyTable">';
                       $t .= '<thead class="bg-success">';
                       $t .= '<tr>';
                       $t .= '<th width="5%">No</th>';
                       $t .= '<th width="25%">Name</th>';
                       $t .= '<th width="40%">Department</th>';
                       $t .= '<th width="15%">Position</th>';
                       $t .= '<th width="15%" class="text-center">Action</th>';
                       $t .= '</tr>';
                       $t .= '</thead>';
                       $t .= '<tbody>';
                       $f = $faculty->iShowFaculty("Faculty");
                       while ($s = $f->fetch_array()) {
                         $t .= '<tr>';
                         $t .= '<td>'.$count.'</td>';
                         $t .= '<td><a href="#" class="view" id="'.$s["facultyId"].'">'.$s["lastName"].', '.$s["firstName"].' '.$s["middleName"].'.</a></td>';
                         $t .= '<td>'.$s["deptTitle"].'</td>';
                         $t .= '<td>'.$s["posName"].'</td>';
                         $t .= '<td>';
                         $t .= '<a href="#" class="btn btn-primary btn-sm view" id="'.$s["facultyId"].'"><i class="fa fa-eye"></i></a>';
                         $t .= '&nbsp;&nbsp;';
                         $t .= '<input type="hidden" id="fName'.$s["facultyId"].'" value="'.$s["firstName"].'">';
                         $t .= '<input type="hidden" id="mName'.$s["facultyId"].'" value="'.$s["middleName"].'">';
                         $t .= '<input type="hidden" id="lName'.$s["facultyId"].'" value="'.$s["lastName"].'">';
                         $t .= '<input type="hidden" id="fPos'.$s["facultyId"].'" value="'.$s["posName"].'">';
                         $t .= '<input type="hidden" id="fDept'.$s["facultyId"].'" value="'.$s["deptTitle"].'">';
                         $t .= '<textarea class="hide" id="fQual'.$s["facultyId"].'">'.$s["qualDesc"].'</textarea>';
                         $t .= '<a href="#" class="btn btn-primary btn-sm edit" id="'.$s["facultyId"].'"><i class="fa fa-pencil"></i></a>';
                         $t .= '&nbsp;&nbsp;';
                         $t .= '<a href="#" class="btn btn-danger btn-sm remove" id="'.$s["facultyId"].'"><i class="fa fa-minus"></i></a>';
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
     <div class="modal fade" id="newFaculty">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Add Faculty</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
               <div class="row">
                 <div class="col-sm-6">
                   <div class="form-group">
                     <label for="firstname">Firstname</label>
                     <input type="text" class="form-control" name="firstname" id="firstname">
                   </div>
                   <div class="form-group">
                     <label for="middlename">Middlename</label>
                     <input type="text" class="form-control" name="middlename" id="middlename">
                   </div>
                   <div class="form-group">
                     <label for="lastname">Lastname</label>
                     <input type="text" class="form-control" name="lastname" id="lastname">
                   </div>
                 </div>
                 <div class="col-sm-6">
                   <div class="form-group">
                     <label for="facultyDept">Department</label>
                     <select class="form-control" name="facultyDept" id="facultyDept">
                       <?php
                          $dept = new process();
                          $r = $dept->iGetAllDept();
                          while ($f = $r->fetch_array()) {
                            echo '<option value="'.$f["deptTitle"].'">'.$f["deptTitle"].'</option>';
                          }
                        ?>
                     </select>
                   </div>
                   <div class="form-group">
                     <label for="facultyPos">Position</label>
                     <select class="form-control" name="facultyPos" id="facultyPos">
                       <option value="Instructor">Instructor</option>
                       <option value="Dean">Dean</option>
                       <option value="Program Head">Program Head</option>
                     </select>
                   </div>
                   <div class="form-group">
                     <label for="facultyImage">Picture</label>
                     <input type="file" class="form-control" name="Image" id="facultyImage">
                   </div>
                 </div>
                 <div class="col-sm-12">
                   <div class="form-group">
                     <label for="newDesc">Qualifications</label>
                     <textarea class="form-control" name="facultyQual" style="height:250px" id="facultyQual">Qualifications list</textarea>
                   </div>
                 </div>
                 <div class="col-sm-12">
                   <button type="submit" name="facultyBtn" value="new" class="btn btn-primary btn-block">Add</button>
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
             <h3 class="text-center">Remove Faculty?</h3>
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
     <a href="#editFaculty" class="hide" data-toggle="modal" id="editFacultyModal"></a>
     <div class="modal fade" id="editFaculty">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Edit Faculty</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
               <div class="row">
                 <div class="col-sm-4">
                   <div class="form-group hide">
                     <label for="editFacultyId">Id</label>
                     <input type="hidden" class="form-control" name="editFacultyId" id="editFacultyId">
                   </div>
                   <div class="form-group hide">
                     <label for="editCat">Category</label>
                     <input type="hidden" class="form-control" name="editCat" id="editCat" value="Faculty">
                   </div>
                   <div class="form-group">
                     <label for="editFirst">Firstname</label>
                     <input type="text" class="form-control" name="editFirst" id="editFirst">
                   </div>
                   <div class="form-group">
                     <label for="editMiddle">Middlename</label>
                     <input type="text" class="form-control" name="editMiddle" id="editMiddle">
                   </div>
                   <div class="form-group">
                     <label for="editLast">Lastname</label>
                     <input type="text" class="form-control" name="editLast" id="editLast">
                   </div>
                   <div class="form-group">
                     <label for="editFacultyPos">Position</label>
                     <select class="form-control" name="editFacultyPos" id="editFacultyPos">
                       <option value="Instructor">Instructor</option>
                       <option value="Dean">Dean</option>
                       <option value="Program Head">Program Head</option>
                     </select>
                   </div>
                   <div class="form-group">
                     <label for="editDept">Department</label>
                     <select class="form-control" name="editDept" id="editDept">
                       <?php
                          $dept = new process();
                          $r = $dept->iGetAllDept();
                          while ($f = $r->fetch_array()) {
                            echo '<option value="'.$f["deptTitle"].'">'.$f["deptTitle"].'</option>';
                          }
                        ?>
                     </select>
                   </div>
                   <div class="form-group">
                     <label for="editFacultyImage">Picture</label>
                     <input type="file" class="form-control" name="Image" id="editFacultyImage">
                   </div>
                 </div>
                 <div class="col-sm-8">
                   <div class="form-group">
                     <label for="newDesc">Qualifications</label>
                     <textarea class="form-control" name="editFacultyQual" style="height: 413px"id="editFacultyQual"></textarea>
                   </div>
                 </div>
                 <div class="col-sm-12">
                   <button type="submit" name="editFacultyBtn" value="new" class="btn btn-primary btn-block">Update</button>
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
      <?php $init->getScript() ?>
     <script>
      $(function () {
        $(window).load(function () {
          $(".mainButton").eq(4).addClass("mainBtn");
          $(".subBtnFacultyStaff").eq(0).addClass("subBtn");
          $("#navFaculty").slideDown('slow');
          $("#facultyQual").wysihtml5();
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
          ajax.open('GET', 'facultyOne.php' + q, true);
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
          var fname = $("#fName" + id).val();
          var mname = $("#mName" + id).val();
          var lname = $("#lName" + id).val();
          var pos = $("#fPos" + id).val();
          var dept = $("#fDept" + id).val();
          var qual = $("#fQual" + id).text();
          $("#editFirst").val(fname);
          $("#editMiddle").val(mname);
          $("#editLast").val(lname);
          $("#editFacultyPos").val(pos);
          $("#editFacultyQual").text(qual);
          $("#editDept").val(dept);
          $("#editFacultyId").val(id);
          $("#editFacultyModal").trigger('click');
        })
        $("#facultyTable").DataTable({
          'searching'    : true,
          'paging'       : false,
          'lengthChange' : false,
          'ordering'     : false,
          'info'         : false,
          'autoWidth'    : false
        })
       })
     </script>
   </body>
 </html>
