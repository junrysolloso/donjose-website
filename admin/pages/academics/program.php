 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <?php
        session_start();
        require_once '../../../admin/pages/class/content.php';
        $init = new initContents();
        $init->getTitle();
        $init->getStyle();
        require_once '../../../admin/pages/class/data.php';
        $data = new process();
        $addCourse = new process();
        $updateProgram = new process();
        $upload = new process();
        $new = new process();
        $flag = 1; $msgClass = $msg = $t = "";
        if($_SERVER['REQUEST_METHOD'] == "POST") {
          if(isset($_POST['editProgram'])) {
            $targetDir = "../../../upload/gallery/";
            $tmpName = $_FILES['Image']['tmp_name'];
            $imgSize = $_FILES['Image']['size'];
            $imgName = $_FILES['Image']['name'];
            $targetFile = $targetDir .basename($imgName);
            $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
             $programId    = $updateProgram->iAvoidInject($_POST['programId']);
             $programName  = $updateProgram->iAvoidInject($_POST['programName']);
             $programTitle = $updateProgram->iAvoidInject($_POST['programTitle']);
             $programDept  = $updateProgram->iAvoidInject($_POST['programDept']);
             $programDesc  = $updateProgram->iAvoidInject($_POST['programDesc']);
            // Check for special chars
            if($updateProgram->iCheckLettersAll($programName) == 0
              || $updateProgram->iCheckLettersAll($programTitle) == 0
              || $updateProgram->iCheckLettersAll($programDept) == 0) {
              $msgClass = $updateProgram->iGetMsg('cError');
              $msg = $updateProgram->iGetMsg('lAllowed');
              $flag = 0;
            }
            // Check for empty inputs
            if(empty($programName) || empty($programTitle) || empty($programDept) || empty($programDesc)) {
              $msgClass = $updateProgram->iGetMsg('cError');
              $msg = $updateProgram->iGetMsg('empty');
              $flag = 0;
            }
            if(empty($imgName) && $imageName == "") {
              if($flag !== 0) {
                if($updateProgram->iUpdateProgram($programTitle, $programName, $programDesc, $programDept, "", $programId)) {
                  $msgClass = $updateProgram->iGetMsg('cSuccess');
                  $msg = $updateProgram->iGetMsg('sUpdate');
                } else {
                  $msgClass = $updateProgram->iGetMsg('cError');
                  $msg = $updateProgram->iGetMsg('error');
                }
              }
            } else {
              // Check image
              $imgOk = $updateProgram->iCheckImage($tmpName, $targetFile, $imgSize, $fileType);
              $flag = $imgOk['uploadOk'];
              $msg = $imgOk['msg'];
              $msgClass = $imgOk['msgClass'];
              // Try to upload file
              if($flag !== 0) {
                if ($updateProgram->iUpdateProgram($programTitle, $programName, $programDesc, $programDept, $imgName, $programId)) {
                  if (move_uploaded_file($tmpName, $targetFile)) {
                    $msgClass = $updateProgram->iGetMsg('cSuccess');
                    $msg = $updateProgram->iGetMsg('sUpdate');
                  } else {
                    $msgClass = $updateProgram->iGetMsg('cError');
                    $msg = $updateProgram->iGetMsg('error');
                  }
                }
              }
            }
          } elseif (isset($_POST['uploadButton'])) {
            $targetDir = "../../../upload/gallery/";
            $tmpName = $_FILES['Image']['tmp_name'];
            $imgName = $_FILES['Image']['name'];
            $imgSize = $_FILES['Image']['size'];
            $targetFile = $targetDir .basename($imgName);
            $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
            // Validate and sanitize
            $uploadTitle = $upload->iAvoidInject($_POST['uploadTitle']);
            $uploadProgram = $upload->iAvoidInject($_POST['uploadProgram']);
            $uploadDesc = $upload->iAvoidInject($_POST['uploadDesc']);
            // Check if image is empty
            if (empty($imgName)) {
              $flag = 0;
              $msgClass = $addCourse->iGetMsg('cError');
              $msg = $addCourse->iGetMsg('nFile');
            } else {
              // Check image
              $imgOk = $upload->iCheckImage($tmpName, $targetFile, $imgSize, $fileType);
              $flag = $imgOk['uploadOk'];
              $msg = $imgOk['msg'];
              $msgClass = $imgOk['msgClass'];
            }
            // Check for empty input
            if (empty($uploadTitle) || empty($uploadProgram) || empty($uploadDesc)) {
              $flag = 0;
              $msgClass = $addCourse->iGetMsg('cError');
              $msg = $addCourse->iGetMsg('empty');
            }
            // Check for chars
            if($upload->iCheckLettersAll($uploadTitle) === 0 || $upload->iCheckLettersAll($uploadProgram) === 0) {
              $flag = 0;
              $msgClass = $upload->iGetMsg('cError');
              $msg = $upload->iGetMsg('lAllowed');
            }
            // Try to add
            if($flag !== 0) {
              if(move_uploaded_file($tmpName, $targetFile)) {
                $r = $upload->iAddProgramImage($uploadTitle, $uploadDesc, $imgName, $uploadProgram);
                if($r == 1) {
                  $msgClass = $upload->iGetMsg('cSuccess');
                  $msg = $upload->iGetMsg('sUpdate');
                  $flag = 0;
                } else {
                  $msgClass = $upload->iGetMsg('cError');
                  $msg = $upload->iGetMsg('error');
                }
              }
            }
          } else {
            $targetDir = "../../../upload/gallery/";
            $tmpName = $_FILES['Image']['tmp_name'];
            $imgName = $_FILES['Image']['name'];
            $imgSize = $_FILES['Image']['size'];
            $targetFile = $targetDir .basename($imgName);
            $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
            // Validate and sanitize
            $newTitle = $new->iAvoidInject($_POST['newTitle']);
            $newName = $new->iAvoidInject($_POST['newName']);
            $newDesc = $new->iAvoidInject($_POST['newDesc']);
            $newDept = $new->iAvoidInject($_POST['newDept']);
            // Check if image is empty
            if (empty($imgName)) {
              $flag = 0;
              $msgClass = $new->iGetMsg('cError');
              $msg = $new->iGetMsg('nFile');
            } else {
              // Check image
              $imgOk = $new->iCheckImage($tmpName, $targetFile, $imgSize, $fileType);
              $flag = $imgOk['uploadOk'];
              $msg = $imgOk['msg'];
              $msgClass = $imgOk['msgClass'];
            }
            // Check for empty input
            if (empty($newTitle) || empty($newName) || empty($newDept) || empty($newDesc)) {
              $flag = 0;
              $msgClass = $new->iGetMsg('cError');
              $msg = $new->iGetMsg('empty');
            }
            // Check for chars
            if($new->iCheckLettersAll($newTitle) === 0 || $new->iCheckLettersAll($newName) === 0 || $new->iCheckLettersAll($newDept) === 0) {
              $flag = 0;
              $msgClass = $new->iGetMsg('cError');
              $msg = $new->iGetMsg('lAllowed');
            }
            // Try to add
            if($flag !== 0) {
              if(move_uploaded_file($tmpName, $targetFile)) {
                if($new->iAddNewProgram($newTitle, $newName, $newDesc, $imgName, $newDept)) {
                  $msgClass = $new->iGetMsg('cSuccess');
                  $msg = $new->iGetMsg('sAdd');
                  $flag = 0;
                } else {
                  $msgClass = $new->iGetMsg('cError');
                  $msg = $new->iGetMsg('error');
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
               <?php
                  if(isset($_GET['q'])) {
                   // Get all data
                   $p = $data->iAvoidInject($_GET['q']);
                   if ($data->iCheckLettersAll($p) !== 0) {
                     $r  = $data->iGetAllProgram("one",  "", $p);
                     while ($s = $r->fetch_array()) {
                       $t .= '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?q='.$p.'" method="POST" enctype="multipart/form-data">';
                       $t .= '<div class="box box-default">';
                       $t .= '<div class="box-header with-border">';
                       $t .= '<h4 class="text-'.$msgClass.' text-center">'.$msg.'</h4>';
                       $t .= '<center>';
                       $t .= '<a href="course.php?q='.$s["programTitle"].'" class="btn btn-primary">View Courses</a>';
                       $t .= '&nbsp;';
                       $t .= '<a href="gallery.php?q='.$s["programTitle"].'" class="btn btn-primary">View Gallery</a>';
                       $t .= '&nbsp;';
                       $t .= '<a href="#uploadImage" data-toggle="modal" id="uploadModal" class="btn btn-primary">Upload Image</a>';
                       $t .= '&nbsp;';
                       $t .= '<a href="#academicYear" data-toggle="modal" id="academicModal" class="btn btn-primary">New Course</a>';
                       $t .= '&nbsp;';
                       $t .= '<a href="#newProgram" data-toggle="modal" id="newProgramModal" class="btn btn-primary hide">New Program</a>';
                       $t .= '</center>';
                       $t .= '</div>';
                       $t .= '<div class="box-body">';
                       $t .= '<div class="row">';
                       $t .= '<div class="col-sm-3">';
                       $t .= '<div class="form-group">';
                       $t .= 'Program Title';
                       $t .= '<input type="text" class="form-control" name="programTitle" value="'.$s["programTitle"].'">';
                       $t .= '</div>';
                       $t .= '<div class="form-group">';
                       $t .= 'Program Name';
                       $t .= '<input type="text" class="form-control" name="programName" value="'.$s["programName"].'">';
                       $t .= '</div>';
                       $t .= '<div class="form-group">';
                       $t .= 'Department';
                       $t .= '
                        <select class="form-control" name="programDept">
                          <option value="'.$s["deptTitle"].'">'.$s["deptTitle"].'</option>
                        </select>';
                       $t .= '</div>';
                       $t .= '<div class="form-group">';
                       $t .= 'Picture';
                       $t .= '<input type="file" class="form-control" name="Image">';
                       $t .= '</div>';
                       $t .= '</div>';
                       $t .= '<div class="col-sm-9 border-left">';
                       $t .= '<input type="hidden" name="programId" value="'.$s["programId"].'">';
                       $t .= '<div class="form-group">';
                       $t .= '<textarea class="form-control" name="programDesc" id="text1" style="height: 250px">'.$s["programDesc"].'</textarea>';
                       $t .= '</div>';
                       $t .= '<button type="submit" class="btn btn-primary" name="editProgram" value="program">Save Changes</button>';
                       $t .= '</div>';
                       $t .= '</div>';
                       $t .= '</div>';
                       $t .= '<div class="box-footer"></div>';
                       $t .= '</div>';
                       $t .= '</form>';
                     }
                     echo $t;
                   }
                 }
               ?>
             </div>
           <div class="col-sm-1"></div>
         </div>
        </div>
      </div>
      <div class="modal fade" id="academicYear">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="text-center">Select Academic Year</h3>
              <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-2"></div>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <select class="form-control" name="selectYear" id="selectYear">
                        <?php
                          $yFormat = date('m:d:y');
                          $yToday = date('Y', strtotime($yFormat));
                          $yLen = ($yToday - 2015) + 2;
                          for ($i=0; $i < $yLen; $i++) {
                            echo '<option value="'.(2015 + $i).'-'.(2015 + ($i + 1)).'">'.(2015 + $i).'-'.(2015 + ($i + 1)).'</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <button type="button" name="academicButton" id="academicButton" class="btn btn-primary btn-block">Ok</button>
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
      <a href="#addCourse" class="hide" data-toggle="modal" id="addCourseModal"></a>
      <div class="modal fade" id="addCourse">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="text-center" id="addResultCourse"></h4>
              <h3 class="text-center">Add Course</h3>
              <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
            </div>
            <div class="modal-body">
              <form id="addCourseForm">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="aYear">Academic Year</label>
                      <select class="form-control" name="aYear" id="aYear">
                        <option id="optionYear"></option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="addCode">Course Code</label>
                      <input type="text" class="form-control" name="addCode" id="addCode">
                    </div>
                    <div class="form-group">
                      <label for="addLec">Lecture</label>
                      <select class="form-control" name="addLec" id="addLec">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="addLab">Laboratory</label>
                      <select class="form-control" name="addLab" id="addLab">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="addProgram">Program</label>
                      <select class="form-control" name="addProgram" id="addProgram">
                        <option id="optionProgram"></option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="addYear">Year</label>
                      <select class="form-control" name="addYear" id="addYear">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="addSem">Semester</label>
                      <select class="form-control" name="addSem" id="addSem">
                        <option value="1">1</option>
                        <option value="2">2</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="addDesc">Course Description</label>
                      <textarea class="form-control" name="addDesc" id="addDesc" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                      <button type="button" id="addButton" value="add" class="btn btn-primary btn-block">Add</button>
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
      <div class="modal fade" id="uploadImage">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="text-center">Upload Image</h3>
              <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
            </div>
            <div class="modal-body">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=<?php echo $p; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="uploadProgram">Program</label>
                      <select class="form-control" name="uploadProgram">
                        <option id="uploadProgram"></option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="uploadTitle">Title</label>
                      <input type="text" class="form-control" name="uploadTitle" id="uploadTitle">
                    </div>
                    <div class="form-group">
                      <label for="uploadImage">Image</label>
                      <input type="file" class="form-control" name="Image" id="uploadImage">
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="uploadDesc">Description</label>
                      <textarea class="form-control" name="uploadDesc" style="height:150px" id="uploadDesc">Image Caption</textarea>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" name="uploadButton" value="upload" class="btn btn-primary btn-block">Upload</button>
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
      <div class="modal fade" id="newProgram">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="text-center">New Program</h3>
              <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
            </div>
            <div class="modal-body">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=<?php echo $p; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="newTitle">Title</label>
                      <input type="text" class="form-control" name="newTitle" id="newTitle">
                    </div>
                    <div class="form-group">
                      <label for="newName">Name</label>
                      <input type="text" class="form-control" name="newName" id="newName">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="newDept">Department</label>
                      <select class="form-control" name="newDept">
                        <option id="newDept"></option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="newImage">Picture</label>
                      <input type="file" class="form-control" name="Image" id="newImage">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="newDesc">Description</label>
                      <textarea class="form-control" name="newDesc" style="height:150px" id="newDesc">Program Description</textarea>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" name="newButton" value="new" class="btn btn-primary btn-block">Add</button>
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
     </div>
     <?php $init->getScript(); ?>
     <script>
      $(function () {
        $(window).load(function () {
          $(".mainButton").eq(2).addClass("mainBtn");
          var dept = $("input[name='programDept']").val();
          $("#subBtnAcademics" + dept).addClass('subBtn');
          $("#navAcademics").slideDown('slow');
        })
        $("#academicButton").click(function (e) {
          e.preventDefault();
          var p = $("input[name='programTitle']").val();
          var year = $("#selectYear").val();
          $("#optionProgram").val(p);
          $("#optionProgram").text(p);
          $("#optionYear").val(year);
          $("#optionYear").text(year);
          $("#academicModal").trigger('click');
          $("#addCourseModal").trigger('click');
        })
        $("#newProgramModal").click(function () {
          var dept = $("select[name='programDept']").val();
          $("#newDept").val(dept);
          $("#newDept").text(dept);
        })
        $("#uploadModal").click(function () {
          var p = $("input[name='programTitle']").val();
          $("#uploadProgram").val(p);
          $("#uploadProgram").text(p);
        })
        $("#addButton").click(function (e) {
          e.preventDefault();
          var vAYear      = $("select[name='aYear']").val();
          var vAddCode    = $("input[name='addCode']").val();
          var vAddLec     = $("select[name='addLec']").val();
          var vAddLab     = $("select[name='addLab']").val();
          var vAddProgram = $("select[name='addProgram']").val();
          var vAddYear    = $("select[name='addYear']").val();
          var vAddSem     = $("select[name='addSem']").val();
          var vAddDesc    = $("textarea[name='addDesc']").val();
          var query = "?aYear=" + vAYear + "&addCode=" + vAddCode + "&addLec=" + vAddLec +
                      "&addLab=" + vAddLab + "&addProgram=" + vAddProgram + "&addYear=" + vAddYear +
                      "&addSem=" + vAddSem + "&addDesc=" + vAddDesc;
          var page  = "addCourse.php";
          ajaxReq(page, query);
        })
        function ajaxReq(page, query) {
          var ajax = new XMLHttpRequest();
          ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
              var rTxt = ajax.responseText;
              var rDiv = document.getElementById("addResultCourse");
              if (rTxt) {
                rDiv.innerHTML = rTxt;
                $("#addCode").val("");
                $("#addDesc").val("");
                $("#addResultCourse").fadeOut(5000);
              }
            }
          }
          ajax.open('GET', page + query, true);
          ajax.send(null);
        }
        $("#text1").wysihtml5();
        $("#uploadDesc").wysihtml5();
        $("#newDesc").wysihtml5();
       })
     </script>
   </body>
 </html>
