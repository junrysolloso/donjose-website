<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      session_start();
      require_once '../../pages/class/content.php';
      require_once '../../pages/class/data.php';
      $init = new initContents();
      $table = new process();
      $data = new process();
      $get = new process();
      $init->getTitle();
      $init->getStyle();
      $t = "";
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['q'])) {
          $q = $data->iAvoidInject($_GET['q']);
          if ($data->iCheckLetters($q)) {
            $chk = $q;
            $ay = $get->iGetSetting();
            $_SESSION['program'] = $chk;
          } else {
            $a  = '<script>';
            $a .= 'window.location = "../../pages/academics/academics.php";';
            $a .= '</script>';
            echo $a;
          }
        } else {
          $chk = $_SESSION['program'];
          $rAY  = $_GET['ay'];
          if (preg_match("/^[0-9-]*$/", $rAY)) {
            $ay = $rAY;
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
                 $t .= '<div class="container-fluid">';
                 $t .= '<div class="section-title text-center center">';
                 $t .= '<h3 class="course">'.$chk.' Curriculum '.$ay.'</h3>';
                 $t .= '<hr>';
                 $t .= '</div>';
                 $t .= '<div class="row">';
                 $t .= '<div class="col-sm-6">';
                 $t .= $table->iShowTable(1, 1, $chk, $ay);
                 $t .= '</div>';
                 $t .= '<div class="col-sm-6">';
                 $t .= $table->iShowTable(1, 2, $chk, $ay);
                 $t .= '</div>';
                 $t .= '</div>';
                 $t .= '<div class="row">';
                 $t .= '<div class="col-sm-6">';
                 $t .= $table->iShowTable(2, 1, $chk, $ay);
                 $t .= '</div>';
                 $t .= '<div class="col-sm-6">';
                 $t .= $table->iShowTable(2, 2, $chk, $ay);
                 $t .= '</div>';
                 $t .= '</div>';
                 $t .= '<div class="row">';
                 $t .= '<div class="col-sm-6">';
                 $t .= $table->iShowTable(3, 1, $chk, $ay);
                 $t .= '</div>';
                 $t .= '<div class="col-sm-6">';
                 $t .= $table->iShowTable(3, 2, $chk, $ay);
                 $t .= '</div>';
                 $t .= '</div>';
                 $t .= '<div class="row">';
                 $t .= '<div class="col-sm-6">';
                 $t .= $table->iShowTable(4, 1, $chk, $ay);
                 $t .= '</div>';
                 $t .= '<div class="col-sm-6">';
                 $t .= $table->iShowTable(4, 2, $chk, $ay);
                 $t .= '</div>';
                 $t .= '</div>';
                 $t .= '</div>';
                 echo $t;
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
          var id = $(".course").attr("id");
          $("#" + id).addClass('subBtn');
        })
      </script>
  </body>
</html>
