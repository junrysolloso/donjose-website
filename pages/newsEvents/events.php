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
               <div class="row">
                 <div class="col-sm-9 border-right">
                   <?php
                     $t .= '<table id="eventsTable">';
                     $t .= '<thead><tr><th></th></tr></thead>';
                     $t .= '<tbody>';
                     $r = $data->iGetNewsEvents("events");
                     while ($f = $r->fetch_array()) {
                       $e = date($f["eventDate"]);
                       $n = date('l M d, Y',strtotime($e));
                       $t .= '<tr><td>';
                       $t .= '<div class="container-fluid">';
                       $t .= '<div class="row">';
                       $t .= '<div class="col-sm-4">';
                       $t .= '<div class="portfolio-item">';
                       $t .= '<div class="hover-bg"> <a href="../../upload/gallery/'.$f["eventImage"].'" data-lightbox-gallery="gallery1">';
                       $t .= '<img src="../../upload/gallery/'.$f["eventImage"].'" height="230px" width="100%"></a>';
                       $t .= '</div>';
                       $t .= '</div>';
                       $t .= '</div>';
                       $t .= '<div class="col-sm-8">';
                       $t .= '<p>'.$f["eventTitle"];
                       $t .= '<br>'.$n.'<br>';
                       $t .= $f["eventWhere"].'</p><hr>';
                       if (strlen($f["eventDesc"]) > 180) {
                         $desc = mb_substr($f["eventDesc"], 0, 180, 'UTF-8').'...';
                       } else {
                         $desc = $f["eventDesc"];
                       }
                       $t .= '<p class="text-justify">'.$desc.'</p>';
                       $t .= '<a href="../../pages/newsEvents/eventsOne.php?q='.$f["eventId"].'">Read More <i class="fa fa-angle-double-right"></i></a>';
                       $t .= '</div>';
                       $t .= '</div>';
                       $t .= '</div><hr>';
                       $t .= '</td></tr>';
                     }
                     $t .= '</tbody>';
                     $t .= '</table>';
                     echo $t;
                   ?>
                 </div>
                 <div class="col-sm-3">
                   <h4>Quick Links</h4>
                   <hr>
                   <?php
                    $r = $data->iGetEventsName();
                    while ($f = $r->fetch_array()) {
                      echo '<a href="../../pages/newsEvents/eventsOne.php?q='.$f["eventId"].'">'.$f["eventTitle"].'</a><br>';
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
        $("a").eq(6).addClass("mainBtn");
        $(".subBtnNewsEvents").eq(1).addClass('subBtn');
        $("#eventsTable").DataTable({
          'paging'       : true,
          'searching'    : false,
          'lengthChange' : false,
          'ordering'     : false,
          'autoWidth'    : false,
          'info'         : false
        })
      })
    </script>
  </body>
</html>
