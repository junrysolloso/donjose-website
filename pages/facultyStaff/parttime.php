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
      $count = 1;
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
       $t .= '<div class="section-title text-center center">';
       $t .= '<h3>Part-Time Directory</h3><hr>';
       $t .= '</div>';
       $t .= '<div class="row">';
       $t .= '<div class="col-sm-4">';
       $t .= '<div class="section-title text-center center">';
       $t .= '<h4>Personal Information</h4>';
       $t .= '<hr>';
       $t .= '</div>';
       $t .= '<div id="partTimeDataDir"><h5 class="text-center">No Selected Part-Timer.</h5></div>';
       $t .= '</div>';
       $t .= '<div class="col-sm-8 border-left">';
       $t .= '<div class="section-title text-center center">';
       $t .= '<h4>Part-Time List</h4>';
       $t .= '<hr>';
       $t .= '</div>';
       $t .= '<table class="table table-hover table-bordered"  id="partTable">';
       $t .= '<thead class="bg-success">';
       $t .= '<th>No</th>';
       $t .= '<th>Name</th>';
       $t .= '<th>Department</th>';
       $t .= '</thead>';
       $t .= '<tbody>';
       $j = $data->iShowAllPartTime(0, "all");
       while ($k = $j->fetch_array()) {
         $t .= '<tr>';
         $t .= '<td>'.$count.'</td>';
         $t .= '<td><a href="#" class="partTimeOneDataDir" id="'.$k["facultyId"].'">'.$k["lastName"].', '.$k["firstName"].' '.$k["middleName"].'.</a></td>';
         $t .= '<td>'.$k["deptTitle"].'</td>';
         $t .= '</tr>';
         $count++;
       }
       $t .= '</tbody>';
       $t .= '</table>';
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
    <script>
      $(function () {
        $("a").eq(4).addClass("mainBtn");
        $(".subBtnFacultyStaff").eq(1).addClass('subBtn');
        $(".partTimeOneDataDir").click(function(e){
          e.preventDefault();
          var id = $(this).attr("id");
          ajaxFunction(id, "../../pages/query/facultyOne.php", "partTimeDataDir");
        })
        function ajaxFunction(id, page, divSuc) {
         var ajaxRequest = new XMLHttpRequest();
         ajaxRequest.onreadystatechange = function(){
           if(ajaxRequest.readyState == 4){
              var ajaxDisplay = document.getElementById(divSuc);
              ajaxDisplay.innerHTML = ajaxRequest.responseText;
           }
         }
         var queryString = "?Id=" + id ;
         ajaxRequest.open('GET', page + queryString, true);
         ajaxRequest.send(null);
        }
        $("#partTable").DataTable({
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
