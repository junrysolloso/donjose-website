<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      session_start();
      require_once '../admin/pages/class/data.php';
      if (!isset($_SESSION['userId'])) {
        echo '<script>window.location.href="../admin/login.php"</script>';
      }
      $data = new process();
      $get = new process();
    ?>
    <title>Don Jose</title>
    <meta charset="utf-8">
    <meta name="viewport" content = "width = device-width, initial-scale=1">
    <link type="image" rel="icon" href="../upload/images/icon.png">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/adminStyle.css">
  </head>
  <body>
    <div class="navbar-fixed-top">
      <header>
        <?php
          require_once '../admin/pages/class/data.php';
          $n  = '<div class="header">';
          $n .= '<div class="row">';
          $n .= '<div class="col-sm-2">';
          $n .= '<img src="../upload/images/logo.png" class="pull-right" width="66px" height="66px">';
          $n .= '</div>';
          $n .= '<div class="col-sm-9">';
          $n .= '<h4 class="text-center">DON JOSE ECLEO MEMORIAL FOUNDATION COLLEGE OF SCIENCE AND TECHNOLOGY</h4>';
          $n .= '<h5 class="text-center">Justiniana San Jose Dinagat Islands</h5>';
          $n .= '</div>';
          $n .= '<div class="col-sm-1"></div>';
          $n .= '</div>';
          $n .= '</div>';
          // Main navigation
          $mainNav = array(
            'main' => array(
               array("#", "mainButton", "Home",      "Home"),
               array("#", "mainButton", "About",     "About"),
               array("#", "mainButton", "Academics", "Academics"),
               array("#", "mainButton", "Admission", "Admission"),
               array("#", "mainButton", "Faculty",   "Faculty & Staff"),
               array("#", "mainButton", "Student",   "Student Life"),
               array("#", "mainButton", "News",      "News & Events"),
               array("#", "mainButton", "Assets",     "Assets")
             )
           );
           $n .= '<nav class="mainNav-head" role="navigation">';
           $n .= '<ul class="nav nav-tabs nav-justified">';
           foreach ($mainNav as $key) {
             foreach ($key as $k => $v) {
               $n .= '<li><a href="'.$v[0].'" class="'.$v[1].'" id="'.$v[2].'">'.$v[3].'</a></li>';
             }
           }
           $n .= '</ul>';
           $n .= '</nav>';
          // Sub Main navigation
          $SubMainNav = array(
            'about' => array('navAbout' =>  array(
              array("../admin/pages/about/message.php",    "subBtnAbout", "", "Message"),
              array("../admin/pages/about/mission.php",    "subBtnAbout", "", "Mission"),
              array("../admin/pages/about/vision.php",     "subBtnAbout", "", "Vision"),
              array("../admin/pages/about/history.php",    "subBtnAbout", "", "History"),
              array("../admin/pages/about/philosophy.php", "subBtnAbout", "", "Philosophy")
            )),
            'admission' => array('navAdmission' =>  array(
              array("../admin/pages/admission/process.php",     "subBtnAdmission", "", "Enrollment Process"),
              array("../admin/pages/admission/freshmen.php",    "subBtnAdmission", "", "Freshmen"),
              array("../admin/pages/admission/transferees.php", "subBtnAdmission", "", "Tranferees"),
              array("../admin/pages/admission/old.php",         "subBtnAdmission", "", "Old Students"),
              array("../admin/pages/admission/tcc.php",         "subBtnAdmission", "", "Graduates")
            )),
            'faculty' => array('navFaculty' =>  array(
              array("../admin/pages/facultyStaff/faculty.php",  "subBtnFacultyStaff",  "", "Faculty"),
              array("../admin/pages/facultyStaff/partTime.php", "subBtnFacultyStaff",  "", "Part-Time"),
              array("../admin/pages/facultyStaff/staff.php",    "subBtnFacultyStaff",  "", "Staff")
            )),
            'student' => array('navStudent' =>  array(
              array("../admin/pages/studentLife/arts.php",          "subBtnStudentLife", "", "Arts & Culture"),
              array("../admin/pages/studentLife/athletics.php",     "subBtnStudentLife", "", "Athletics"),
              array("../admin/pages/studentLife/organizations.php", "subBtnStudentLife", "", "Student Organization")
            )),
            'newsevents' => array('navNews' =>  array(
              array("../admin/pages/newsEvents/news.php",   "subBtnNewsEvents", "", "News"),
              array("../admin/pages/newsEvents/events.php", "subBtnNewsEvents", "", "Events")
            )),
            'assets' => array('navAssets' =>  array(
              array("../admin/pages/assets/copyright.php",  "subBtnAssets", "btneditCopyright",  "Copyright"),
              array("../admin/pages/assets/terms.php",      "subBtnAssets", "btneditTerms",      "Terms & Conditions"),
              array("../admin/pages/assets/usage.php",      "subBtnAssets", "btneditUsage",      "Usage Policy"),
              array("../admin/pages/assets/disclaimer.php", "subBtnAssets", "btneditDisclaimer", "Disclaimer")
            )),
            'home' => array('navHome' =>  array(
              // array("../admin/pages/index/summary.php",      "subBtnHome", "subBtnHome", "Summary"),
              array("../admin/pages/index/enrollments.php",  "subBtnHome", "subBtnHome", "EnrollmentS"),
              array("../admin/pages/index/gallery.php",      "subBtnHome", "subBtnHome", "School Gallery"),
              array("../admin/pages/index/setting.php",      "subBtnHome", "subBtnHome", "Setting"),
              array("../admin/pages/index/logout.php",       "subBtnHome", "subBtnHome", "Sign Out")
          ))
          );
          foreach ($SubMainNav as $key) {
            foreach ($key as $k => $v) {
              $n .= '<div class="subNav-bg hide" id="'.$k.'">';
              $n .= '<div class="row">';
              $n .= '<div class="col-sm-1"></div>';
              $n .= '<div class="col-sm-10">';
              $n .= '<nav role="navigation">';
              $n .= '<ul class="nav nav-brand nav-justified">';
              foreach ($v as $kk) {
                $n .= '<li><a href="'.$kk[0].'" class="'.$kk[1].'" id="'.$kk[2].'">'.$kk[3].'</a></li>';
              }
              $n .= '</ul>';
              $n .= '</nav>';
              $n .= '</div>';
              $n .= '<div class="col-sm-1"></div>';
              $n .= '</div>';
              $n .= '</div>';
            }
          }
          $n .= '<div class="subNav-bg hide" id="navAcademics">';
          $n .= '<div class="row">';
          $n .= '<div class="col-sm-1"></div>';
          $n .= '<div class="col-sm-10">';
          $n .= '<nav role="navigation">';
          $n .= '<ul class="nav nav-brand nav-justified">';
          $r = $get->iGetAllDept();
          while ($f = $r->fetch_array()) {
           $n .= '<li><a href="#" class="subBtnAcademics sameWidth" id="subBtnAcademics'.$f["deptId"].'">'.$f["deptTitle"].'</a></li>';
          }
          $n .= '</ul>';
          $n .= '</nav>';
          $n .= '</div>';
          $n .= '<div class="col-sm-1"></div>';
          $n .= '</div>';
          $n .= '</div>';
          // Sub navigation for academics
          $get = new process();
          $r = $get->iGetAllDept();
          while ($f = $r->fetch_array()) {
            $programs = new process();
            $n .= '<div class="row subNav-academics hide" id="navsubBtnAcademics'.$f["deptId"].'">';
            $n .= '<div class="col-sm-1"></div>';
            $n .= '<div class="col-sm-10">';
            $n .= '<nav role="navigation">';
            $n .= '<ul class="nav nav-tabs nav-justified">';
            $program  = $programs->iGetAllProgram("name", $f["deptTitle"], "");
            while ($f = $program->fetch_array()) {
              $n .= '<li><a href="../admin/pages/academics/program.php?q='.$f["programTitle"].'">'.$f["programTitle"].'</a></li>';
            }
            $n .= '</ul>';
            $n .= '</nav>';
            $n .= '</div>';
            $n .= '<div class="col-sm-1"></div>';
            $n .= '</div>';
          }
          echo $n;
         ?>
      </header>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-1"></div>
          <div class="col-sm-10 text-center">
            <h3> <?php
              if (isset($_SESSION['userId'])) {
                $r = $data->iGetUser();
                while ($f = $r->fetch_array()) {
                  echo '<img src="../upload/images/'.$f["userImage"].'" class="img-circle" alt="User Image" width="160px" height="160px">';
                  echo '<h4>'.$f["fullName"].' | Administrator</h4>';
                }
              }
            ?></h3>
            <h2>Welcome to DJEMFCST Website Admin</h2>
          </div>
        <div class="col-sm-1"></div>
      </div>
    </div>
    <script scr="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.1.11.1.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script>
      $(function () {
        var tmp = "";
        $(window).load(function () {
          $("a").eq(0).addClass('mainBtn');
        })
        $(".mainButton").mouseenter(function () {
          var id = $(this).attr("id");
          $(".subNav-bg").hide();
          $(".subNav-academics").hide();
          $('.mainButton').removeClass('mainBtn');
          $(this).addClass('mainBtn');
          $("#nav" + id).slideDown('fast');
        })
        $(".subBtnAcademics").mouseenter(function () {
          var id = $(this).attr("id");
          tmp = id;
          $(".subNav-academics").hide();
          $(".subBtnAcademics").removeClass('subBtn');
          $(this).addClass('subBtn');
          $("#nav" + id).slideDown('fast');
        })
        $(".subNav-academics").mouseenter(function () {
          $("#" + tmp).addClass('subBtn');
        })
        $("#navHome").slideDown('fast');
      })
    </script>
  </body>
</html>
