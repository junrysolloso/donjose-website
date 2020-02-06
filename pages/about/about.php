<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      session_start();
      require_once '../../pages/class/content.php';
      require_once '../../pages/class/data.php';
      $init = new initContents();
      $init->getTitle();
      $init->getStyle();
     ?>
  </head>
  <body>
    <div class="container main-con">
    <?php
      $init->getHeader();
      $init->getNavigation();
     ?>
    <div class="disp-container">
    <?php include_once 'navAbout.php'; ?>
     <div class="container-fluid">
       <div class="row">
         <div class="col-sm-1"></div>
         <div class="col-sm-3">
           <?php
             $image = new process();
             $getImg = $image->getMessageData();
             $r = $getImg->fetch_array();
             echo '<img class="imgStatic" src="../../upload/faculty/'.$r[3].'" width="100%" height="270px">';
           ?>
         </div>
         <div class="col-sm-7 border-left">
           <h3>Head of School's Welcome</h3>
           <?php
             $message = new process();
             $getMessage = $message->getMessageData();
             $r = $getMessage->fetch_array();
             $f  = '<p class="text-justify">';
             $f .= $r[2].'</p>';
             $f .= '<p>';
             $f .= $r[1];
             $f .= '<br>';
             $f .= 'School '.$r[0];
             $f .= '</p>';
             echo $f;
           ?>
         </div>
         <div class="col-sm-1"></div>
       </div>
       <br>
       <div class="row">
      <div class="col-sm-1"></div>
        <div class="col-sm-10">
          <div class="col-sm-6">
            <h3 class="margin-bot">Enrollments</h3>
            <div class="row">
              <div class="col-xs-6">
                Elementary
              </div>
              <div class="col-xs-6">
                <?php
                  $elementary = new process();
                  echo ": ".$elementary->iCount('elementary', 'enrollment_data');
                ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                Junior/Senior High School
              </div>
              <div class="col-xs-6">
                <?php
                  $highSchool = new process();
                  echo ": ".$highSchool->iCount('highSchool', 'enrollment_data');
                ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                College
              </div>
              <div class="col-xs-6">
                <?php
                  $college = new process();
                  echo ": ".$college->iCount('college', 'enrollment_data');
                ?>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <h3 class="margin-bot">Summary</h3>
            <div class="row">
              <div class="col-xs-6">
                Faculty
              </div>
              <div class="col-xs-6">
                <?php
                  $facultySum = new process();
                  echo ": ".$facultySum->iCount('facultySum', 'summary_data');
                ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                Staff
              </div>
              <div class="col-xs-6">
                <?php
                  $staffSum = new process();
                  echo ": ".$staffSum->iCount('staffSum', 'summary_data');
                ?>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                Part-time:
              </div>
              <div class="col-xs-6">
                <?php
                  $partSum = new process();
                  echo ": ".$partSum->iCount('partSum', 'summary_data');
                ?>
              </div>
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
        $("a").eq(1).addClass("mainBtn");
        $(".subBtnAbouts").eq(0).addClass('subBtn');
      })
    </script>
  </body>
</html>
