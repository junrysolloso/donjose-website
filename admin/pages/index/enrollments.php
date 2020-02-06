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
         $init->getTitle();
         $init->getStyle();
         $flag = 1; $msg = $msgClass = "";
        if($_SERVER['REQUEST_METHOD'] == "POST") {
          if (isset($_POST['editEn'])) {
            // Validate
            $elementary = $data->iAvoidInject($_POST['elementary']);
            $highSchool = $data->iAvoidInject($_POST['highSchool']);
            $college = $data->iAvoidInject($_POST['college']);
            // Check if empty
            if(empty($elementary) || empty($highSchool) || empty($college)) {
              $msgClass = $data->iGetMsg('cError');
              $msg = $data->iGetMsg('empty');
              $flag = 0;
            }
            // Validate int
            if (filter_var($elementary ,FILTER_VALIDATE_INT) === false
               || filter_var($highSchool ,FILTER_VALIDATE_INT) === false
               || filter_var($college ,FILTER_VALIDATE_INT) === false) {
              $msgClass = $data->iGetMsg('cError');
              $msg = $data->iGetMsg('iInvalid');
              $flag = 0;
            } 
            // Try to update
            if($flag !== 0) {
              if($data->iUpdateEn($elementary, $highSchool, $college)) {
                $msgClass = $data->iGetMsg('cSuccess');
                $msg = $data->iGetMsg('sUpdate');
              } else {
                $msgClass = $data->iGetMsg('cError');
                $msg = $data->iGetMsg('error');
              }
            }
          }
        }
        $r = $get->iGetEnrollments();
        if ($r) {
          $f = $r->fetch_array();
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
                      <h4 class="text-center">Enrollments</h4>
                    </div>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="elementary">Elementary</label>
                        <input class="form-control" type="text" name="elementary" id="elementary" value="<?php echo $f[1] ?>">
                      </div>
                      <div class="form-group">
                        <label for="highSchool">Junior/Senior High</label>
                        <input class="form-control" type="text" name="highSchool" id="highSchool" value="<?php echo $f[2] ?>">
                      </div>
                      <div class="form-group">
                        <label for="college">College</label>
                        <input class="form-control" type="text" name="college" id="college" value="<?php echo $f[3] ?>">
                      </div>
                    </div>
                    <div class="box-footer">
                     <button type="submit" class="btn btn-primary" name="editEn" id="editEn">Save Changes</button>
                    </div>
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
           $(".mainButton").eq(0).addClass("mainBtn");
           $(".subBtnHome").eq(1).addClass("subBtn");
           $("#navHome").slideDown('slow');
         })
        })
      </script>
    </body>
  </html>
