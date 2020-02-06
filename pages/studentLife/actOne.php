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
            $id = $q;
          } else {
            $a  = '<script>';
            $a .= 'window.location = "../../pages/studentLife/studentLife.php";';
            $a .= '</script>';
            echo $a;
          }
        }
      }
      if (!isset($_SESSION['activity'])) {
        $act = "";
      } else {
        $act = $_SESSION['activity'];
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
       <?php include_once 'navStudentLife.php'; ?>
       <div class="container-fluid">
         <div class="row">
           <div class="col-sm-1"></div>
             <div class="col-sm-10">
               <div class="section-title text-center center">
                 <h3><?php echo $act ?></h3>
                 <hr>
               </div>
               <?php
                 $r = $data->iGetStudentActivity("one", $id);
                 while ($f = $r->fetch_array()) {
                   $t .= '<div class="container-fluid">';
                   $t .= '<div class="row">';
                   $t .= '<div class="col-sm-4">';
                   $t .= '<div class="portfolio-item">';
                   $t .= '<div class="hover-bg"> <a href="../../upload/gallery/'.$f["activityImage"].'" data-lightbox-gallery="gallery1">';
                   $t .= '<img src="../../upload/gallery/'.$f["activityImage"].'" height="230px" width="100%"></a>';
                   $t .= '</div>';
                   $t .= '</div>';
                   $t .= '</div>';
                   $t .= '<div class="col-sm-8">';
                   $t .= '<h3>'.$f["activityName"].'</h3>';
                   $t .= '<p class="text-justify">'.$f["activityDesc"].'</p>';
                   $t .= '<a href="'.htmlspecialchars($_SERVER["HTTP_REFERER"]).'"><i class="fa fa-angle-double-left"> Back</i></a>';
                   $t .= '</div>';
                   $t .= '</div>';
                   $t .= '</div>';
                 }
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
        $("a").eq(5).addClass("mainBtn");
      })
    </script>
  </body>
</html>
