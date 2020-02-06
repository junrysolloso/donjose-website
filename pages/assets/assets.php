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
       <div class="disp-container" id="mainAboutContainer">
         <div class="container-fluid navAbout-container">
           <div class="row">
             <div class="col-sm-2"></div>
             <div class="col-sm-8">
               <ul class="nav nav-brand nav-justified">
                 <li><a href="#" class="subBtnAssets" id="subBtnAssetsCopy">Copyright</a></li>
                 <li><a href="#" class="subBtnAssets" id="subBtnAssetsUsage">Usage Policy</a></li>
                 <li><a href="#" class="subBtnAssets" id="subBtnAssetsTerms">Terms & Conditions</a></li>
                 <li><a href="#" class="subBtnAssets" id="subBtnAssetsDisc">Disclaimer</a></li>
               </ul>
             </div>
             <div class="col-sm-2"></div>
           </div>
         </div>
         <br>
         <div id="assetsContainer">
           <div class="container-fluid" id="dvsubBtnAssetsCopy">
             <div class="row">
               <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                   <div class="section-title text-center center">
                     <br><h2>Copyright</h2>
                     <hr><br>
                   </div>
                   <p class="text-justify">
                     <?php
                       $copyright = new process();
                       echo $copyright->iShowData('copyright', '', 'asset_data');
                     ?>
                   </p>
                 </div>
               <div class="col-sm-1"></div>
             </div>
           </div>
           <div class="container-fluid" id="dvsubBtnAssetsUsage" style="display:none">
             <div class="row">
               <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                   <div class="section-title text-center center">
                     <br><h2>Usage Policy</h2>
                     <hr><br>
                   </div>
                   <p class="text-justify">
                     <?php
                       $usagePolicy = new process();
                       echo $usagePolicy->iShowData('usagePolicy', '', 'asset_data');
                     ?>
                   </p>
                 </div>
               <div class="col-sm-1"></div>
             </div>
           </div>
           <div class="container-fluid" id="dvsubBtnAssetsTerms" style="display:none">
             <div class="row">
               <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                   <div class="section-title text-center center">
                     <br><h2>Terms & Conditions</h2>
                     <hr><br>
                   </div>
                   <p class="text-justify">
                     <?php
                       $termsConditions = new process();
                       echo $termsConditions->iShowData('termsConditions', '', 'asset_data');
                     ?>
                   </p>
                 </div>
               <div class="col-sm-1"></div>
             </div>
           </div>
           <div class="container-fluid" id="dvsubBtnAssetsDisc" style="display:none">
             <div class="row">
               <div class="col-sm-1"></div>
                 <div class="col-sm-10">
                   <div class="section-title text-center center">
                     <br><h2>Disclaimer</h2>
                     <hr><br>
                   </div>
                   <p class="text-justify">
                     <?php
                       $disclaimer = new process();
                       echo $disclaimer->iShowData('disclaimer', '', 'asset_data');
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
            $(window).load(function () {
              $(".subBtnAssets").eq(0).addClass("subBtn");
            })
            $(".subBtnAssets").click(function (e) {
              e.preventDefault();
              var id = $(this).attr("id");
              hideContainer();
              $(".subBtnAssets").removeClass("subBtn");
              $("#dv" + id).slideDown(400);
            })
            function hideContainer() {
              $("#assetsContainer").children("div").slideUp(400);
            }
          })
        </script>
    </div>
  </body>
</html>
