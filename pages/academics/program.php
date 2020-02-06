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
      $t = "";
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['q'])) {
          $q = $data->iAvoidInject($_GET['q']);
          if ($data->iCheckNumbers($q)) {
            $done = $q;
          } else {
            $a  = '<script>';
            $a .= 'window.location = "../../pages/academics/academics.php";';
            $a .= '</script>';
            echo $a;
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
             <div class="col-sm-10">
               <?php
                 $data = $data->iGetProgramData($done);
                 if ($data) {
                   while ($r = $data->fetch_array()) {
                     $t .= '<div class="row" id="'.$done.'">';
                     $t .= '<div class="col-sm-12">';
                     $t .= '<h3>'.$r["programTitle"].'</h3>';
                     $t .= '<h4>'.$r["programName"].'</h4><hr>';
                     $t .= '</div>';
                     $t .= '<div class="col-sm-4 border-right">';
                     $t .= '<img class="imgStatic" src="../../upload/gallery/'.$r["programImage"].'" height="250px" width="100%">';
                     $t .= '<center><div class="btn-group"><br>';
                     $t .= '<a href="../../pages/academics/course.php?q='.$r["programTitle"].'">Courses</a>';
                     $t .= '&nbsp;&bull;&nbsp;';
                     $t .= '<a href="../../pages/facultyStaff/facultyStaff.php?q='.$r["deptTitle"].'">Faculty</a>';
                     $t .= '&nbsp;&bull;&nbsp;';
                     $t .= '<a href="../../pages/academics/gallery.php?q='.$r["programTitle"].'">Gallery</a>';
                     $t .= '</div></center>';
                     $t .= '</div>';
                     $t .= '<div class="col-sm-8">';
                     $t .= '<p class="text-justify">'.$r["programDesc"].'</p>';
                     $t .= '<a href="'.htmlspecialchars($_SERVER["HTTP_REFERER"]).'"><i class="fa fa-angle-double-left"></i> Back</a>';
                     $t .= '</div>';
                     $t .= '</div>';
                   }
                   echo $t;
                 }
               ?>
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
        var id = $(".bot-border").attr("id");
        $("#" + id).addClass('subBtn');
      })
    </script>
  </body>
</html>
