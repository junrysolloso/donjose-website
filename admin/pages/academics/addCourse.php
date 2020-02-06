<?php
  require_once '../../../admin/pages/class/data.php';
  $addCourse = new process();
  $flag = 1; $msg = "";
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['aYear'])) {
      // Validate and sanitize
      $addCode = $addCourse->iAvoidInject($_GET['addCode']);
      $addDesc = $addCourse->iAvoidInject($_GET['addDesc']);
      $addLec = $addCourse->iAvoidInject($_GET['addLec']);
      $addLab = $addCourse->iAvoidInject($_GET['addLab']);
      $addYear = $addCourse->iAvoidInject($_GET['addYear']);
      $addSem = $addCourse->iAvoidInject($_GET['addSem']);
      $addProgram = $addCourse->iAvoidInject($_GET['addProgram']);
      $aYear = $addCourse->iAvoidInject($_GET['aYear']);
      // Check for empty input
      if(empty($addCode) || empty($addDesc) || empty($addYear) || empty($addSem) || empty($addProgram) || empty($aYear)) {
        $flag = 0;
        $msg = $addCourse->iGetMsg('empty');
      }
      // Validate input int
      if (filter_var($addLec, FILTER_VALIDATE_INT) === false) {
        $flag = 0;
        $msg = $addCourse->iGetMsg('iInvalid');
      } elseif (filter_var($addLab, FILTER_VALIDATE_INT) === false) {
        $flag = 0;
        $msg = $addCourse->iGetMsg('iInvalid');
      }
      // Try to add
      if($flag !== 0) {
        if($addCourse->iAddCourse($addCode, $addDesc, $addLab, $addLec, $addYear, $addSem, $addProgram, $aYear)) {
          $msg = $addCourse->iGetMsg('sAdd');
        } else {
          $msg = $addCourse->iGetMsg('error');
        }
      }
      echo $msg;
    }
  }
 ?>
