<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      session_start();
      require_once '../../pages/class/content.php';
      require_once '../../pages/class/data.php';
      $init = new initContents();
      $data = new process();
      $init->getTitle();
      $init->getStyle();
      $t = ""; $done = $_SESSION['dept'] = "Information Communication Technology";
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['q'])) {
          $q = $data->iAvoidInject($_GET['q']);
          if ($data->iCheckLettersAll($q)) {
            $done = $q;
            $_SESSION['dept'] = $done;
          } else {
            $done = "Information Communication Technology";
            $_SESSION['dept'] = $done;
          }
        }
      }
     ?>
  </head>
  <body>
    <div class="container main-con">
    <?php
      $init->getHeader();
      $init->getNavigation();
     ?>
     <div class="disp-container">
       <?php include_once 'navAcademics.php'; ?>
       <div class="container-fluid">
         <div class="row">
           <div class="col-sm-1"></div>
             <div class="col-sm-10"><hr>
               <div class="row">
                 <div class="col-sm-9 border-right">
                   <?php
                     $data = $data->iGetAllProgram($done);
                     if (strlen($done) > 2) {
                       $id = mb_substr($done, 0, 3, 'UTF-8');
                     }
                     if ($data) {
                       while ($r = $data->fetch_array()) {
                         $t .= '<div class="row navMain" id="'.$id.'">';
                         $t .= '<div class="col-sm-12">';
                         $t .= '<h3>'.$r["programTitle"].'</h3>';
                         $t .= '<h4>'.$r["programName"].'</h4><hr>';
                         $t .= '</div>';
                         $t .= '<div class="col-sm-4 border-right">';
                         $t .= '<img class="imgStatic" src="../../upload/gallery/'.$r["programImage"].'" height="230px" width="100%">';
                         $t .= '<center><div class="btn-group"><br>';
                         $t .= '<a href="../../pages/academics/course.php?q='.$r["programTitle"].'">Courses</a>';
                         $t .= '&nbsp;&bull;&nbsp;';
                         $t .= '<a href="../../pages/facultyStaff/facultyStaff.php?q='.$r["deptTitle"].'">Faculty</a>';
                         $t .= '&nbsp;&bull;&nbsp;';
                         $t .= '<a href="../../pages/academics/gallery.php?q='.$r["programTitle"].'">Gallery</a>';
                         $t .= '</div></center>';
                         $t .= '</div>';
                         $t .= '<br><div class="col-sm-8">';
                         if (strlen($r["programDesc"]) > 500) {
                           $desc = mb_substr($r["programDesc"], 0 , 500, 'UTF-8').'...';
                         } else {
                           $desc = $r["programDesc"];
                         }
                         $t .= '<p>'.$desc .'</p><br>';
                         $t .= '<a href="../../pages/academics/program.php?q='.$r["programId"].'">Read More <i class="fa fa-angle-double-right"></i></a>';
                         $t .= '</div>';
                         $t .= '</div><hr>';
                       }
                       echo $t;
                     }
                   ?>
                 </div>
                 <div class="col-sm-3">
                   <h4>Quick Links</h4>
                   <hr>
                   <?php
                    $get = new process();
                    $r = $get->iGetProgramOne($done);
                    while ($f = $r->fetch_array()) {
                      echo '<a href="../../pages/academics/program.php?q='.$f["programId"].'">'.$f["programTitle"].'</a><br>';
                    }
                   ?>
                 </div>
               </div>
             </div>
           <div class="col-sm-1"></div>
         </div>
       </div>
     </div>
     <?php
       $init->getFooter();
       $init->getScript();
      ?>
    </div>
    <script>
      $(function () {
        $("a").eq(2).addClass('mainBtn');
        var id = $(".navMain").attr("id");
        $("#" + id).addClass('subBtn');
      })
    </script>
  </body>
</html>
