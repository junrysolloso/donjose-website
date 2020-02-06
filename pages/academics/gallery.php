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
      $init->getTitle();
      $init->getStyle();
      $t = "";
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $q = $data->iAvoidInject($_GET['q']);
        if ($data->iCheckLetters($q)) {
          $chk = $q;
        } else {
          $a  = '<script>';
          $a .= 'window.location = "../../pages/academics/academics.php";';
          $a .= '</script>';
          echo $a;
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
                 $t .= '<div class="container-fluid gallery">';
                 $t .= '<div class="section-title text-center center">';
                 $t .= '<br><h3>'.$chk.' Gallery</h3>';
                 $t .= '<hr>';
                 $t .= '</div>';
                 $t .= '<div class="row">';
                 $t .= '<div class="portfolio-items">';
                 $u = $data->iGetImages($chk);
                 while($v = $u->fetch_array()) {
                   $t .= '<div class="col-sm-6 col-md-3 col-lg-3" style="height: 500px">';
                   $t .= '<div class="portfolio-item">';
                   $t .= '<h4 class="text-center">'.$v["galleryName"].'</h4>';
                   $t .= '<div class="hover-bg"> <a href="../../upload/gallery/'.$v["galleryImage"].'" data-lightbox-gallery="gallery1">';
                   $t .= '<img src="../../upload/gallery/'.$v["galleryImage"].'" height="200px" width="100%"></a>';
                   $t .= '</div>';
                   $t .= '<p>'.$v["galleryDesc"].'</p>';
                   $t .= '</div>';
                   $t .= '</div>';
                 }
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
          var $container = $('.portfolio-items');
          $container.isotope({
            filter: '*',
            animationOptions: {
              duration: 750,
              easing: 'linear',
              queue: false
            }
          })
          $('.portfolio-item a').nivoLightbox({
            effect: 'slideDown',
            keyboardNav: true
          });
        })
      </script>
  </body>
</html>
