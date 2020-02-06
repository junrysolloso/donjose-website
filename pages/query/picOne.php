  <?php
    require_once '../../pages/class/data.php';
    $data = new process();
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_GET['q'])) {
        $id = $data->iAvoidInject($_GET['q']);
        $tb = $data->iAvoidInject($_GET['t']);
        // Check chars
        if(!$data->iCheckLetters($tb)) {
          $a  = '<script>';
          $a .= 'window.location = "'.htmlspecialchars($_SERVER['HTTP_REFERER']).'";';
          $a .= '</script>';
          echo $a;
        }
        // Check int
        if (!$data->iCheckNumbers($id)) {
          $a  = '<script>';
          $a .= 'window.location = "'.htmlspecialchars($_SERVER['HTTP_REFERER']).'";';
          $a .= '</script>';
          echo $a;
        }
        if ($tb == "gd") {
          $a  = '<script>';
          $a .= 'window.location = "../../pages/newsEvents/galleryOne.php?q='.$id.'";';
          $a .= '</script>';
          echo $a;
        } elseif ($tb == "ed") {
          $a  = '<script>';
          $a .= 'window.location = "../../pages/newsEvents/eventsOne.php?q='.$id.'";';
          $a .= '</script>';
          echo $a;
        } else {
          $a  = '<script>';
          $a .= 'window.location = "../../pages/newsEvents/newsOne.php?q='.$id.'";';
          $a .= '</script>';
          echo $a;
        }
      }
    }
  ?>
