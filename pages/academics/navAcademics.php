<div class="container-fluid navAbout-container">
  <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
      <ul class="nav nav-brand nav-justified">

        <?php
          require_once '../../pages/class/data.php';
          $get = new process(); 
          $r = $get->iGetAllDept();
          while ($f = $r->fetch_array()) {
            if (strlen($f["deptTitle"]) > 2) {
              $id = mb_substr($f["deptTitle"], 0, 3, 'UTF-8');
            }
            echo '<li><a href="../../pages/academics/academics.php?q='.$f["deptTitle"].'" class="subBtnAcademics sameWidth" id="'.$id.'">'.$f["deptTitle"].'</a></li>';
          }
         ?>
      </ul>
    </div>
    <div class="col-sm-1"></div>
  </div>
</div>
<br>
