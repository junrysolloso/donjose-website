<?php
  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(isset($_GET['Id'])){
      require_once '../../../admin/pages/class/data.php';
      $info = new process();
      $v = "";
      $r = $info->iShowPartTime("one", $_GET['Id']);
      $f = $r->fetch_array();
      $v .= '<div class="center">';
      $v .= '<img src="../../../upload/faculty/'.$f["partImage"].'" class="center-block" width="150px" height="150px">';
      $v .= '</div>';
      $v .= '<div class="section-title text-center center">';
      $v .= '<h3>'.$f["partName"].'</h3>';
      $v .= '<h5>'.$f["partCat"].' - '.$f["programTitle"].'</h5>';
      $v .= '<hr>';
      $v .= '</div>';
      $v .= '<div class="row">';
      $v .= '<div class="col-sm-12">';
      $v .= '<div class="HeaderTop">';
      $v .= '<div class="row">';
      $v .= '<div class="col-sm-2"></div>';
      $v .= '<div class="col-sm-8">';
      $v .= '<h3>Qualifications:</h3>';
      $v .= $f["partQual"];
      $v .= '</div>';
      $v .= '<div class="col-sm-2"></div>';
      $v .= '</div>';
      $v .= '</div>';
      $v .= '</div>';
      $v .= '</div>';
      echo $v;
    }
  }
?>
