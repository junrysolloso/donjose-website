<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
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
       <?php include_once 'navAdmission.php'; ?>
       <div class="container-fluid">
         <div class="row">
           <div class="col-sm-1"></div>
             <div class="col-sm-10">
               <div class="section-title text-center center">
                 <h2>Admission Requirements</h2>
                 <hr>
               </div>
               <div class="row">
                 <div class="col-sm-6 border-right">
                   <div class="section-title">
                     <h3>Old Students</h3>
                     <hr>
                   </div>
                   <?php
                     $old = new process();
                     echo $old->iShowRequirements("requirementsOld");
                   ?>
                 </div>
                 <div class="col-sm-6">
                   <div class="section-title">
                     <h3>Enrollment Process</h3>
                     <hr>
                   </div>
                   <?php
                     $oldEn = new process();
                     echo $oldEn->iShowRequirements("oldEnProcess");
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
          $("a").eq(3).addClass('mainBtn');
          $(".subBtnAdmission").eq(1).addClass('subBtn');
        })
      </script>
  </body>
</html>
