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
      $edit = new process();
      $view = new process();
      $get = new process();
      $yFormat = date('m:d:y');
      $yToday = date('Y', strtotime($yFormat));
      $yNext = ($yToday + 1);
      $ayToday = $yToday .'-'. $yNext;
      $flag = 1; $t = $msg = $msgClass = "";
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['editButton'])) {
          // Validate and sanitize
          $editId = $edit->iAvoidInject($_POST['editId']);
          $editCode = $edit->iAvoidInject($_POST['editCode']);
          $editDesc = $edit->iAvoidInject($_POST['editDesc']);
          $editLec = $edit->iAvoidInject($_POST['editLec']);
          $editLab = $edit->iAvoidInject($_POST['editLab']);
          $editYear = $edit->iAvoidInject($_POST['editYear']);
          $editSem = $edit->iAvoidInject($_POST['editSem']);
          $editProgram = $edit->iAvoidInject($_POST['editProgram']);
          $editAY = $edit->iAvoidInject($_POST['editAY']);
          // Check for empty input
          if(empty($editId) || empty($editCode) || empty($editDesc) || empty($editYear) || empty($editSem) || empty($editProgram) || empty($editAY)) {
            $flag = 0;
            $msgClass = $edit->iGetMsg('cError');
            $msg = $edit->iGetMsg('empty');
          }
          // Validate input int
          if(filter_var($editId, FILTER_VALIDATE_INT) === false
            || filter_var($editLec, FILTER_VALIDATE_INT) === false
            || filter_var($editLab, FILTER_VALIDATE_INT) === false
            || filter_var($editYear, FILTER_VALIDATE_INT) === false
            || filter_var($editSem, FILTER_VALIDATE_INT) === false) {
            $flag = 0;
            $msgClass = $edit->iGetMsg('cError');
            $msg = $edit->iGetMsg('iInvalid');
          }
          // Try to update
          if($flag !== 0) {
            if ($edit->iUpdateCourse($editCode, $editDesc, $editLab, $editLec, $editYear, $editSem, $editProgram, $editAY, $editId)) {
              $msgClass = $edit->iGetMsg('cSuccess');
              $msg = $edit->iGetMsg('sUpdate');
            } else {
              $msgClass = $edit->iGetMsg('cError');
              $msg = $edit->iGetMsg('error');
            }
          }
        } elseif(isset($_POST['deleteButton'])) {
          // Validate
          $deleteId = $edit->iAvoidInject($_POST['deleteId']);
          $ay = $edit->iAvoidInject($_POST['deleteAY']);
          // Check if empty
          if(empty($deleteId) || empty($ay)) {
            $flag = 0;
            $msgClass = $edit->iGetMsg('cError');
            $msg = $edit->iGetMsg('empty');
          }
          // Check chars
          if($edit->iCheckLettersAll($deleteId) === 0) {
            $flag = 0;
            $msgClass = $edit->iGetMsg('cError');
            $msg = $edit->iGetMsg('iInvalid');
          }
          // Validate int
          if(filter_var($deleteId, FILTER_VALIDATE_INT) === false) {
            $flag = 0;
            $msgClass = $edit->iGetMsg('cError');
            $msg = $edit->iGetMsg('iInvalid');
          }
          // Delete
          if($flag !== 0) {
            if($edit->iDeleteCourse($deleteId, $ay)) {
              $msgClass = $edit->iGetMsg('cSuccess');
              $msg = $edit->iGetMsg('sDelete');
              $ayToday = $_SESSION['ay'];
            } else {
              $msgClass = $edit->iGetMsg('cError');
              $msg = $edit->iGetMsg('error');
              $ayToday = $_SESSION['ay'];
            }
          }
        } else {
          $ayToday = $data->iAvoidInject($_POST['ay']);
          $_SESSION['ay'] = $ayToday;
        }
      }
     ?>
  </head>
  <body>
    <?php $init->getHeader() ?>
    <div class="container-fluid">
      <div class="container">
        <?php
          if(isset($_GET['q'])) {
            $p = $data->iAvoidInject($_GET['q']);
            if($data->iCheckLettersAll($p) !== 0) {
              $t .= '<div class="row">';
              $t .= '<div class="col-sm-3">';
              $t .= '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'?q='.$p.'" method="post">';
              $t .= '<div class="input-group">';
              $t .= '<span class="input-group-addon">Academic Year :</span>';
              $t .= '<div class="input-group-preppend">';
              $t .= '<select class="form-control" name="ay" onchange="this.form.submit()">';
              $t .= '<option>--- Select ---</option>';
              $ayAll = $get->iGetAY();
              while ($f = $ayAll->fetch_array()) {
                $t .= '<option value="'.$f["curYear"].'">'.$f["curYear"].'</option>';
              }
              $t .= '</select>';
              $t .= '</div>';
              $t .= '</div>';
              $t .= '</form>';
              $t .= '</div>';
              $t .= '<div class="col-sm-6">';
              $t .= '<h4 class="text-'.$msgClass.' text-center">'.$msg.'</h4>';
              $t .= '<h4 class="text-center">'.$p.' Curriculum '.$ayToday.'</h4><br>';
              $t .= '</div>';
              $t .= '<div class="col-sm-3">';
              $t .= '<a href="#ayUpdateCourse" data-toggle="modal" class="btn btn-primary btn-block">Update All Course</a>';
              $t .= '</div>';
              $t .= '</div>';
              for ($j=1; $j < 5; $j++) {
                $t .= '<div class="row">';
                $t .= '<div class="col-sm-6">';
                for ($i=1; $i <= 1; $i++) {
                  $first = new process();
                  $t .= '<div class="box box-default">';
                  $t .= '<div class="box-header with-border">';
                  $t .= '<h4 class="text-center">'.$j.' - 1st Semester</h4>';
                  $t .= '</div>';
                  $t .= '<div class="box-body">';
                  $t .= $first->iShowTable($j, 1, $p, $ayToday);
                  $t .= '</div>';
                  $t .= '<div class="box-footer"></div>';
                  $t .= '</div>';
                }
                $t .= '</div>';
                $t .= '<div class="col-sm-6">';
                for ($i=1; $i <= 1; $i++) {
                  $second = new process();
                  $t .= '<div class="box box-default">';
                  $t .= '<div class="box-header with-border">';
                  $t .= '<h4 class="text-center">'.$j.' - 2nd Semester</h4>';
                  $t .= '</div>';
                  $t .= '<div class="box-body">';
                  $t .= $second->iShowTable($j, 2, $p, $ayToday);
                  $t .= '</div>';
                  $t .= '<div class="box-footer"></div>';
                  $t .= '</div>';
                }
                $t .= '</div>';
                $t .= '</div>';
              }
              echo $t;
            }
          }
        ?>
        <a href="#editCourse" class="hide" data-toggle="modal" id="editModal"></a>
        <div class="modal fade" id="editCourse">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="text-center">Update Course</h3>
                <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
              </div>
              <div class="modal-body">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=<?php echo $p; ?>" method="post">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group hide">
                        <label for="editId">Course Id</label>
                        <input type="hidden" class="form-control" name="editId" id="editId">
                      </div>
                      <div class="form-group">
                        <label for="editAY">Academic Year</label>
                        <select class="form-control" name="editAY" id="editAY">
                          <option value="<?php echo $ayToday ?>"><?php echo $ayToday ?></option>';
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="editCode">Course Code</label>
                        <input type="text" class="form-control" name="editCode" id="editCode">
                      </div>
                      <div class="form-group">
                        <label for="editLec">Lecture</label>
                        <input type="text" class="form-control" name="editLec" id="editLec">
                      </div>
                      <div class="form-group">
                        <label for="editLab">Laboratory</label>
                        <input type="text" class="form-control" name="editLab" id="editLab">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="editProgram">Program</label>
                        <select class="form-control" name="editProgram" id="editProgram">
                          <option value="<?php echo $p ?>"><?php echo $p ?></option>';
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="editYear">Year</label>
                        <select class="form-control" name="editYear" id="editYear">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="editSem">Semester</label>
                        <select class="form-control" name="editSem" id="editSem">
                          <option value="1">1</option>
                          <option value="2">2</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="editDesc">Description</label>
                        <input type="text" class="form-control" name="editDesc" id="editDesc">
                      </div>
                      <div class="form-group">
                        <button type="submit" name="editButton" value="edit" class="btn btn-primary btn-block">Update</button>
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
                <h3 class="text-center">Delete course?</h3>
                <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=<?php echo $p; ?>" method="post">
                        <div class="form-group hide">
                          <label for="deleteId">Course Id</label>
                          <input type="text" class="form-control" name="deleteId" id="deleteId">
                          <input type="hidden" name="deleteAY" id="deleteAY">
                        </div>
                        <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">Cancel</button>
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
        <div class="modal fade" id="ayUpdateCourse">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="text-center" id="ayUpdateResult"></h4>
                <h3 class="text-center">Update All Course?</h3>
                <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                      <form id="ayUpdateForm">
                        <div class="form-group">
                          <select class="form-control" name="ayAll" id="ayUpdate">
                          <option>--- Academic Year ---</option>
                          <?php
                            $ayAll = $get->iGetAY();
                            while ($f = $ayAll->fetch_array()) {
                              echo '<option value="'.$f["curYear"].'">'.$f["curYear"].'</option>';
                            }
                           ?>
                          </select>
                        </div>
                        <button type="button" id="ayUpdateBtn" value="delete" class="btn btn-warning btn-block">Update All</button>
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
        <a href="#aySingleCourse" data-toggle="modal" class="hide" id="aySingleCourseModal"></a>
        <div class="modal fade" id="aySingleCourse">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="text-center" id="aySingleCourseResult"></h4>
                <h3 class="text-center">Select Academic Year</h3>
                <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                      <form id="ayUpdateForm">
                        <div class="form-group">
                          <input type="hidden" name="aySingleCourseId" id="aySingleCourseId">
                          <input type="hidden" name="aySingleCourseSem" id="aySingleCourseSem">
                          <input type="hidden" name="aySingleCourseYear" id="aySingleCourseYear">
                          <input type="hidden" name="aySingleCourseProg" id="aySingleCourseProg">
                          <select class="form-control" name="aySingleCourseCur" id="aySingleCourseCur">
                          <option>--- Academic Year ---</option>
                          <?php
                            $ayAll = $view->iGetAY();
                            while ($f = $ayAll->fetch_array()) {
                              echo '<option value="'.$f["curYear"].'">'.$f["curYear"].'</option>';
                            }
                           ?>
                          </select>
                        </div>
                        <button type="button" id="aySingleCourseBtn" value="delete" class="btn btn-primary btn-block">Ok</button>
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
      </div>
    </div>
    <?php
      $init->getScript();
    ?>
    <script>
     $(function () {
       var count = qLen = 0;
       $(window).load(function () {
         $(".mainButton").eq(1).addClass("mainBtn");
         $(".subBtnAcademics").eq(0).addClass("subBtn");
         $("#navAcademics").slideDown('slow');
       })
       $(".update").click(function () {
         var id = $(this).attr("id");
         var code = $("#subjectCode" + id).text();
         var desc = $("#subjectDesc" + id).text();
         var lec = $("#subjectLec" + id).text();
         var lab = $("#subjectLab" + id).text();
         var year = $("#subjectYear" + id).text();
         var sem = $("#subjectSem" + id).text();
         var prog = $("#subjectProgram" + id).text();
         var ay = $("#subjectAY" + id).text();
         $("#editCode").val(code);
         $("#editDesc").val(desc);
         $("#editLec").val(lec);
         $("#editLab").val(lab);
         $("#editId").val(id);
         $("#editSem").val(sem);
         $("#editYear").val(year);
         $("#editProgram").val(prog);
         $("#editAY").val(ay);
         $("#editModal").trigger('click');
       })
       $(".delete").click(function () {
         var id = $(this).attr("id");
         var ay = $("#baseDeleteAY" + id).val();
         $("#deleteId").val(id);
         $("#deleteAY").val(ay);
         $("#deleteModal").trigger('click');
       })
       $(".migrate").click(function () {
         var id = $(this).attr("id");
         var year = $("#subjectYear" + id).text();
         var sem = $("#subjectSem" + id).text();
         var ay = $("#baseAySingleCourseAY" + id).val();
         var prog = $("#baseAySingleCourseProg" + id).val();
         $("#aySingleCourseId").val(id);
         $("#aySingleCourseSem").val(sem);
         $("#aySingleCourseYear").val(year);
         $("#aySingleCourseProg").val(prog);
         $("#aySingleCourseModal").trigger('click');
       })
       $("#aySingleCourseBtn").click(function () {
         var id = $("#aySingleCourseId").val();
         var sem = $("#aySingleCourseSem").val();
         var year = $("#aySingleCourseYear").val();
         var ay = $("#aySingleCourseCur").val();
         var prog = $("#aySingleCourseProg").val();
         qLen = 0;
         ajaxReq(id, sem, year, prog, ay, 0, "aySingleCourseResult");
       })
       $("#ayUpdateBtn").click(function () {
         var ay  = $("#ayUpdate").val();
         var id = $(".ayUpdateId");
         var sem = $(".ayUpdateSem");
         var year = $(".ayUpdateYear");
         var program = $(".ayUpdateProgram");
         var l = id.length;
         qLen = (l - 1);
         for (var i = 0; i < l; i++) {
           ajaxReq(id[i].value, sem[i].value, year[i].value, program[i].value, ay, count, "ayUpdateResult");
           count++;
         }
       })
       function ajaxReq(id, sem, year, program, ay, count, rdv) {
         var ajax =  new XMLHttpRequest();
         ajax.onreadystatechange = function () {
           if (ajax.readyState == 4) {
             var rDiv = document.getElementById(rdv);
             var rTxt = ajax.responseText;
             if (count == qLen) {
              rDiv.innerHTML = rTxt;
            }
           }
         }
         var q = "?id="  + id + "& sem=" + sem + "& year=" + year + "& program=" + program + "& cur=" + ay;
         ajax.open('GET', 'updateAllCourse.php' + q, true);
         ajax.send(null);
       }
      })
    </script>
  </body>
</html>
