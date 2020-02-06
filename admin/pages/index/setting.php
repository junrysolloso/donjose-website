  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <?php
         session_start();
         require_once '../../../admin/pages/class/content.php';
         require_once '../../../admin/pages/class/data.php';
         $init = new initContents();
         $data = new process();
         $get = new process();
         $new = new process();
         $use = new process();
         $init->getTitle();
         $init->getStyle();
         $flag = 1; $msg = $msgClass = "";
        if($_SERVER['REQUEST_METHOD'] == "POST") {
          if (isset($_POST['set'])) {
            $ay = $get->iAvoidInject($_POST['ay']);
            if (empty($ay)) {
              $flag = 0;
              $msgClass = $get->iGetMsg('cError');
              $msg = $get->iGetMsg('empty');
            }
            if ($flag !== 0) {
              if ($ay) {
                if ($get->iUpdateAYSetting($ay)) {
                  $msgClass = $get->iGetMsg('cSuccess');
                  $msg = $get->iGetMsg('sUpdate');
                } else {
                  $msgClass = $get->iGetMsg('cError');
                  $msg = $get->iGetMsg('error');
                }
              }
            }
          } elseif (isset($_POST['setUser'])) {
            $targetDir = "../../../upload/images/";
            $tmpName = $_FILES['Image']['tmp_name'];
            $imgSize = $_FILES['Image']['size'];
            $imgName = $_FILES['Image']['name'];
            $targetFile = $targetDir .basename($imgName);
            $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
            // Validate
            $username  = $data->iAvoidInject($_POST['username']);
            $password  = $data->iAvoidInject($_POST['password']);
            $fullname  = $data->iAvoidInject($_POST['fullname']);
            // Check if empty
            if (empty($username) || empty($password) || empty($fullname)) {
              $msgClass = $get->iGetMsg('cError');
              $msg = $get->iGetMsg('empty');
              $flag = 0;
            }
            // Check char
            if (!$data->iCheckLetters($username)) {
              $msgClass = $get->iGetMsg('cError');
              $msg = $get->iGetMsg('lAllowed');
              $flag = 0;
            }
            // Try to update
            if (empty($imgName)) {
              if ($flag !== 0) {
                if ($data->iUpdateUser($username, $password, $fullname, "")) {
                  $msgClass = $get->iGetMsg('cSuccess');
                  $msg = $get->iGetMsg('sUpdate');
                } else {
                  $msgClass = $get->iGetMsg('cError');
                  $msg = $get->iGetMsg('error');
                }
              }
            } else {
              // Check image
              $imgOk = $data->iCheckImage($tmpName, $targetFile, $imgSize, $fileType);
              $flag = $imgOk['uploadOk'];
              $msg = $imgOk['msg'];
              $msgClass = $imgOk['msgClass'];
              if ($flag !== 0) {
                if ($data->iUpdateUser($username, $password, $fullname, $imgName)) {
                  if (move_uploaded_file($tmpName, $targetFile)) {
                    $msgClass = $get->iGetMsg('cSuccess');
                    $msg = $get->iGetMsg('sUpdate');
                  } else {
                    $msgClass = $get->iGetMsg('cError');
                    $msg = $get->iGetMsg('error');
                  }
                }
              }
            }
          } elseif (isset($_POST['newDeptBtn'])) {
          // Validate
          $newDept = $data->iAvoidInject($_POST['newDept']);
          // Check if empty
          if (empty($newDept)) {
            $msgClass = $get->iGetMsg('cError');
            $msg = $get->iGetMsg('empty');
            $flag = 0;
          }
          // Check if valid chars
          if (!$data->iCheckLettersAll($newDept)) {
            $msgClass = $get->iGetMsg('cError');
            $msg = $get->iGetMsg('lAllowed');
            $flag = 0;
          }
          // Try to Add
          if ($flag !== 0) {
            if ($data->iAddDept($newDept)) {
              $msgClass = $get->iGetMsg('cSuccess');
              $msg = $get->iGetMsg('sAdd');
            } else {
              $msgClass = $get->iGetMsg('cError');
              $msg = $get->iGetMsg('error');
            }
          }
        } elseif (isset($_POST['editBtn'])) {
          // Validate
          $editDept = $data->iAvoidInject($_POST['editDept']);
          $editId = $data->iAvoidInject($_POST['editId']);
          // Check if empty
          if (empty($editDept) || empty($editId)) {
            $msgClass = $get->iGetMsg('cError');
            $msg = $get->iGetMsg('empty');
            $flag = 0;
          }
          // Check if valid chars
          if (!$data->iCheckLettersAll($editDept) || !$data->iCheckNumbers($editId)) {
            $msgClass = $get->iGetMsg('cError');
            $msg = $get->iGetMsg('lAllowed');
            $flag = 0;
          }
          // Try to Add
          if ($flag !== 0) {
            if ($data->iUpdateDept($editDept, $editId)) {
              $msgClass = $get->iGetMsg('cSuccess');
              $msg = $get->iGetMsg('sUpdate');
            } else {
              $msgClass = $get->iGetMsg('cError');
              $msg = $get->iGetMsg('error');
            }
          }
        } elseif (isset($_POST['deleteDeptBtn'])) {
          // Validate
          $deleteId = $data->iAvoidInject($_POST['deleteId']);
          // Check if empty
          if (empty($deleteId)) {
            $msgClass = $get->iGetMsg('cError');
            $msg = $get->iGetMsg('empty');
            $flag = 0;
          }
          // Check if valid chars
          if (!$data->iCheckNumbers($deleteId)) {
            $msgClass = $get->iGetMsg('cError');
            $msg = $get->iGetMsg('lAllowed');
            $flag = 0;
          }
          // Try to Add
          if ($flag !== 0) {
            if ($data->iRemoveDept($deleteId)) {
              $msgClass = $get->iGetMsg('cSuccess');
              $msg = $get->iGetMsg('sDelete');
            } else {
              $msgClass = $get->iGetMsg('cError');
              $msg = $get->iGetMsg('error');
            }
          }
        } else {
          // Get image data
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
          $newDept = $new->iAvoidInject($_POST['newDeptProgram']);
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
      $s = $use->iGetUser();
      $user = $s->fetch_array();
     ?>
    </head>
    <body>
      <?php $init->getHeader() ?>
      <div class="container-fluid">
        <div class="container">
          <div class="row">
            <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg ?></h4>
                <br>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="box box-default">
                      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                      <div class="box-header with-border">
                        <h4 class="text-center">Academic Year Setting</h4>
                      </div>
                      <div class="box-body">
                        <div class="form-group">
                          <label for="elementary">Academic Year</label>
                          <select class="form-control" name="ay">
                            <?php
                              $r = $get->iGetAY();
                              if ($r) {
                                while ($f = $r->fetch_array()) {
                                  echo '<option value="'.$f["curYear"].'">'.$f["curYear"].'</option>';
                                }
                              }
                             ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary" name="set">Save</button>
                        </div>
                      </div>
                      <div class="box-footer">
                        <small><p class="text-center">This setting is used to display courses in selected academic year in the client website.</p></small>
                      </div>
                      </form>
                    </div>
                    <div class="box box-default">
                      <div class="box-header with-border">
                        <h4 class="text-center">Program Setting</h4>
                      </div>
                      <div class="box-body">
                        <div class="form-group">
                        </div>
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th width="10%" >No</th>
                              <th width="60%" >Department</th>
                              <th width="30%" >Action</i></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $data = new process();
                              $count = 1;
                              $r = $data->iGetAllDeptAll();
                              while ($f = $r->fetch_array()) { ?>
                                <tr>
                                  <td><?php echo $count ?></td>
                                  <td><?php echo $f["deptTitle"] ?></td>
                                  <td><a href="#newProgram" data-toggle="modal" id="<?php echo $f["deptTitle"] ?>" class="btn btn-primary btn-sm btn-block add">Add Program</i></a></td>
                                </tr>
                              <?php $count++; } ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="box-footer">
                        <small><p class="text-center">List of department.</p></small>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="box box-default">
                      <div class="box-header with-border">
                        <h4 class="text-center">Department Setting</h4>
                      </div>
                      <div class="box-body">
                        <div class="form-group">
                          <a href="#addNewDept" data-toggle="modal" class="btn btn-primary">New Department</a>
                        </div>
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th width="10%">No</th>
                              <th width="70%">Department</th>
                              <th width="10%">Edit</i></th>
                              <th width="10%">Remove</i></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $data = new process();
                              $count = 1;
                              $r = $data->iGetAllDeptAll();
                              while ($f = $r->fetch_array()) { ?>
                                <tr>
                                  <td><?php echo $count ?></td>
                                  <td><?php echo $f["deptTitle"] ?></td>
                                  <td><a href="#editOldDept" data-toggle="modal" id="<?php echo $f["deptId"] ?>" class="btn btn-primary btn-sm edit"><i class="fa fa-pencil"></i></a></td>
                                  <td><a href="#deleteDept" data-toggle="modal" id="<?php echo $f["deptId"] ?>" class="btn btn-danger btn-sm btn-block remove"><i class="fa fa-minus"></i></a></td>
                                  <input type="hidden" id="editDeptName<?php echo $f["deptId"] ?>" value="<?php echo $f["deptTitle"] ?>">
                                </tr>
                              <?php $count++; } ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="box-footer"></div>
                    </div>
                  </div>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                  <div class="box box-default">
                    <div class="box-header with-border">
                      <h4 class="text-center">User Setting</h4>
                    </div>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo $user[3] ?>">
                      </div>
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo $user[1] ?>">
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="<?php echo $user[2] ?>">
                      </div>
                      <div class="form-group">
                        <label for="Image">Choose Image</label>
                        <input type="file" class="form-control" name="Image" value="" id="Image">
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="setUser" value="setUser">Save Changes</button>
                      </div>
                    </div>
                    <div class="box-footer">
                      <small><p class="text-center">You may also change your username and password here.</p></small>
                    </div>
                  </div>
                </form>
              </div>
            <div class="col-sm-1"></div>
          </div>
        </div>
        <div class="modal fade" id="addNewDept">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="text-center">New Department</h3>
                <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="form-group">
                          <label for="newDept">Department Name</label>
                          <input type="text" class="form-control" name="newDept" id="newDept" required>
                        </div>
                        <button type="submit" name="newDeptBtn" id="newDeptBtn" value="new" class="btn btn-primary btn-block">Add</button>
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
        <div class="modal fade" id="deleteDept">
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
                      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="form-group hide">
                          <label for="deleteId">Department Id</label>
                          <input type="hidden" class="form-control" name="deleteId" id="deleteId">
                        </div>
                        <button type="submit" name="deleteDeptBtn" id="deleteDeptBtn" class="btn btn-danger btn-block">Yes</button>
                      </form>
                    </div>
                  <div class="col-sm-2"></div>
                </div>
              </div>
              <div class="modal-footer">
                <h5 class="text-center"><b>NOTE:</b> Removing department would also affect related programs.</h5>
                <h5 class="text-center">&copy; DJEMFCST 2018</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="editOldDept">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="text-center">Update Department Info</h3>
                <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="form-group hide">
                          <label for="editId">Department Id</label>
                          <input type="hidden" class="form-control" name="editId" id="editId">
                        </div>
                        <div class="form-group">
                          <label for="editDept">Department Name</label>
                          <input type="text" class="form-control" name="editDept" id="editDept" required>
                        </div>
                        <button type="submit" name="editBtn" id="editBtn" class="btn btn-primary btn-block">Ok</button>
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
        <div class="modal fade" id="newProgram">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="text-center">Add Program</h3>
                <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
              </div>
              <div class="modal-body">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
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
                        <label for="newDeptProgram">Department</label>
                        <select class="form-control" name="newDeptProgram">
                          <option id="newDeptProgram"></option>
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
                        <textarea class="form-control" name="newDesc" style="height:300px" id="newDesc">Program Description</textarea>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <button type="submit" name="newProgramBtn" value="new" class="btn btn-primary btn-block">Add</button>
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
      </div>
      <script>
       $(function () {
         $(".mainButton").eq(0).addClass("mainBtn");
         $(".subBtnHome").eq(3).addClass("subBtn");
         $("#navHome").slideDown('slow');
         $(".edit").click(function () {
           var id = $(this).attr("id");
           var name = $("#editDeptName" + id).val();
           $("#editId").val(id);
           $("#editDept").val(name);
         })
         $(".remove").click(function () {
           var id = $(this).attr("id");
           $("#deleteId").val(id);
         })
         $(".add").click(function () {
           var id = $(this).attr("id");
           $("#newDeptProgram").val(id);
           $("#newDeptProgram").text(id);
         })
         $("#newDesc").wysihtml5();
        })
      </script>
    </body>
  </html>
