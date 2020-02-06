<?php
  if(isset($_GET['Id'])){
    require_once '../../pages/class/data.php';
    $info = new process();
    $qual = new process();
    $v = "";
    $r = $info->iShowAllStaff($_GET['Id'], "one");
    $q = $qual->iShowFacultyQual($_GET['Id'], "staff");
    $f = $r->fetch_array();
    $u = $q->fetch_array();
    $v .= '<div class="text-center">';
    $v .= '<img src="../../upload/faculty/'.$f[1].'" width="150px" height="150px">';
    $v .= '</div>';
    $v .= '<div class="section-title text-center center">';
    $v .= '<h3>'.$f[0].'</h3>';
    $v .= '<hr>';
    $v .= '</div>';
    $v .= '<div class="row">';
    $v .= '<div class="col-sm-12">';
    $v .= '<div class="HeaderTop">';
    $v .= '<h3>Qualifications:</h3>';
    $v .= $u[0];
    $v .= '</div>';
    $v .= '</div>';
    $v .= '</div>';
    echo $v;
  }
?>
