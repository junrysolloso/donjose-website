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
                <h3>Our History</h3>
                <hr>
              </div>
              <div class="row">
                <div class="col-sm-9 border-right">
                  <?php
                    $t = "";
                    $history = new process();
                    $r = $history->iGetHistory();
                    while ($f = $r->fetch_array()) {
                      if(strlen($f["historyDesc"]) > 550){
                        $t .= '<h4>Academic Year '.$f["historyYear"].'</h4>';
                        $t .= '<p id="p'.$f["historyId"].'" class="text-justify">'.mb_substr($f["historyDesc"], 0, 550,'UTF-8').'...</p>';
                        $t .= '<a href="../../pages/about/historyOne.php?q='.$f["historyId"].'"><i class="fa fa-angle-double-right"> Read More</i></a><hr>';
                      }
                    }
                    echo $t;
                  ?>
                </div>
                <div class="col-sm-3">
                  <h4>Quick Links</h4>
                  <hr>
                  <?php
                    $get = new process();
                    $r = $get->iGetHistoryYear();
                    while ($f = $r->fetch_array()) {
                      echo '<i class="fa fa-angle-double-right"></i> <a href="../../pages/about/historyOne.php?q='.$f["historyId"].'">'.$f["historyYear"].'</a><br>';
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
        $("a").eq(1).addClass("mainBtn");
        $(".subBtnAbouts").eq(2).addClass('subBtn');
      })
    </script>
  </body>
</html>
