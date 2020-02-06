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
         <div class="col-sm-5 border-right">
           <div class="section-title text-center center">
             <h3>Mission</h3>
             <hr>
           </div>
           <p class="text-justify">
             <?php
               $mission = new process();
               echo $mission->iShowData('mission', '', 'school_data');
             ?>
           </p>
         </div>
         <div class="col-sm-5">
           <div class="section-title text-center center">
             <h3>Vission</h3>
             <hr>
           </div>
           <p class="text-justify">
             <?php
               $vission = new process();
               echo $vission->iShowData('vision', '', 'school_data');
             ?>
           </p>
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
        $(".subBtnAbouts").eq(1).addClass('subBtn');
      })
    </script>
  </body>
</html>
