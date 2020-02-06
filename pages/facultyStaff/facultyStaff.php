<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      require_once '../../pages/class/content.php';
      require_once '../../pages/class/data.php';
      $init = new initContents();
      $data = new process();
      $get = new process();
      $init->getTitle();
      $init->getStyle();
      $count = 1;
      $dept = "none";
      if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['q'])) {
          $q = $data->iAvoidInject($_GET['q']);
          if ($data->iCheckLettersAll($q)) {
            $dept = $q;
          } else {
            $dept = "none";
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
      include_once 'navFacultyStaff.php';

       $t  = '<div class="container-fluid">';
       $t .= '<div class="row">';
       $t .= '<div class="col-sm-1"></div>';
       $t .= '<div class="col-sm-10">';
       $t .= '<div class="row">';
       $t .= '<div class="col-sm-9 border-right">';
       $t .= '<div class="section-title text-center center">';
       $t .= '<h3>Faculty List</h3>';
       $t .= '<hr>';
       $t .= '</div>';
       $t .= '<table class="table table-hover table-bordered" id="facultyTable">';
       $t .= '<thead class="bg-success">';
       $t .= '<th>No</th>';
       $t .= '<th>Name</th>';
       $t .= '<th>Position</th>';
       $t .= '<th>Department</th>';
       $t .= '</thead>';
       $t .= '<tbody>';
       $f = $data->iShowFaculty($dept);
       while ($s = $f->fetch_array()){
         $t .= '<tr>';
         $t .= '<td>'.$count.'</td>';
         $t .= '<td><a href="#" class="facultyOneDataDir" id="'.$s["facultyId"].'">'.$s["lastName"].', '.$s["firstName"].' '.$s["middleName"].'.</a></td>';
         $t .= '<td>'.$s["posName"].'</td>';
         $t .= '<td>'.$s["deptTitle"].'</td>';
         $t .= '</tr>';
         $count++;
       }
       $t .= '</tbody>';
       $t .= '</table>';
       $t .= '</div>';
       $t .= '<div class="col-sm-3">';
       $t .= '<div class="section-title">';
       $t .= '<h3>Department</h3>';
       $t .= '<hr>';
       $t .= '</div>';
       $r = $get->iGetAllDept();
       while ($f = $r->fetch_array()) {
         $t .= '<p>';
         $t .= '<a href="'.htmlspecialchars($_SERVER['PHP_SELF']).'?q='.$f["deptTitle"].'">'.$f["deptTitle"].'</a></p>';
       }
       $t .= '</div>';
       $t .= '</div>';
       $t .= '</div>';
       $t .= '<div class="col-sm-1"></div>';
       $t .= '</div>';
       $t .= '</div>';
       echo $t;
       $init->getFooter();
       $init->getScript();
      ?>
    </div>
    <a href="#personalInfoData" class="hide" data-toggle="modal" id="personalInfoModal"></a>
    <div class="modal fade" id="personalInfoData">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-center">Personal Information</h3>
            <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
          </div>
          <div class="modal-body">
            <div id="personalInfo"></div>
          </div>
          <div class="modal-footer">
            <h5 class="text-center">&copy; DJEMFCST 2018</h5>
          </div>
        </div>
      </div>
    </div>
    <script>
      $(function () {
        $("a").eq(4).addClass("mainBtn");
        $(".subBtnFacultyStaff").eq(0).addClass('subBtn');
        $(".facultyOneDataDir").click(function (e) {
          e.preventDefault();
          var id = $(this).attr("id");
          var ajax = new XMLHttpRequest();
          ajax.onreadystatechange = function () {
            if(ajax.readyState == 4) {
              var r = ajax.responseText;
              var d = document.getElementById("personalInfo");
              d.innerHTML = r;
              $("#personalInfoModal").trigger('click');
            }
          }
          var q = "?Id=" + id;
          ajax.open('GET', 'facultyOne.php' + q, true);
          ajax.send(null);
        })
        $("#facultyTable").DataTable({
          'paging'       : false,
          'searching'    : true,
          'lengthChange' : false,
          'ordering'     : false,
          'autoWidth'    : false,
          'info'         : false
        })
      })
    </script>
  </body>
</html>
