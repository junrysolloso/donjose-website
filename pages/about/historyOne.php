<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      require_once '../../pages/class/content.php';
      require_once '../../pages/class/data.php';
      $init = new initContents();
      $data = new process();
      $init->getTitle();
      $init->getStyle();
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['q'])) {
          $q = $data->iAvoidInject($_GET['q']);
          if ($data->iCheckNumbers($q)) {
            $id = $q;
          } else {
            $a  = '<script>';
            $a .= 'window.location = "../../pages/about/history.php";';
            $a .= '</script>';
            echo $a;
          }
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
    <?php include_once 'navAbout.php'; ?>
     <div class="container-fluid">
        <div class="row">
          <div class="col-sm-1"></div>
            <div class="col-sm-10">
              <div class="section-title text-center center">
                <h3>Our History</h3>
                <hr>
              </div>
                <?php
                  $history = new process();
                  $r = $history->iGetHistoryOne($id);
                  while ($f = $r->fetch_array()) {
                    $t  = '<h4 class="text-center">Academic Year '.$f["historyYear"].'</h4>';
                    $t .= '<p class="text-justify">'.$f["historyDesc"].'</p>';
                    $t .= '<a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'"><i class="fa fa-angle-double-left"> Back</i></a>';
                    echo $t;
                  }
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
        $("a").eq(1).addClass("mainBtn");
        $(".subBtnAbouts").eq(2).addClass('subBtn');
      })
    </script>
  </body>
</html>
