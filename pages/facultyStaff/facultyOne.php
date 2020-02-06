<?php
  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['Id'])){
      require_once '../../pages/class/data.php';
      $info = new process();
      $qual = new process();
      $n = 1;
      $v = "";
      $r = $info->iGetFacultyInfo($_GET['Id']);
      if ($r) {
        $f = $r->fetch_array();
        $v .= '<div class="center">';
        $v .= '<img src="../../upload/faculty/'.$f["Image"].'" class="center-block" width="150px" height="150px">';
        $v .= '</div>';
        $v .= '<div class="section-title text-center center">';
        $v .= '<h3>'.$f["lastName"].', '.$f["firstName"].' '.$f["middleName"].'</h3>';
        $v .= '<h5>'.$f["deptTitle"].' - '.$f["posName"].'</h5>';
        $v .= '<hr>';
        $v .= '</div>';
        $v .= '<div class="row">';
        $v .= '<div class="col-sm-12">';
        $v .= '<div class="HeaderTop">';
        $v .= '<div class="row">';
        $v .= '<div class="col-sm-2"></div>';
        $v .= '<div class="col-sm-8">';
        $v .= '<h4>Baccalaureate Degree:</h4>';
        $v .= $f["qualDesc"];
        $v .= '</div>';
        $v .= '<div class="col-sm-2"></div>';
        $v .= '</div>';
        $v .= '</div>';
        $v .= '</div>';
        $v .= '</div>';
        echo $v;
      }
    }
  }
?>
