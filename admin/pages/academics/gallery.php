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
        $change = new process();
        $remove = new process();
        $flag = 1; $msgClass = $msg = $t = "";
        if($_SERVER['REQUEST_METHOD'] == "POST") {
          if(isset($_POST['changeButton'])) {
            $targetDir = "../../../upload/gallery/";
            $tmpName = $_FILES['Image']['tmp_name'];
            $imgName = $_FILES['Image']['name'];
            $imgSize = $_FILES['Image']['size'];
            $targetFile = $targetDir. basename($imgName);
            $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
            // Validate and sanitize
            $changeTitle = $change->iAvoidInject($_POST['changeTitle']);
            $changeDesc = $change->iAvoidInject($_POST['changeDesc']);
            $changeId = $change->iAvoidInject($_POST['changeId']);
            //Check empty inputs
            if(empty($changeTitle) || empty($changeDesc)) {
              $flag = 0;
              $msgClass = $change->iGetMsg('cError');
              $msg = $change->iGetMsg('empty');
            }
            // Validate int
            if(filter_var($changeId, FILTER_VALIDATE_INT) === false) {
              $flag = 0;
              $msgClass = $change->iGetMsg('cError');
              $msg = $change->iGetMsg('iInvalid');
            }
            // Check special chars
            if($change->iCheckLetters($changeTitle) === 0) {
              $flag = 0;
              $msgClass = $change->iGetMsg('cError');
              $msg = $change->iGetMsg('lAllowed');
            }
            // Check image
            if (empty($imgName)) {
              if($flag !== 0) {
                $r = $change->iUpdateProgramImage($changeTitle, $changeDesc, "", $changeId);
                if($r == 1) {
                  $msgClass = $change->iGetMsg('cSuccess');
                  $msg = $change->iGetMsg('sUpdate');
                } else {
                  $msgClass = $change->iGetMsg('cError');
                  $msg = $change->iGetMsg('error');
                }
              }
            } else {
              // Check image
              $imgOk = $change->iCheckImage($tmpName, $targetFile, $imgSize, $fileType);
              $flag = $imgOk['uploadOk'];
              $msg = $imgOk['msg'];
              $msgClass = $imgOk['msgClass'];
              // Try to move
              if($flag !== 0) {
                if(move_uploaded_file($tmpName, $targetFile)) {
                  $r = $change->iUpdateProgramImage($changeTitle, $changeDesc, $imgName, $changeId);
                  if($r == 1) {
                    $msgClass = $change->iGetMsg('cSuccess');
                    $msg = $change->iGetMsg('sUpdate');
                  } else {
                    $msgClass = $change->iGetMsg('cError');
                    $msg = $change->iGetMsg('error');
                  }
                }
              }
            }
          } else {
            $deleteId = $remove->iAvoidInject($_POST['deleteId']);
            // Validate id
            if(filter_var($deleteId, FILTER_VALIDATE_INT) === false) {
              $flag = 0;
              $msgClass = $change->iGetMsg('cError');
              $msg = $change->iGetMsg('iInvalid');
            }
            // Try to delete
            if($flag !== 0) {
              $r = $remove->iDeleteProgramImage($deleteId);
              if($r == 1) {
                $msgClass = $change->iGetMsg('cSuccess');
                $msg = $change->iGetMsg('sDelete');
              } else {
                $msgClass = $change->iGetMsg('cError');
                $msg = $change->iGetMsg('error');
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
         <?php
            if(isset($_GET['q'])) {
             // Get all data
             $p = $data->iAvoidInject($_GET['q']);
             if ($data->iCheckLettersAll($p) !== 0) {
               $t .= '<h4 class="text-'.$msgClass.' text-center">'.$msg.'</h4><br>';
               $t .= '<div class="row">';
               $t .= '<div class="portfolio-items">';
               $u = $data->iGetImages($p);
               while($v = $u->fetch_array()) {
                 $t .= '<div class="col-sm-6 col-md-3 col-lg-3">';
                 $t .= '<div class="box box-default">';
                 $t .= '<div class="box-header">';
                 $t .= '<p class="hide" id="title'.$v['galleryId'].'">'.$v['galleryName'].'</p>';
                 $t .= '<h4 class="text-center">'.$v['galleryName'].'</h4>';
                 $t .= '<hr>';
                 $t .= '</div>';
                 $t .= '<div class="box-body">';
                 $t .= '<div class="portfolio-item">';
                 $t .= '<div class="hover-bg"> <a href="../../../upload/gallery/'.$v["galleryImage"].'" alt="'.$v["galleryName"].'" data-lightbox-gallery="gallery1">';
                 $t .= '<img src="../../../upload/gallery/'.$v["galleryImage"].'" height="200px" width="100%"  alt="'.$v["galleryName"].'"></a>';
                 $t .= '</div>';
                 $t .= '</div>';
                 $t .= '<br><small id="desc'.$v['galleryId'].'">'.$v['galleryDesc'].'</small>';
                 $t .= '</div>';
                 $t .= '<div class="box-footer">';
                 $t .= '<button type="button" name="removeButton" class="btn btn-danger btn-block remove" id="'.$v['galleryId'].'">Remove</button>';
                 $t .= '<button type="button" name="changeButton" class="btn btn-warning btn-block change" id="'.$v['galleryId'].'">Change</button>';
                 $t .= '</div>';
                 $t .= '</div>';
                 $t .= '</div>';
               }
               $t .= '</div>';
               $t .= '</div>';
               echo $t;
             }
           }
         ?>
       </div>
      </div>
      <a href="#changeImage" data-toggle="modal" id="changeModal" class="hide"></a>
      <div class="modal fade" id="changeImage">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="text-center">Change Image</h3>
              <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
            </div>
            <div class="modal-body">
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=<?php echo $p; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group hide">
                      <label for="changeId">Image Id</label>
                      <input type="text" class="form-control" name="changeId" id="changeId">
                    </div>
                    <div class="form-group">
                      <label for="changeTitle">Title</label>
                      <input type="text" class="form-control" name="changeTitle" id="changeTitle">
                    </div>
                    <div class="form-group">
                      <label for="changeImage">Image</label>
                      <input type="file" class="form-control" name="Image" id="changeImage">
                    </div>
                  </div>
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="changeDesc">Description</label>
                      <textarea class="form-control" name="changeDesc" rows="12" cols="80" id="changeDesc">Image Description</textarea>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <button type="submit" name="changeButton" value="change" class="btn btn-primary btn-block">Change</button>
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
      <a href="#deleteImage" class="hide" data-toggle="modal" id="deleteModal"></a>
      <div class="modal fade" id="deleteImage">
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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?q=<?php echo $p; ?>" method="post">
                      <div class="form-group hide">
                        <label for="deleteId">Course Id</label>
                        <input type="text" class="form-control" name="deleteId" id="deleteId">
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
      <?php
         $init->getFooter();
         $init->getScript();
       ?>
     <script>
      $(function () {
        $(window).load(function () {
          $(".mainButton").eq(2).addClass("mainBtn");
          var dept = $("input[name='programDept']").val();
          $("#subBtnAcademics" + dept).addClass('subBtn');
          $("#navAcademics").slideDown('slow');
          $("#text1").wysihtml5();
        })
        $(".change").click(function (e) {
          e.preventDefault();
          var id = $(this).attr("id");
          var title = $("#title" + id).text();
          var desc = $("#desc" + id).text();
          $("#changeModal").trigger('click');
          $("#changeDesc").val(desc);
          $("#changeTitle").val(title);
          $("#changeId").val(id);
        })
        $(".remove").click(function (e) {
          e.preventDefault();
          var id  = $(this).attr("id");
          $("input[name='deleteId']").val(id);
          $("#deleteModal").trigger('click');
        })
       })
     </script>
   </body>
 </html>
