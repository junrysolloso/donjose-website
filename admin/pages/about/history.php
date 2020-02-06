 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <?php
        session_start();
        require_once '../../../admin/pages/class/content.php';
        require_once '../../../admin/pages/class/data.php';
        $init = new initContents();
        $data = new process();
        $init->getTitle();
        $init->getStyle();
        $flag = 1; $imgClass = ""; $msg = "";
        if($_SERVER['REQUEST_METHOD'] == "POST") {
          if (isset($_POST['historyBtn'])) {
            $historyDesc = $data->iAvoidInject($_POST['historyDesc']);
            $historyYear = $data->iAvoidInject($_POST['historyYear']);
            // Check if empty
            if(empty($historyDesc) || empty($historyYear)) {
              $msgClass = $data->iGetMsg('cError');
              $msg = $data->iGetMsg('empty');
              $flag = 0;
            }
            // Try to add
            if($flag !== 0) {
              if($data->iAddHistory($historyYear, $historyDesc)) {
                $msgClass = $data->iGetMsg('cSuccess');
                $msg = $data->iGetMsg('sAdd');
              } else {
                $msgClass = $data->iGetMsg('cError');
                $msg = $data->iGetMsg('error');
              }
            }
          } else {
            $editDesc = $data->iAvoidInject($_POST['editDesc']);
            $editYear = $data->iAvoidInject($_POST['editYear']);
            $editId = $data->iAvoidInject($_POST['editId']);
            // Check if empty
            if(empty($editDesc) || empty($editYear) || empty($editId)) {
              $msgClass = $data->iGetMsg('cError');
              $msg = $data->iGetMsg('empty');
              $flag = 0;
            }
            // Validate int
            if (filter_var($editId, FILTER_VALIDATE_INT) === false) {
              $msgClass = $data->iGetMsg('cError');
              $msg = $data->iGetMsg('iInvalid');
              $flag = 0;
            }
            // Try to update
            if($flag !== 0) {
              if($data->iUpdateHistory($editYear, $editDesc, $editId)) {
                $msgClass = $data->iGetMsg('cSuccess');
                $msg = $data->iGetMsg('sUpdate');
              } else {
                $msgClass = $data->iGetMsg('cError');
                $msg = $data->iGetMsg('error');
              }
            }
          }
        }
      ?>
   </head>
   <body>
    <?php $init->getHeader() ?>
     <div class="container-fluid">
       <div class="container">
         <div class="row">
           <div class="col-sm-1"></div>
             <div class="col-sm-10">
               <h4 class="text-<?php echo $msgClass; ?> text-center"><?php echo $msg ?></h4>
               <h4 class="text-center">History List</h4>
               <div class="form-group">
                 <div class="input-group-btn">
                   <a href="#newHistory" data-toggle="modal" class="btn btn-primary">New History</a>
                 </div>
               </div>
              <?php
                 $eventsInfo = new process();
                 $t  = '<table id="History">';
                 $t .= '<thead><tr><th></th></tr></thead>';
                 $t .= '<tbody>';
                 $f = $eventsInfo->iGetHistory();
                 while ($r = $f->fetch_array()) {
                   $t .= '<tr><td>';
                   $t .= '<div class="box box-default">';
                   $t .= '<div class="box-header with-border">';
                   $t .= '<h4 class="text-center">Academic Year '.$r["historyYear"].'</h4>';
                   $t .= '</div>';
                   $t .= '<div class="box-body">';
                   $t .= '<input type="hidden" id="id'.$r["historyId"].'" value="'.$r["historyId"].'">';
                   $t .= '<input type="hidden" id="year'.$r["historyId"].'" value="'.$r["historyYear"].'">';
                   $t .= '<input type="hidden" id="desc'.$r["historyId"].'" value="'.$r["historyDesc"].'">';
                   if (strlen($r["historyDesc"]) > 500) {
                     $txt = mb_substr($r["historyDesc"], 0, 500, 'UTF-8').'...';
                     $t .= '<p class="text-justify">'.$txt.'</p>';
                   } else {
                    $t .= $r["historyDesc"];
                   }
                   $t .= '</div>';
                   $t .= '<div class="box-footer">';
                   $t .= '<a href="#" class="btn btn-primary edit" id="'.$r["historyId"].'">Edit Content</a>';
                   $t .= '</div>';
                   $t .= '</div>';
                   $t .= '</td></tr>';
                 }
                 $t .= '</tbody>';
                 $t .= '</table>';
                 echo $t;
               ?>
             </div>
           <div class="col-sm-1"></div>
         </div>
       </div>
      <?php $init->getScript() ?>
     </div>
     <div class="modal fade" id="newHistory">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Add History</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
               <div class="row">
                <div class="col-sm-3"></div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="historyYear">Academic Year</label>
                      <input type="text" class="form-control" name="historyYear" id="historyYear">
                    </div>
                  </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="historyDesc">Description</label>
                    <textarea class="form-control" name="historyDesc" style="height: 500px" id="historyDesc">History Description</textarea>
                  </div>
                </div>
               <div class="col-sm-12">
                 <button type="submit" name="historyBtn" value="send" class="btn btn-primary btn-block">Upload</button>
               </div>
               </div>
             </form>
           </div>
           <div class="modal-footer">
             <h5 class="text-center">&copy; DJEMFCST 2018</h5>
           </div>
         </div>
       </div>
     </div>
     <a href="#editHistory" data-toggle="modal" class="hide" id="editHistoryModal"></a>
     <div class="modal fade" id="editHistory">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h3 class="text-center">Add History</h3>
             <center><a href="#" data-dismiss="modal"><i class="fa fa-times-circle fa-2x"></i></a></center>
           </div>
           <div class="modal-body">
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
               <div class="row">
                <div class="col-sm-3"></div>
                  <div class="col-sm-6">
                    <div class="form-group hide">
                      <label for="editId">Id</label>
                      <input type="hidden" class="form-control" name="editId" id="editId">
                    </div>
                    <div class="form-group">
                      <label for="editYear">Academic Year</label>
                      <input type="text" class="form-control" name="editYear" id="editYear">
                    </div>
                  </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="editDesc">Description</label>
                    <textarea class="form-control" name="editDesc" style="height: 500px" id="editDesc">History Description</textarea>
                  </div>
                </div>
               <div class="col-sm-12">
                 <button type="submit" name="editBtn" value="send" class="btn btn-primary btn-block">Upload</button>
               </div>
               </div>
             </form>
           </div>
           <div class="modal-footer">
             <h5 class="text-center">&copy; DJEMFCST 2018</h5>
           </div>
         </div>
       </div>
     </div> 
     <script>
      $(function () {
        $(window).load(function () {
          $(".mainButton").eq(1).addClass("mainBtn");
          $(".subBtnAbout").eq(3).addClass("subBtn");
          $("#navAbout").slideDown('slow');
        })
        $(".edit").click(function (e) {
          e.preventDefault();
          var id = $(this). attr("id");
          var year = $("#year" + id).val();
          var desc = $("#desc" + id).val();
          $("#editYear").val(year);
          $("#editDesc").val(desc);
          $("#editId").val(id);
          $("#editHistoryModal").trigger('click');
        })
        $("#historyDesc").wysihtml5();
        $("#History").DataTable({
          'paging'       : true,
          'lengthChange' : false,
          'searching'    : false,
          'ordering'     : false,
          'info'         : false,
          'autoWidth'    : false
        })
       })
     </script>
   </body>
 </html>
