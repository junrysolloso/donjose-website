<?php
  require_once '../../../admin/pages/class/data.php';
  $data = new process();
  $check = new process();
  $flag = 1;
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
      // Validate
      $id = $check->iAvoidInject($_GET['id']);
      $cur = $check->iAvoidInject($_GET['cur']);
      $sem = $check->iAvoidInject($_GET['sem']);
      $year = $check->iAvoidInject($_GET['year']);
      $program = $check->iAvoidInject($_GET['program']);
      // Validate int
      if (!filter_var($id, FILTER_VALIDATE_INT) || !filter_var($sem, FILTER_VALIDATE_INT) || !filter_var($year, FILTER_VALIDATE_INT) || !filter_var($program, FILTER_VALIDATE_INT)) {
        $flag = 0;
        echo "Invalid Interger";
      }
      // Check number
      if (!$check->iCheckNumbers($id) || !$check->iCheckNumbers($sem) || !$check->iCheckNumbers($year) || !$check->iCheckNumbers($program)) {
        $flag = 0;
        echo "Invalid Interger";
      }
      // Check if empty
      if (empty($id) || empty($sem) || empty($year) || empty($program) || empty($cur)) {
        $flag = 0;
        echo "empty";
      }
      // Try to insert
      if ($flag !== 0) {
        if ($data->iInsertCourse($id, $sem, $year, $program, $cur)) {
          echo "Course(s) Successfully Updated.";
        }
      }
    }
  }
 ?>
