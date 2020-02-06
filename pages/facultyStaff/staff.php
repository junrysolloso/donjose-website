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
       $t .= '<h3>Staff Directory</h3><hr>';
       $t .= '</div>';
       $t .= '<div class="row">';
       $t .= '<div class="col-sm-4">';
       $t .= '<div class="section-title text-center center">';
       $t .= '<h4>Personal Information</h4>';
       $t .= '<hr>';
       $t .= '</div>';
       $t .= '<div id="staffDataDir"><h4 class="text-center">No Selected Staff.</h4></div>';
       $t .= '</div>';
       $t .= '<div class="col-sm-8 border-left">';
       $t .= '<div class="section-title text-center center">';
       $t .= '<h4>Staff List</h4>';
       $t .= '<hr>';
       $t .= '</div>';
       $t .= '<table class="table table-hover table-bordered" id="staffTable">';
       $t .= '<thead class="bg-success">';
       $t .= '<th>No</th>';
       $t .= '<th>Name</th>';
       $t .= '<th>Assignment</th>';
       $t .= '</thead>';
       $t .= '<tbody>';
       $g = $data->iShowAllStaff(0, "all");
       while ($h = $g->fetch_array()) {
         $t .= '<tr>';
         $t .= '<td>'.$count.'</td>';
         $t .= '<td><a href="#" class="staffOneDataDir" id="'.$h["staffId"].'">'.$h["staffName"].'</a></td>';
         $t .= '<td>'.$h["staffAssign"].'</td>';
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
        $(".subBtnFacultyStaff").eq(2).addClass('subBtn');
        $(".staffOneDataDir").click(function(e){
          e.preventDefault();
          var id = $(this).attr("id");
          ajaxFunction(id, "../../pages/query/staffOne.php", "staffDataDir");
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
        $("#staffTable").DataTable({
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
