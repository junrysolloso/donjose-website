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
             <div class="col-sm-10">
               <div class="section-title text-center center">
                 <h3>Our Philosophy</h3>
                 <hr>
               </div>
               <p class="text-justify">
                 <?php
                   $philosophy = new process();
                   echo $txt = $philosophy->getSchoolData("philosophy");
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
        $(".subBtnAbouts").eq(3).addClass('subBtn');
      })
    </script>
  </body>
</html>
