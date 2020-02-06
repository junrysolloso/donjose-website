<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      session_start();
      $_SESSION['id'] = "user".rand(0, 10000);
    ?>
    <title>Don Jose</title>
    <meta charset="utf-8">
    <meta name="viewport" content = "width = device-width, initial-scale=1">
    <link type="image" rel="icon" href="upload/images/icon.png">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/clientStyle.css">
    <link rel="stylesheet" type="text/css" href="assets/nivo-lightbox/nivo-lightbox.css">
    <link rel="stylesheet" type="text/css" href="assets/nivo-lightbox/default.css">
  </head>
  <body>
    <div class="container main-con">
      <div class="container-fluid main-header">
        <div class="header">
          <img src="upload/images/logo.png" class="center-block hide" width="120px" height="120px">
          <h3 class="text-center hide">DON JOSE ECLEO MEMORIAL FOUNDATION COLLEGE OF SCIENCE AND TECHNOLOGY</h3>
          <h4 class="text-center hide">Justiniana Edera, San Jose, Dinagat Islands</h4>

        </div>
      </div>
      <nav role="navigation" class="mainNav">
        <ul class="nav nav-brand nav-justified">
          <li><a href="#" class="mainBtn">Home</a></li>
          <li><a href="pages/about/about.php">About Us</a></li>
          <li><a href="pages/academics/academics.php">Academics</a></li>
          <li><a href="pages/admission/admission.php">Admission</a></li>
          <li><a href="pages/facultyStaff/facultyStaff.php">Faculty & Staff</a></li>
          <li><a href="pages/studentLife/studentLife.php">Student Life</a></li>
          <li><a href="pages/newsEvents/newsEvents.php">News & Events</a></li>
        </ul>
      </nav>
    <div class="img-container">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <?php
            require_once 'pages/class/data.php';
            $insertImage = new process();
            $getAllImage = new process();
            $getImageId  = new process();
            $data = new process();
            $insertImage->iQueryImage("insertImage");
            $all = $getAllImage->iQueryImage("getAll");
          ?>
         <div class="carousel-inner" role="listbox">
            <?php
              $c = 0; $e = "";
              while($r = $all->fetch_array()) {
                $ft =  $r["fromTable"];
                if($ft == "gallery_data"){
                  $tb = "gd";
                } elseif($ft == "events_data"){
                  $tb = "ed";
                } elseif($ft == "news_data"){
                  $tb = "nd";
                }
                if($c == 0) {
                  $e .= '<div class="item active">';
                  $e .= '<img src="upload/gallery/'.$r["tempImage"].'" width="100%">';
                  $e .= '<div class="carousel-caption">';
                  $e .= '<h3>'.$r["fromName"].'</h3>';
                  $e .= '</div>';
                  $e .= '</div>';
                }
                if ($c > 0) {
                  $e .= '<div class="item">';
                  $e .= '<a href="pages/query/picOne.php?q='.$r["fromId"].'&&t='.$tb.'">';
                  $e .= '<img src="upload/gallery/'.$r["tempImage"].'" width="100%">';
                  $e .= '</a>';
                  $e .= '<div class="carousel-caption">';
                  $e .= '<h3>'.$r["fromName"].'</h3>';
                  $e .= '</div>';
                  $e .= '</div>';
                }
                $c++;
              }
              echo $e;
            ?>
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
    <div class="container-fluid"><br>
      <div class="row">
        <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="row">
              <div class="col-sm-4">
                <div class="section-title text-center center">
                  <h3>Welcome Message</h3>
                  <hr>
                </div>
                <?php
                  $image = new process();
                  $message = new process();
                  $getMessage = $message->getMessageData();
                  $getImg = $image->getMessageData();
                  $r = $getImg->fetch_array();
                  echo '<img src="upload/faculty/'.$r[3].'" width="100%" height="270px"><br>';
                  $r = $getMessage->fetch_array();
                  $f  = '<p class="text-justify">';
                  if (strlen($r[2]) > 250) {
                    $f .= mb_substr($r[2], 0, 250, 'UTF-8').'...</p>';
                  } else {
                    $f .= $r[2];
                  }
                  $f .= '<p>';
                  $f .= $r[1];
                  $f .= '<br>';
                  $f .= 'School '.$r[0];
                  $f .= '</p>';
                  echo $f;
                ?>
                <a href="pages/about/about.php"><i class="fa fa-angle-double-right"></i> Read More</a>
              </div>
              <div class="col-sm-8">
                <div class="section-title text-center center">
                  <h3>Vission</h3>
                  <hr>
                </div>
                <p>
                  <?php
                    $vission = new process();
                    echo $vission->iShowData('vision', '', 'school_data');
                  ?>
                </p>
                <div class="section-title text-center center">
                  <h3>Mission</h3>
                  <hr>
                </div>
                <p>
                  <?php
                    $mission = new process();
                    echo $mission->iShowData('mission', '', 'school_data');
                  ?>
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9">
                <div class="row">
                  <div class="col-sm-6">
                    <h3>News</h3>
                    <hr>
                    <?php
                      $c = 0; $t = "";
                      $r = $data->iGetNewsName();
                      while ($f = $r->fetch_array()) {
                       if ($c < 5) {
                         $t .= '<div class="row">';
                         $t .= '<div class="col-sm-4">';
                         $t .= '<div class="portfolio-item">';
                         $t .= '<div class="hover-bg"> <a href="upload/gallery/'.$f["newsImage"].'" data-lightbox-gallery="gallery1">';
                         $t .= '<img src="upload/gallery/'.$f["newsImage"].'" id="imganimate" class="animated rubberBand" height="80px" width="100%"></a>';
                         $t .= '</div>';
                         $t .= '</div>';
                         $t .= '</div>';
                         $t .= '<div class="col-sm-8">';
                         if (strlen($f["newsDesc"]) > 70) {
                           $txt = mb_substr($f["newsDesc"], 0, 70, 'UTF-8').'...<br>';
                         } else {
                           $txt = $f["newsDesc"];
                         }
                         $t .= '<p>'.$txt;
                         $t .= '<a href="pages/newsEvents/newsOne.php?q='.$f["newsId"].'"><i class="fa fa-angle-double-right"></i> Read More</a></p>';
                         $t .= '</div>';
                         $t .= '</div>';
                       }
                       $c++;
                     }
                     echo $t;
                    ?>
                  </div>
                  <div class="col-sm-6">
                    <h3>Events</h3>
                    <hr>
                    <?php
                      $c = 0; $t = "";
                      $r = $data->iGetEventsName();
                      while ($f = $r->fetch_array()) {
                       if ($c < 5) {
                         $t .= '<div class="row">';
                         $t .= '<div class="col-sm-4">';
                         $t .= '<div class="portfolio-item">';
                         $t .= '<div class="hover-bg"> <a href="upload/gallery/'.$f["eventImage"].'" data-lightbox-gallery="gallery1">';
                         $t .= '<img src="upload/gallery/'.$f["eventImage"].'" id="imganimate" class="animated rubberBand" height="80px" width="100%"></a>';
                         $t .= '</div>';
                         $t .= '</div>';
                         $t .= '</div>';
                         $t .= '<div class="col-sm-8">';
                         if (strlen($f["eventDesc"]) > 70) {
                           $txt = mb_substr($f["eventDesc"], 0, 70, 'UTF-8').'...<br>';
                         } else {
                           $txt = $f["eventDesc"];
                         }
                         $t .= '<p>'. $txt;
                         $t .= '<a href="pages/newsEvents/eventsOne.php?q='.$f["eventId"].'"><i class="fa fa-angle-double-right"></i> Read More</a></p>';
                         $t .= '</div>';
                         $t .= '</div>';
                       }
                       $c++;
                     }
                     echo $t;
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <h3>Quick Links</h3>
                <hr>
                <p>
                  <a href="pages/academics/academics.php"> Programs Offered</a>
                </p>
                <p>
                  <a href="pages/facultyStaff/facultyStaff.php"> Faculty</a>
                </p>
                <p>
                  <a href="pages/admission/admission.php"> Freshmen Admission</a>
                </p>
                <p>
                  <a href="pages/admission/tcc.php"> TCC</a>
                </p>
                <?php
                  $c = $d = 0;
                  $r = $data->iGetActivityName("Arts");
                  while ($f = $r->fetch_array()) {
                   if ($c < 2) {
                     echo '
                     <p>
                      <a href="pages/studentLife/actOne.php?q='.$f["activityId"].'">'.$f["activityName"].'</a>
                     </p>';
                   }
                   $c++;
                 }
                  $r = $data->iGetActivityName("Organizations");
                  while ($f = $r->fetch_array()) {
                    if ($d < 1) {
                      echo '
                      <p>
                        <a href="pages/studentLife/actOne.php?q='.$f["activityId"].'">'.$f["activityName"].'</a>
                      </p>';
                    }
                    $d++;
                  }
                ?>
              </div>
            </div>
          </div>
        <div class="col-sm-1"></div>
      </div>
    </div>
  </div>

  <div class="container main-con">
    <div class="footer">
      <br><br>
      <footer>
        <div class="row">
          <div class="col-sm-2"></div>
            <div class="col-sm-8">
              <div class="row">
                <div class="col-sm-4">
                  <p>
                    <a href="index.php" >Home</a>
                  </p>
                  <p>
                    <a href="pages/about/about.php">About Us</a>
                  </p>
                  <p>
                    <a href="pages/academics/academics.php">Academics</a>
                  </p>
                  <p>
                    <a href="pages/admission/admission.php">Admission</a>
                  </p>
                </div>
                <div class="col-sm-4">
                  <p>
                    <a href="pages/facultyStaff/facultyStaff.php"> Faculty & Staff</a>
                  </p>
                  <p>
                    <a href="pages/studentLife/studentLife.php"> Student Life</a>
                  </p>
                  <p>
                    <a href="pages/newsEvents/newsEvents.php"> News & Events</a>
                  </p>
                </div>
                <div class="col-sm-4">
                  <p><b>Contact Us</b></p>
                  <p><i class="fa fa-phone"></i> +63-93049493553</p>
                  <p><i class="fa fa-envelope"></i> schoolemail@gmail.com</p>
                  <p><b>Visit Us</b></p>
                  <p><i class="fa fa-map-marker"></i> Justiniana Edera, San Jose, Province of Dinagat Islands</p>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                  <a href="pages/assets/assets.php">Copyright</a>
                  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                  <a href="pages/assets/assets.php">Usage Policy</a>
                  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                  <a href="pages/assets/assets.php">Terms & Conditions</a>
                  &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                  <a href="pages/assets/assets.php">Disclaimer</a>
                </div>
                <div class="col-sm-2"></div>
              </div>
              <div class="row">
                <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                    <h5 class="text-center">&copy; DJEMFCST 2018</h5>
                  </div>
                <div class="col-sm-4"></div>
              </div>
            </div>
          <div class="col-sm-2"></div>
        </div>
        <br><br>
      </footer>
    </div>
    </div>
     <script src="assets/js/jquery.1.11.1.js"></script>
     <script src="assets/js/bootstrap.min.js"></script>
     <script src="assets/js/nivo-lightbox.js"></script>
      <script src="assets/js/jquery.isotope.js"></script>
     <script>
       $(function () {
         var p = document.getElementsByTagName("p");
         var li = document.getElementsByTagName("li");
         var pLen = p.length;
         var liLen = li.length;
         var w = $(window).width();
         if (w < 768) {
           for (var i = 0; i < pLen; i++) {
             p[i].classList.add('text-justify');
           }
         } else {
           for (var i = 0; i < pLen; i++) {
             p[i].classList.add('text-justify');
           }
         }
         for (var i = 0; i < liLen; i++) {
           li[i].classList.add('text-justify');
         }
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
          })
       })
     </script>
  </body>
</html>
