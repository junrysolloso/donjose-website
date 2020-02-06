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
            $a .= 'window.location = "../../pages/newsEvents/newsEvents.php";';
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
       <?php include_once 'navNewEvents.php'; ?>
       <div class="container-fluid">
         <div class="row">
           <div class="col-sm-1"></div>
             <div class="col-sm-10">
               <div class="section-title text-center center">
                 <h3>Upcoming Events</h3>
                 <hr>
               </div>
                 <?php
                   $r = $data->iGetNewsEventsOne("events", $id);
                   while ($f = $r->fetch_array()) {
                     $e = date($f["eventDate"]);
                     $n = date('l M d, Y',strtotime($e));
                     $t .= '<tr><td>';
                     $t .= '<div class="container-fluid">';
                     $t .= '<div class="row">';
                     $t .= '<div class="col-sm-4">';
                     $t .= '<div class="portfolio-item">';
                     $t .= '<div class="hover-bg"> <a href="../../upload/gallery/'.$f["eventImage"].'" data-lightbox-gallery="gallery1">';
                     $t .= '<img src="../../upload/gallery/'.$f["eventImage"].'" id="img" class="animated rubberBand" height="230px" width="100%"></a>';
                     $t .= '</div>';
                     $t .= '</div>';
                     $t .= '</div>';
                     $t .= '<div class="col-sm-8">';
                     $t .= '<p>'.$f["eventTitle"];
                     $t .= '<br>'.$n.'<br>';
                     $t .= $f["eventWhere"].'</p><hr>';
                     $t .= '<p class="text-justify">'.$f["eventDesc"].'</p>';
                     $t .= '<a href="'.htmlspecialchars($_SERVER["HTTP_REFERER"]).'"><i class="fa fa-angle-double-left"></i> Back</a>';
                     $t .= '</div>';
                     $t .= '</div>';
                     $t .= '</div>';
                   }
                   echo $t;
                 ?>
               </div>
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
        $("a").eq(6).addClass("mainBtn");
        $(".subBtnNewsEvents").eq(1).addClass('subBtn');
        var img = document.getElementById("img");
        setInterval(function () {
          img.classList.toggle("rubberBand");
        }, 2000)
      })
    </script>
  </body>
</html>
