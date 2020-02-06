<?php
  // Class connection
  include_once 'connect.php';
  // Class data processing
  class process extends connection
  {
    function __construct()
    {
      $this->connect();
    }
    // Clean data
    public function iAvoidInject($data)
    {
      // $sr = mysqli_real_escape_string($this->conn, $data);
      // $sr = stripslashes($sr);
      // $sr = htmlentities($sr);
      // $sr = htmlspecialchars($sr);
      // $r = trim($sr);
      return $data;
    }
    //
    // User
    //
    // Check username
    public function iCheckUser($name, $pass)
    {
      $cPass = sha1(md5($pass));
      $st = $this->conn->prepare("SELECT `userId` FROM `user_data` WHERE `userName` = ? AND `userPass` = ?");
      $st->bind_param("ss", $name, $cPass);
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          if ($f) {
            $r = $f[0];
          } else {
            $r = 0;
          }
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get Enrollments
    public function iGetEnrollments()
    {
      $st = $this->conn->prepare("SELECT * FROM `enrollment_data`");
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          return $r;
        }
      }
      $st->close();
      $this->conn->close();
    }
    // update ay setting
    public function iUpdateAYSetting($ay)
    {
      $st = $this->conn->prepare("UPDATE `setting_data` SET `courseAY` = ? WHERE `settingId` = 1");
      if($st->bind_param("s", $ay)) {
        if ($st) {
          if ($st->execute()) {
            return true;
          }
        }
      }
    }
    // Get Summary
    public function iGetSummary()
    {
      $st = $this->conn->prepare("SELECT * FROM `summary_data`");
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          return $r;
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Update user info
    public function iUpdateUser($username, $password, $fullname, $imgName)
    {
      $cPass = sha1(md5($password));
      if ($imgName == "") {
        $st = $this->conn->prepare("UPDATE `user_data` SET `userName` = ?, `userPass` = ?, `fullName` = ? WHERE `userId` = 1");
        if ($st->bind_param("sss", $username, $cPass, $fullname)) {
          if ($st) {
            if ($st->execute()) {
              return true;
              $st->close();
              $this->conn->close();
            }
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT `userImage` FROM `user_data` WHERE `userId` = 1");
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            $f = $r->fetch_array();
            $r = $f[0];
            if ($r) {
              if (unlink("../../../upload/images/$r")) {
                $st = $this->conn->prepare("UPDATE `user_data` SET `userName` = ?, `userPass` = ?, `fullName` = ?, `userImage`  = ? WHERE `userId` = 1");
                if ($st->bind_param("ssss", $username, $cPass, $fullname, $imgName)) {
                  if ($st) {
                    if ($st->execute()) {
                      return true;
                      $st->close();
                      $this->conn->close();
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    // Update summary
    public function iUpdateSum($faculty, $parttime, $staff)
    {
      $st = $this->conn->prepare("UPDATE `summary_data` SET `facultySum`= ?,`staffSum`= ?,`partSum`= ? WHERE `summaryId` = 1");
      if($st->bind_param("iii", $faculty, $staff, $parttime)) {
        if ($st) {
          if ($st->execute()) {
            return true;
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Update Enrollments
    public function iUpdateEn($elementary, $highSchool, $college)
    {
      $st = $this->conn->prepare("UPDATE `enrollment_data` SET `elementary`= ?,`highSchool`= ?,`college`= ? WHERE `enrollmentId` = 1");
      if($st->bind_param("iii", $elementary, $highSchool, $college)) {
        if ($st) {
          if ($st->execute()) {
            return true;
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Get user
    public function iGetUser()
    {
      $st = $this->conn->prepare("SELECT * FROM `user_data` WHERE `userId` = 1 ");
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Update Assest
    public function iUpdateAssets($id, $txt)
    {
      $cData  = new process();
      $dData = $cData->iAvoidInject($txt);
      if($id == "editCopyright") {
        $st = $this->conn->prepare("UPDATE `asset_data` SET `copyright` = ? WHERE `assetId` = 1");
        $st->bind_param("s", $dData);
      } elseif ($id == "editTerms") {
        $st = $this->conn->prepare("UPDATE `asset_data` SET `termsConditions` = ? WHERE `assetId` = 1");
        $st->bind_param("s", $dData);
      } elseif ($id == "editUsage") {
        $st = $this->conn->prepare("UPDATE `asset_data` SET `usagePolicy` = ? WHERE `assetId` = 1");
        $st->bind_param("s", $dData);
      } else {
        $st = $this->conn->prepare("UPDATE `asset_data` SET `disclaimer` = ? WHERE `assetId` = 1");
        $st->bind_param("s", $dData);
      }
      if($st->execute()) {
        $r = 1;
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Return Asset
    public function iReturnAssets($col)
    {
      $n = new process();
      $c = $n->iAvoidInject($col);
      $st = $this->conn->prepare("SELECT $c FROM `asset_data` WHERE `assetId` = 1");
      if($st->execute()) {
        $v = $st->get_result();
        $f = $v->fetch_array();
        $r = $f[0];
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Update message
    public function iUpdateMessageInfo($name, $pos, $desc, $image)
    {
      if($image == "") {
        $st = $this->conn->prepare("UPDATE `message_data` SET `messageName` = ? , `messagePos` = ? , `messageDesc` = ?  WHERE `messageId` = 1");
        if ($st->bind_param("sss", $name, $pos, $desc)) {
          if ($st) {
            if ($st->execute()) {
              return true;
            }
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT `messageImage` FROM `message_data` WHERE `messageId` = 1");
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            $f = $r->fetch_array();
            $r = $f[0];
            if ($r !== "" || $r !== NULL) {
              if (unlink("../../../upload/faculty/$r")) {
                $st = $this->conn->prepare("UPDATE `message_data` SET `messageName` = ?, `messagePos` = ?, `messageDesc` = ?, `messageImage` = ? WHERE `messageId` = 1");
                if ($st->bind_param("ssss", $name, $pos, $desc, $image)) {
                  if ($st) {
                    if ($st->execute()) {
                      return true;
                    }
                  }
                }
              }
            }
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Update  mission & vision
    public function iUpdateMissionVision($id, $txt)
    {
      if($id == "editMission") {
        $col = "mission";
      } else {
        $col = "vision";
      }
      $st = $this->conn->prepare("UPDATE `school_data` SET `$col` = ? WHERE `schoolId` = 1");
      $st->bind_param("s", $txt);
      if($st->execute()) {
        $r = 1;
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Update Philosophy
    public function iUpdatePhilosophy($desc)
    {
      $st = $this->conn->prepare("UPDATE `school_data` SET `philosophy` = ? WHERE `schoolId` = 1");
      $st->bind_param("s", $desc);
      if($st->execute()) {
        $r = 1;
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get history data
    public function iGetHistory()
    {
      $st = $this->conn->prepare("SELECT * FROM `history_data`");
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Check image
    public function iCheckImage($tmpName, $targetFile, $imgSize, $fileType)
    {
      $msg = new process();
      $rValue = array('uploadOk' => 1, 'msg' => "", 'msgClass' => "");
      // Check image if fake
      $check = getimagesize($tmpName);
      if ($check !== false) {
        $rValue['uploadOk'] = 1;
      } else {
        $rValue['msg'] = $msg->iGetMsg('fFalse');
        $rValue['uploadOk'] = 0;
        $rValue['msgClass'] = $msg->iGetMsg('cError');
      }
      // Check file if already exist
      if(file_exists($targetFile)) {
        $rValue['msg'] = $msg->iGetMsg('fExist');
        $rValue['uploadOk'] = 0;
        $rValue['msgClass'] = $msg->iGetMsg('cError');
      }
      // limit file size
      if($imgSize > 5000000) {
        $rValue['msg'] = $msg->iGetMsg('fSize');
        $rValue['uploadOk'] = 0;
        $rValue['msgClass'] = $msg->iGetMsg('cError');
      }
      // File format allowed
      if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "JPG") {
        $rValue['msg'] = $msg->iGetMsg('fAllowed');
        $rValue['uploadOk'] = 0;
        $rValue['msgClass'] = $msg->iGetMsg('cError');
      }
      return $rValue;
    }
    // Match only letter and whitespace and period
    public function iCheckLetters($letters)
    {
      if(preg_match("/^[a-zA-Z .]*$/", $letters)) {
        return 1;
      }
    }
    // Match letters only and whitespace
    public function iCheckLettersAll($letters)
    {
      if(preg_match("/^[a-zA-Z 0-9-]*$/", $letters)) {
        return 1;
      }
    }
    // Match number
    public function iCheckNumbers($n)
    {
      if(preg_match("/^[0-9]*$/", $n)) {
        return true;
      }
    }
    //
    // History
    //
    // Add History
    public function iAddHistory($year, $desc)
    {
      $st = $this->conn->prepare("INSERT INTO `history_data`( `historyYear`, `historyDesc`) VALUES (? ,? )");
      $st->bind_param("ss", $year, $desc);
      if($st) {
        if ($st->execute()) {
          $st->close();
          $this->conn->close();
          return true;
        }
      }
    }
    // Update history
    public function iUpdateHistory($year, $desc, $id)
    {
      $st = $this->conn->prepare("UPDATE `history_data` SET `historyYear`= ?, `historyDesc`= ? WHERE `historyId` = ?");
      $st->bind_param("ssi", $year, $desc, $id);
      if($st) {
        if ($st->execute()) {
          $st->close();
          $this->conn->close();
          return true;
        }
      }
    }
    //
    // Program
    //
    // Add program image
    public function iAddProgramImage($galleryName, $galleryDesc, $galleryImage, $galleryProgram)
    {
      $st = $this->conn->prepare("INSERT INTO `programgallery_data`(`galleryName`, `galleryDesc`, `galleryImage`, `galleryProgram`) VALUES (? ,? ,? ,? )");
      $st->bind_param("ssss", $galleryName, $galleryDesc, $galleryImage, $galleryProgram);
      if($st->execute()) {
        $r = 1;
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Add program image
    public function iAddSchoolImage($galleryName, $galleryDesc, $galleryImage, $galleryProgram)
    {
      $st = $this->conn->prepare("INSERT INTO `gallery_data`(`galleryName`, `galleryDesc`, `galleryImage`) VALUES (? ,? ,?)");
      if($st->bind_param("sss", $galleryName, $galleryDesc, $galleryImage)) {
        if ($st) {
          if($st->execute()) {
            return true;
            $st->close();
            $this->conn->close();
          }
        }
      }
    }
    // Update program
    public function iUpdateProgram($programTitle, $programName, $programDesc, $programDept, $programImage, $programId)
    {
      if($programImage == "") {
        $st = $this->conn->prepare("UPDATE `program_data` SET `programTitle`= ?, `programName`= ?,`programDesc`= ? WHERE `programId` =  ?");
        if ($st->bind_param("sssi", $programTitle, $programName, $programDesc, $programId)) {
          if ($st) {
            if ($st->execute()) {
              $st = $this->conn->prepare("UPDATE `deptjunc_data` INNER JOIN `dept_data` SET deptjunc_data.deptId = (SELECT `deptId` FROM `dept_data` WHERE `deptTitle` = ?)
              WHERE deptjunc_data.programId = ?");
              if ($st->bind_param("si", $programDept, $programId)) {
                if ($st) {
                  if ($st->execute()) {
                    return true;
                  }
                }
              }
            }
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT `programImage` FROM `program_data` WHERE `programId` = ?");
        if ($st->bind_param("i", $programId)) {
          if ($st) {
            if ($st->execute()) {
              $r = $st->get_result();
              $f = $r->fetch_array();
              $r = $f[0];
              if ($r) {
                if (unlink("../../../upload/gallery/$r")) {
                  $st = $this->conn->prepare("UPDATE `program_data` SET `programTitle`= ?, `programName`= ?, `programDesc`= ?, `programImage`= ? WHERE `programId` =  ?");
                  if($st->bind_param("ssssi", $programTitle, $programName, $programDesc, $programImage, $programId)) {
                    if ($st) {
                      if ($st->execute()) {
                        return true;
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    //
    // Show course
    //
    // Show course in table
    public function iShowTable($year, $sem, $p, $ay)
    {
      $clean = new process();
      $cYear = $clean->iAvoidInject($year);
      $cSem  = $clean->iAvoidInject($sem);
      $pName = $clean->iAvoidInject($p);
      if($cSem == 1) {
        $s = "1st Semester";
      } else {
        $s = "2nd Semester";
      }
	    $v  = '<table class="table table-condensed table-hover table-bordered">';
	    $v .= '<thead class="bg-success">';
			$v .= '<tr>';
	    $v .= '<th width="12%">Code</th>';
	  	$v .= '<th width="50%">Description</th>';
	    $v .= '<th width="10%">Lec</th>';
	    $v .= '<th width="10%">Lab</th>';
      $v .= '<th width="18%">Action</th>';
			$v .= '</tr>';
	  	$v .= '</thead>';
	    $v .= '<tbody>';
      $st = $this->conn->prepare("SELECT subject_data.subjectId, `subjectCode`, `subjectDesc`, `subjectLab`, `subjectLec`, `curYear`, cur_data.curId, sem_data.semId, year_data.yearId, program_data.programId FROM `subject_data`
      INNER JOIN `subjunc_data` ON subject_data.subjectId = subjunc_data.subjectId
      INNER JOIN `year_data`    On year_data.yearId       = subjunc_data.yearId
      INNER JOIN `sem_data`     ON sem_data.semId         = subjunc_data.semId
      INNER JOIN `cur_data`     ON cur_data.curId         = subjunc_data.curId
      INNER JOIN `program_data` ON program_data.programId = subjunc_data.programId
      WHERE `yearName` = ? AND `semName` = ? AND `programTitle` = ? AND `curYear` = ? ");
      $st->bind_param("iiss", $cYear, $cSem, $pName, $ay);
      if($st->execute()) {
        $r = $st->get_result();
        $lec = $lab = 0;
  			while($f = $r->fetch_array()) {
  				$v .= '<tr>';
  				$v .= '<td id="subjectCode'.$f["subjectId"].'">'.$f["subjectCode"].'</td>';
  				$v .= '<td id="subjectDesc'.$f["subjectId"].'">'.$f["subjectDesc"].'</td>';
  				$v .= '<td id="subjectLec'.$f["subjectId"].'">'.$f["subjectLec"].'</td>';
  				$v .= '<td id="subjectLab'.$f["subjectId"].'">'.$f["subjectLab"].'</td>';
          $v .= '<input type="hidden" class="ayUpdateId" value="'.$f["subjectId"].'">';
          $v .= '<input type="hidden" class="ayUpdateSem" value="'.$f["semId"].'">';
          $v .= '<input type="hidden" class="ayUpdateYear" value="'.$f["yearId"].'">';
          $v .= '<input type="hidden" id="baseAySingleCourseProg'.$f["subjectId"].'" class="ayUpdateProgram" value="'.$f["programId"].'">';
          $v .= '<input type="hidden" id="baseDeleteAY'.$f["subjectId"].'" value="'.$f["curId"].'">';
          $v .= '<td class="hide" id="subjectSem'.$f["subjectId"].'">'.$cSem.'</td>';
  				$v .= '<td class="hide" id="subjectYear'.$f["subjectId"].'">'.$cYear.'</td>';
  				$v .= '<td class="hide" id="subjectProgram'.$f["subjectId"].'">'.$pName.'</td>';
          $v .= '<td class="hide" id="subjectAY'.$f["subjectId"].'">'.$f["curYear"].'</td>';
          $v .= '<td>';
          $v .= '<button type="button" id="'.$f["subjectId"].'" class="btn btn-primary btn-xs update"><i class="fa fa-pencil"></i></button>';
          $v .= '&nbsp;&nbsp;';
          $v .= '<button type="button" id="'.$f["subjectId"].'" class="btn btn-primary btn-xs migrate"><i class="fa fa-share-square-o"></i></button>';
          $v .= '&nbsp;&nbsp;';
          $v .= '<button type="button" id="'.$f["subjectId"].'" class="btn btn-danger btn-xs delete"><i class="fa fa-minus"></i></button>';
          $v .= '</td>';
  				$v .= '</tr>';
          $lec += $f["subjectLec"];
          $lab += $f["subjectLab"];
        }
      }
      $v .= '</tbody>';
      $v .= '<tfoot>';
      $v .= '<tr>';
      $v .= '<td colspan="2"></td>';
      $v .= '<td>'.$lec.'</td>';
      $v .= '<td>'.$lab.'</td>';
      $v .= '<td>'.($lec + $lab).' Units</td>';
      $v .= '</tr>';
      $v .= '</tfoot>';
	    $v .= '</table>';
      $st->close();
      $this->conn->close();
      return $v;
    }
    //  Count number of rows
    public function iCountRows($query)
    {
      $st = $this->conn->prepare($query);
      if($st->execute()) {
        $r = $st->get_result();
        $f = $r->fetch_array();
        $count = count($f);
      } else {
        $count = 0;
      }
      $st->close();
      $this->conn->close();
      return $count;
    }
    // Insert course to subjunc_data
    public function iInsertCourse($id, $sem, $year, $program, $cur)
    {
      $st = $this->conn->prepare("INSERT INTO `subjunc_data` (`subjectId`, `curId`, `programId`, `yearId`, `semId`)
      SELECT ?, `curId`, ?, ?, ? FROM `cur_data` WHERE `curYear` = ?");
      if ($st->bind_param("iiiis", $id, $program, $year, $sem, $cur)) {
        if ($st) {
          if ($st->execute()) {
            return true;
          }
        }
      }
    }
    //
    // Course
    //
    // Add course
    public function iAddCourse($subjectCode, $subjectDesc, $subjectLab, $subjectLec, $subjectLevel, $subjectSem, $subjectProgram, $aYear)
    {
      $st = $this->conn->prepare("SELECT * FROM `cur_data` WHERE `curYear` = ?");
      if ($st->bind_param("s", $aYear)) {
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            $exist = count($r->fetch_array());
            if ($exist == 0 || $exist == NULL) {
              $st = $this->conn->prepare("INSERT INTO `cur_data` (`curYear`) VALUES (?)");
              if ($st->bind_param("s", $aYear)) {
                if ($st) {
                  $st->execute();
                }
              }
            }
          }
        }
      }
      $st = $this->conn->prepare("INSERT INTO `subject_data` (`subjectCode`, `subjectDesc`, `subjectLab`, `subjectLec`) VALUES (?, ?, ?, ?)");
      if($st->bind_param("ssii", $subjectCode, $subjectDesc, $subjectLab, $subjectLec)) {
        if ($st) {
          if ($st->execute()) {
            $st = $this->conn->prepare("INSERT INTO `subjunc_data` (`subjectId`, `curId`, `programId`, `yearId`, `semId`) SELECT MAX(subjectId),
            (SELECT `curId` FROM `cur_data` WHERE `curYear` = ?), (SELECT `programId` FROM `program_data` WHERE `programTitle` = ?),
            (SELECT `yearId` FROM `year_data` WHERE `yearName` =?), (SELECT `semId` FROM `sem_data` WHERE `semName` = ?) FROM `subject_data`");
            $st->bind_param("ssss", $aYear, $subjectProgram, $subjectLevel, $subjectSem);
            if($st->execute()) {
              return true;
            }
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Update course
    public function iUpdateCourse($editCode, $editDesc, $editLab, $editLec, $editYear, $editSem, $editProgram, $editAY, $editId)
    {
      $st = $this->conn->prepare("UPDATE `subject_data` SET `subjectCode`= ?,`subjectDesc`= ?, `subjectLab`= ?,`subjectLec`= ? WHERE `subjectId`= ?");
      if($st->bind_param("ssiii", $editCode, $editDesc, $editLab, $editLec, $editId)) {
        if ($st) {
          if($st->execute()) {
            $st = $this->conn->prepare("SELECT `curId` FROM  `cur_data` WHERE  `curYear`= ?");
            if ($st->bind_param("s", $editAY)) {
              if ($st) {
                if ($st->execute()) {
                  $r = $st->get_result();
                  $f = $r->fetch_array();
                  $r = $f[0];
                  if ($r !== 0) {
                    $st = $this->conn->prepare("UPDATE `subjunc_data` SET `semId` = ?, `yearId` = ? WHERE `subjectId` = ? AND `curId` = ?");
                    if ($st->bind_param("iiii", $editSem, $editYear, $editId, $r)) {
                      if ($st) {
                        if ($st->execute()) {
                          return $r;
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Delete course
    public function iDeleteCourse($subjectId, $ay)
    {
      $st = $this->conn->prepare("DELETE FROM `subjunc_data` WHERE `subjectId`= ? AND `curId` = ?");
      if ($st->bind_param("ii", $subjectId, $ay)) {
        if ($st) {
          if($st->execute()) {
            return true;
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    //
    // Alert message
    //
    // Alert message
    public function iGetMsg($alert)
    {
      $arrMsg = array(
        'lAllowed' => "Only letters is allowed.",
        'fSize'    => "File is too large.",
        'fExist'   => "File is already exist.",
        'fFalse'   => "File is not an image.",
        'fAllowed' => "Sorry! JPG, JPEG, PNG files are allowed.",
        'empty'    => "Fields cannot be empty.",
        'sAdd'     => "Data successfully added.",
        'sUpdate'  => "Data successfully updated.",
        'sDelete'  => "Data successfully deleted.",
        'error'    => "Error processing request.",
        'cError'   => "danger",
        'cSuccess' => "success",
        'iInvalid' => "Integer is not valid",
        'nFile'    => "Please choose a file",
        'iUser'    => "Invalid username or password."
      );
      return $arrMsg[$alert];
    }
    //
    // Program image
    //
    // Add update program image
    public function iUpdateProgramImage($galleryName, $galleryDesc, $galleryImage, $id)
    {
      if($galleryImage == "") {
        $st = $this->conn->prepare("UPDATE `programgallery_data` SET `galleryName` = ?, `galleryDesc` = ? WHERE `galleryId` = ?");
        if($st->bind_param("ssi", $galleryName, $galleryDesc, $id)) {
          if ($st) {
            if($st->execute()) {
              return true;
              $st->close();
              $this->conn->close();
            }
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT `galleryImage` FROM `programgallery_data` WHERE `galleryId` = ?");
        $st->bind_param("i", $id);
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            $f = $r->fetch_array();
            $r = $f[0];
            if ($r !== "") {
              if (unlink("../../../upload/gallery/$r")) {
                $st = $this->conn->prepare("UPDATE `programgallery_data` SET `galleryName` = ?, `galleryDesc` = ?, `galleryImage` = ? WHERE `galleryId` = ?");
                if($st->bind_param("sssi", $galleryName, $galleryDesc, $galleryImage, $id)) {
                  if ($st) {
                    if($st->execute()) {
                      return true;
                      $st->close();
                      $this->conn->close();
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    // Add update school image
    public function iUpdateSchoolImage($galleryName, $galleryDesc, $galleryImage, $id)
    {
      if($galleryImage == "") {
        $st = $this->conn->prepare("UPDATE `gallery_data` SET `galleryName` = ?, `galleryDesc` = ? WHERE `galleryId` = ?");
        if($st->bind_param("ssi", $galleryName, $galleryDesc, $id)) {
          if ($st) {
            if($st->execute()) {
              return true;
              $st->close();
              $this->conn->close();
            }
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT `galleryImage` FROM `gallery_data` WHERE `galleryId` = ?");
        $st->bind_param("i", $id);
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            $f = $r->fetch_array();
            $r = $f[0];
            if ($r !== "") {
              if (unlink("../../../upload/gallery/$r")) {
                $st = $this->conn->prepare("UPDATE `gallery_data` SET `galleryName` = ?, `galleryDesc` = ?, `galleryImage` = ? WHERE `galleryId` = ?");
                if($st->bind_param("sssi", $galleryName, $galleryDesc, $galleryImage, $id)) {
                  if ($st) {
                    if($st->execute()) {
                      return true;
                      $st->close();
                      $this->conn->close();
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    // Add delete program image
    public function iDeleteProgramImage($id)
    {
      $st = $this->conn->prepare("SELECT `galleryImage` FROM `programGallery_data` WHERE `galleryId` = ?");
      $st->bind_param("i", $id);
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
          if ($r !== "") {
            if (unlink("../../../upload/gallery/$r")) {
              $st = $this->conn->prepare("DELETE FROM `programGallery_data` WHERE `galleryId` = '$id'");
              if($st->execute()) {
                return true;
                $st->close();
                $this->conn->close();
              }
            }
          }
        }
      }
    }
    // Add delete school image
    public function iDeleteSchoolImage($id)
    {
      $st = $this->conn->prepare("SELECT `galleryImage` FROM `gallery_data` WHERE `galleryId` = ?");
      $st->bind_param("i", $id);
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
          if ($r !== "") {
            if (unlink("../../../upload/gallery/$r")) {
              $st = $this->conn->prepare("DELETE FROM `gallery_data` WHERE `galleryId` = '$id'");
              if($st->execute()) {
                return true;
                $st->close();
                $this->conn->close();
              }
            }
          }
        }
      }
    }
    //
    // Add program
    //
    // Add new program
    public function iAddNewProgram($programTitle, $programName, $programDesc, $programImage, $programDept)
    {
      $st = $this->conn->prepare("INSERT INTO `program_data` (`programTitle`, `programName`, `programDesc`, `programImage`) VALUES ( ?, ?, ?, ?)");
      $st->bind_param("ssss", $programTitle, $programName, $programDesc, $programImage);
      if($st->execute()) {
        $st = $this->conn->prepare("INSERT INTO `deptjunc_data` (`programId`, `deptId`) SELECT MAX(programId), (SELECT `deptId` FROM `dept_data` WHERE `deptTitle` = ?) FROM `program_data`");
        if ($st->bind_param("s", $programDept)) {
          if ($st) {
            if ($st->execute()) {
              $st = $this->conn->prepare("UPDATE `dept_data` SET `deptStat` = 1 WHERE `deptTitle` = ?");
              if ($st->bind_param("i", $programDept)) {
                if ($st) {
                  if ($st->execute()) {
                    return true;
                  }
                }
              }
            }
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    //
    // Requirements
    //
    // Update requirements
    public function iUpdateRequirements($action, $req, $pro)
    {
      if ($action == "fresh") {
        $st = $this->conn->prepare("UPDATE `requirements_data` SET `requirementsFresh` = ? WHERE `requirementsId` = 1");
        $st->bind_param("s", $req);
      } elseif ($action == "trans") {
        $st = $this->conn->prepare("UPDATE `requirements_data` SET `requirementsTrans` = ? WHERE `requirementsId` = 1");
        $st->bind_param("s", $req);
      } elseif ($action == "old") {
        $st = $this->conn->prepare("UPDATE `requirements_data` SET `requirementsOld` = ?, `oldEnProcess` = ? WHERE `requirementsId` = 1");
        $st->bind_param("ss", $req, $pro);
      } elseif ($action == "tcc") {
        $st = $this->conn->prepare("UPDATE `requirements_data` SET `requirementsTcc` = ?, `tccEnProcess` = ? WHERE `requirementsId` = 1");
        $st->bind_param("ss", $req, $pro);
      } else {
        $st = $this->conn->prepare("UPDATE `requirements_data` SET `freshEnProcess` = ? WHERE `requirementsId` = 1");
        $st->bind_param("s", $req);
      }
      if($st->execute()) {
        $r = 1;
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    //
    // Faculty
    //
    // Add faculty
    public function iAddFaculty($firstname, $middlename, $lastname, $imgName, $catName, $facultyPos, $facultyDept, $facultyQual)
    {
      $st = $this->conn->prepare("INSERT INTO `faculty_data` (`firstName`, `middleName`,`lastName`, `Image`) VALUES (?, ?, ?, ?)");
      $st->bind_param("ssss", $firstname, $middlename, $lastname, $imgName);
      if ($st) {
        if ($st->execute()) {
          $st = $this->conn->prepare("INSERT INTO `qual_data` (`qualDesc`) VALUES(?)");
          $st->bind_param("s", $facultyQual);
          if ($st->execute()) {
            $st = $this->conn->prepare("INSERT INTO `facultyjunc_data` (`facultyId`, `deptId`, `catId`, `posId`, `qualId`) SELECT MAX(facultyId),
            (SELECT `deptId` FROM `dept_data` WHERE `deptTitle` = ?), (SELECT `catId` FROM `category_data` WHERE `catName` = ?),
            (SELECT `posId` FROM `facpos_data` WHERE `posName` = ?), (SELECT MAX(qualId) FROM `qual_data`) FROM `faculty_data`");
            $st->bind_param("sss", $facultyDept, $catName, $facultyPos);
            if ($st) {
              if ($st->execute()) {
                return true;
              }
            }
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Add faculty qualifation
    public function iAddFacultyQual($facultyId, $facultyQual)
    {
      $st = $this->conn->prepare("INSERT INTO `facultyqual_data`(`facultyId`, `facultyQual`) VALUES ( ?, ?)");
      $st->bind_param("is", $facultyId, $facultyQual);
      if ($st->execute()) {
        $r = 1;
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get faculty Id
    public function iGetFacultyid($name)
    {
      $st = $this->conn->prepare("SELECT MAX(facultyId) FROM `faculty_data`");
      if ($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Delete faculty
    public function iDeleteFaculty($id)
    {
      $st = $this->conn->prepare("SELECT `Image` FROM `faculty_data` WHERE `facultyId` = ?");
      $st->bind_param("i", $id);
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
          if ($r !== "") {
            if (unlink("../../../upload/faculty/$r")) {
              $st = $this->conn->prepare("DELETE FROM `faculty_data` WHERE `facultyId` = ?");
              $st->bind_param("i", $id);
              if ($st->execute()) {
                $st = $this->conn->prepare("DELETE FROM `qual_data` WHERE `qualId` = (SELECT `qualId` FROM `facultyjunc_data` WHERE `facultyId` = ?)");
                $st->bind_param("i", $id);
                if ($st->execute()) {
                  $st = $this->conn->prepare("DELETE FROM `facultyjunc_data` WHERE `facultyId` = ?");
                  $st->bind_param("i", $id);
                  if ($st->execute()) {
                    return true;
                  }
                }
              }
            }
          }
        }
      }
      $st->close();
      $stm->close();
      $this->conn->close();
    }
    // Update faculty
    public function iUpdateFaculty($editFirst, $editMiddle, $editLast, $imageName, $editCat, $editFacultyPos, $editDept, $editFacultyQual, $editFacultyId)
    {
      if ($imageName == "") {
        $st= $this->conn->prepare("UPDATE `faculty_data` SET `firstName`= ?, `middleName`= ?,`lastName`= ? WHERE `facultyId` = ?");
        $st->bind_param("sssi", $editFirst, $editMiddle, $editLast, $editFacultyId);
        if ($st) {
          if ($st->execute()) {
            $st = $this->conn->prepare("UPDATE `qual_data` SET `qualDesc` = ? WHERE `qualId` = (SELECT `qualId` from `facultyjunc_data` WHERE `facultyId` = ?)");
            $st->bind_param("si", $editFacultyQual, $editFacultyId);
            if ($st->execute()) {
              $st = $this->conn->prepare("UPDATE `facultyjunc_data` INNER JOIN dept_data INNER JOIN facpos_data SET
              facultyjunc_data.deptId = (SELECT `deptId` FROM `dept_data` WHERE `deptTitle` = ?),
              facultyjunc_data.catId = (SELECT `catId` FROM `category_data` WHERE `catName` = ?),
              facultyjunc_data.posId = (SELECT `posId` FROM `facpos_data` WHERE `posName` = ?) WHERE `facultyId` = ?");
              $st->bind_param("sssi", $editDept, $editCat, $editFacultyPos, $editFacultyId);
              if ($st->execute()) {
                return true;
              }
            }
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT `Image` FROM `faculty_data` WHERE `facultyId` = ?");
        $st->bind_param("i", $editFacultyId);
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
          if (unlink("../../../upload/faculty/$r")) {
            $st= $this->conn->prepare("UPDATE `faculty_data` SET `firstName`= ?, `middleName`= ?, `lastName`= ?, `Image`= ? WHERE `facultyId` = ?");
            $st->bind_param("ssssi", $editFirst, $editMiddle, $editLast, $imageName, $editFacultyId);
            if ($st) {
              if ($st->execute()) {
                $st = $this->conn->prepare("UPDATE `qual_data` SET `qualDesc` = ? WHERE `qualId` = (SELECT `qualId` from `facultyjunc_data` WHERE `facultyId` = ?)");
                $st->bind_param("si", $editFacultyQual, $editFacultyId);
                if ($st->execute()) {
                  $st = $this->conn->prepare("UPDATE `facultyjunc_data` INNER JOIN dept_data INNER JOIN facpos_data SET
                  facultyjunc_data.deptId = (SELECT `deptId` FROM `dept_data` WHERE `deptTitle` = ?),
                  facultyjunc_data.catId = (SELECT `catId` FROM `category_data` WHERE `catName` = ?),
                  facultyjunc_data.posId = (SELECT `posId` FROM `facpos_data` WHERE `posName` = ?) WHERE `facultyId` = ?");
                  $st->bind_param("sssi", $editDept, $editCat, $editFacultyPos, $editFacultyId);
                  if ($st->execute()) {
                    return true;
                  }
                }
              }
            }
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Add new Department
    public function iAddDept($newDept)
    {
      $st = $this->conn->prepare("INSERT INTO `dept_data`(`deptTitle`) VALUES(?)");
      if ($st->bind_param("s", $newDept)) {
        if ($st) {
          if ($st->execute()) {
            return true;
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Edit Department
    public function iUpdateDept($editDept, $editId)
    {
      $st = $this->conn->prepare("UPDATE `dept_data` SET `deptTitle` = ? WHERE `deptId`= ?");
      if ($st->bind_param("si", $editDept, $editId)) {
        if ($st) {
          if ($st->execute()) {
            return true;
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Check Department if has zero program
    public function iCheckDept()
    {
      $st = $this->conn->prepare("SELECT * FROM `dept_data` WHERE `deptStat` = 0");
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          return $r;
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Remove Department
    public function iRemoveDept($deleteId)
    {
      $st = $this->conn->prepare("DELETE FROM `dept_data` WHERE `deptId`= ?");
      if ($st->bind_param("i", $deleteId)) {
        if ($st) {
          if ($st->execute()) {
            return true;
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    //Get all Department
    public function iGetAllDept()
     {
       $st = $this->conn->prepare("SELECT * FROM `dept_data` WHERE `deptstat` = 1");
       if ($st) {
         if ($st->execute()) {
           $r = $st->get_result();
           return $r;
         }
       }
       $st->close();
       $this->conn->close();
     }
     //Get all Department
     public function iGetAllDeptAll()
      {
        $st = $this->conn->prepare("SELECT * FROM `dept_data`");
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            return $r;
          }
        }
        $st->close();
        $this->conn->close();
      }
    //
    // Part time
    //
    // Add part-timer
    public function iAddpartTime($partName, $imgName, $partPos, $partProgram)
    {
      $st = $this->conn->prepare("INSERT INTO `parttime_data`(`partName`, `partImage`, `partCat`, `partHandled`) VALUES (? ,? ,? ,? )");
      $st->bind_param("ssss", $partName, $imgName, $partPos, $partProgram);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Add part qualifation
    public function iAddPartTimeQual($partId, $partQual)
    {
      $st = $this->conn->prepare("INSERT INTO `partqual_data`(`partId`, `partQual`) VALUES (? ,? )");
      $st->bind_param("is", $partId, $partQual);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Get faculty Id
    public function iGetPartTimeId()
    {
      $st = $this->conn->prepare("SELECT MAX(partId) FROM `parttime_data`");
      if ($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get all part-Timer
    public function iShowPartTime($action, $id)
    {
      if ($action == "all") {
        $st = $this->conn->prepare("SELECT parttime_data.partId, `partName`, `partImage`, `partCat`, `partDept`, `partQual` FROM `parttime_data`
        INNER JOIN `partqual_data` ON parttime_data.partId = partqual_data.partId");
      } else {
        $st = $this->conn->prepare("SELECT parttime_data.partId, `partName`, `partImage`, `partCat`, `partDept`, `partQual` FROM `parttime_data`
        INNER JOIN `partqual_data` ON parttime_data.partId = partqual_data.partId WHERE parttime_data.partId = ? ");
        $st->bind_param("i", $id);
      }
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Update partTime
    public function iUpdatePartTime($partName, $partImage, $partCat, $partProgram, $id)
    {
      if ($partImage == "") {
        $st = $this->conn->prepare("UPDATE `parttime_data` SET `partName`= ?, `partCat`= ?,`partDept`= ? WHERE `partId` = ?");
        $st->bind_param("sssi", $partName, $partCat, $partProgram, $id);
      } else {
        $st= $this->conn->prepare("UPDATE `parttime_data` SET `partName`= ?,`partImage`= ?,`partCat`= ?,`partDept`= ? WHERE `partId` = ?");
        $st->bind_param("ssssi", $partName, $partImage, $partCat, $partProgram, $id);
      }
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Update partTime Qualifications
    public function iUpdatePartQual($partQual, $partId)
    {
      $st = $this->conn->prepare("UPDATE `partqual_data` SET `partQual`= ? WHERE `partId` = ?");
      $st->bind_param("si", $partQual, $partId);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Delete partTime
    public function iDeletePartTime($id)
    {
      $st = $this->conn->prepare("DELETE FROM `parttime_data` WHERE `partId` = ? ");
      $st->bind_param("i", $id);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Delete partTime qualifation
    public function iDeletePartQual($id)
    {
      $st = $this->conn->prepare("DELETE FROM `partqual_data` WHERE `partId` = ? ");
      $st->bind_param("i", $id);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    //
    // Staff
    //
    // Add Staff
    public function iAddStaff($staffName, $imgName, $staffPos, $staffProgram)
    {
      $st = $this->conn->prepare("INSERT INTO `staff_data`(`staffName`, `staffImage`, `staffCat`, `staffAssign`) VALUES (? ,? ,? ,? )");
      $st->bind_param("ssss", $staffName, $imgName, $staffPos, $staffProgram);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Add staff qualifation
    public function iAddStaffQual($staffId, $staffQual)
    {
      $st = $this->conn->prepare("INSERT INTO `staffqual_data`(`staffId`, `staffQual`) VALUES (? ,? )");
      $st->bind_param("is", $staffId, $staffQual);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Get staff Id
    public function iGetStaffId()
    {
      $st = $this->conn->prepare("SELECT MAX(staffId) FROM `staff_data`");
      if ($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get all Staff
    public function iShowStaff($action, $id)
    {
      if ($action == "all") {
        $st = $this->conn->prepare("SELECT staff_data.staffId, `staffName`, `staffImage`, `staffCat`, `staffQual`, `staffAssign` FROM `staff_data`
        INNER JOIN `staffqual_data` ON staff_data.staffId = staffqual_data.staffId");
      } else {
        $st = $this->conn->prepare("SELECT staff_data.staffId, `staffName`, `staffImage`, `staffCat`, `staffQual`, `staffAssign` FROM `staff_data`
        INNER JOIN `staffqual_data` ON staff_data.staffId = staffqual_data.staffId WHERE staff_data.staffId = ? ");
        $st->bind_param("i", $id);
      }
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Update Staff
    public function iUpdateStaff($staffName, $staffImage, $staffCat, $staffProgram, $id)
    {
      if ($partImage == "") {
        $st = $this->conn->prepare("UPDATE `staff_data` SET `staffName`= ?, `staffCat`= ?,`staffAssign`= ? WHERE `staffId` = ?");
        $st->bind_param("sssi", $staffName, $staffCat, $staffProgram, $id);
      } else {
        $st= $this->conn->prepare("UPDATE `staff_data` SET `staffName`= ?,`staffImage`= ?,`staffCat`= ?,`staffAssign`= ? WHERE `staffId` = ?");
        $st->bind_param("ssssi", $staffName, $staffImage, $staffCat, $staffProgram, $id);
      }
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Update Staff Qualifications
    public function iUpdateStaffQual($staffQual, $staffId)
    {
      $st = $this->conn->prepare("UPDATE `staffqual_data` SET `staffQual`= ? WHERE `staffId` = ?");
      $st->bind_param("si", $staffQual, $staffId);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Delete Staff
    public function iDeleteStaff($id)
    {
      $st = $this->conn->prepare("DELETE FROM `staff_data` WHERE `staffId` = ? ");
      $st->bind_param("i", $id);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Delete staff qualifation
    public function iDeleteStaffQual($id)
    {
      $st = $this->conn->prepare("DELETE FROM `staffqual_data` WHERE `staffId` = ? ");
      $st->bind_param("i", $id);
      if ($st->execute()) {
        return true;
      }
      $st->close();
      $this->conn->close();
    }
    // Assets data
    public function iShowAssets($action)
    {
      $st = "";
      if ($action == "copy") {
        $st = $this->conn->prepare("SELECT `copyright` FROM `asset_data`");
      } elseif ($action == "terms") {
        $st = $this->conn->prepare("SELECT `termsConditions` FROM `asset_data`");
      } elseif ($action == "usage") {
        $st = $this->conn->prepare("SELECT `usagePolicy` FROM `asset_data`");
      } elseif ($action == "dis") {
        $st = $this->conn->prepare("SELECT `disclaimer` FROM `asset_data`");
      }
      if ($st->execute()) {
        $r = $st->get_result();
        $f = $r->fetch_array();
        $r = $f[0];
        $st->close();
        $this->conn->close();
        return $r;
      }
    }
    //
    // Event
    //
    // Add event
    public function iAddEvent($eventTitle, $eventDate, $eventPlace, $eventDesc, $imgName, $eventPost)
    {
      $st = $this->conn->prepare("INSERT INTO `events_data`(`eventDate`, `eventTitle`, `eventWhere`, `eventDesc`, `eventImage`, `eventPost`) VALUES (? ,? ,? ,? ,? ,?)");
      $st->bind_param("ssssss", $eventDate, $eventTitle, $eventPlace, $eventDesc, $imgName, $eventPost);
      if($st) {
        if ($st->execute()) {
          $st->close();
          $this->conn->close();
          return true;
        }
      }
    }
    // Update event
    public function iUpdateEvent($editDate, $editTitle, $editPlace, $editDesc, $imgName, $eventId)
    {
      if ($imgName == "") {
        $st = $this->conn->prepare("UPDATE `events_data` SET `eventDate`= ?, `eventTitle`= ?, `eventWhere`= ?, `eventDesc`= ? WHERE `eventId` = ? ");
        if ($st->bind_param("ssssi", $editDate, $editTitle, $editPlace, $editDesc, $eventId)) {
          if ($st) {
            if ($st->execute()) {
              return true;
            }
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT `eventImage` FROM `events_data` WHERE `eventId` = ?");
        $st->bind_param("i", $eventId);
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            $f = $r->fetch_array();
            $r = $f[0];
            if ($r !== "") {
              if (unlink("../../../upload/gallery/$r")) {
                $st = $this->conn->prepare("UPDATE `events_data` SET `eventDate`= ? , `eventTitle`= ?, `eventWhere`= ?, `eventDesc`= ?, `eventImage`= ?  WHERE `eventId` = ? ");
                if($st->bind_param("sssssi", $editDate, $editTitle, $editPlace, $editDesc, $imgName, $eventId)) {
                  if($st) {
                    if ($st->execute()) {
                      return true;
                    }
                  }
                }
              }
            }
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Delete event
    public function iDeleteEvent($id)
    {
      $st = $this->conn->prepare("SELECT `eventImage` FROM `events_data` WHERE `eventId` = ?");
      $st->bind_param("i", $id);
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
          if ($r !== "") {
            if (unlink("../../../upload/gallery/$r")) {
              $st = $this->conn->prepare("DELETE FROM `events_data` WHERE `eventId` = ? ");
              if ($st->bind_param("i", $id)) {
                if ($st) {
                  if ($st->execute()) {
                    $st->close();
                    $this->conn->close();
                    return true;
                  }
                }
              }
            }
          }
        }
      }
    }
    //
    // News
    //
    // Add event
    public function iAddNews($eventTitle, $eventDate, $eventDesc, $imgName, $eventPost)
    {
      $st = $this->conn->prepare("INSERT INTO `news_data`(`newsDate`, `newsTitle`, `newsDesc`, `newsImage`, `newsPost`) VALUES (? ,? ,? ,? ,? )");
      $st->bind_param("sssss", $eventDate, $eventTitle, $eventDesc, $imgName, $eventPost);
      if($st) {
        if ($st->execute()) {
          $st->close();
          $this->conn->close();
          return true;
        }
      }
    }
    // Update event
    public function iUpdateNews($editDate, $editTitle, $editDesc, $imgName, $eventId)
    {
      if ($imgName == "") {
        $st = $this->conn->prepare("UPDATE `news_data` SET `newsDate`= ?, `newsTitle`= ?, `newsDesc`= ? WHERE `newsId` = ? ");
        if ($st->bind_param("sssi", $editDate, $editTitle, $editDesc, $eventId)) {
          if ($st) {
            if ($st->execute()) {
              return true;
            }
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT `newsImage` FROM `news_data` WHERE `newsId` = ?");
        $st->bind_param("i", $eventId);
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            $f = $r->fetch_array();
            $r = $f[0];
            if ($r !== "") {
              if (unlink("../../../upload/gallery/$r")) {
                $st = $this->conn->prepare("UPDATE `news_data` SET `newsDate`= ? , `newsTitle`= ?, `newsDesc`= ?, `newsImage`= ?  WHERE `newsId` = ? ");
                if($st->bind_param("ssssi", $editDate, $editTitle, $editDesc, $imgName, $eventId)) {
                  if($st) {
                    if ($st->execute()) {
                      return true;
                    }
                  }
                }
              }
            }
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Delete event
    public function iDeleteNews($id)
    {
      $st = $this->conn->prepare("SELECT `newsImage` FROM `news_data` WHERE `newsId` = ?");
      $st->bind_param("i", $id);
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
          if ($r !== "") {
            if (unlink("../../../upload/gallery/$r")) {
              $st = $this->conn->prepare("DELETE FROM `news_data` WHERE `newsId` = ? ");
              if ($st->bind_param("i", $id)) {
                if ($st) {
                  if ($st->execute()) {
                    $st->close();
                    $this->conn->close();
                    return true;
                  }
                }
              }
            }
          }
        }
      }
    }
    //
    // Organization
    //
    // Add organization
    public function iAddOrg($orgName, $orgDesc, $imgName, $orgCat)
    {
      $st = $this->conn->prepare("INSERT INTO `studentact_data` (`activityName`, `activityDesc`, `activityImage`, `activityCat`)  VALUES (?, ?, ?, ?)");
      $st->bind_param("ssss", $orgName, $orgDesc, $imgName, $orgCat);
      if($st) {
        if($st->execute()) {
          $st->close();
          $this->conn->close();
          return true;
        }
      }
    }
    // Update Organization
    public function iUpdateOrg($editName, $editDesc, $imgName, $editOrg, $editId)
    {
      if ($imgName == "") {
        $st = $this->conn->prepare("UPDATE `studentact_data` SET `activityName`= ?, `activityDesc`= ?, `activityCat`= ? WHERE `activityId` = ? ");
        if($st->bind_param("sssi", $editName, $editDesc, $editOrg, $editId)) {
          if ($st) {
            if ($st->execute()) {
              return true;
            }
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT `activityImage` FROM `studentact_data` WHERE `activityId` = ?");
        $st->bind_param("i", $editId);
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            $f = $r->fetch_array();
            $r = $f[0];
            if ($r !== "") {
              if (unlink("../../../upload/gallery/$r")) {
                $st = $this->conn->prepare("UPDATE `studentact_data` SET `activityName`= ?, `activityDesc`= ?, `activityImage`= ?, `activityCat`= ? WHERE `activityId` = ? ");
                if($st->bind_param("ssssi", $editName, $editDesc, $imgName, $editOrg, $editId)) {
                  if ($st) {
                    if ($st->execute()) {
                      $st->close();
                      $this->conn->close();
                      return true;
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    // Delete event
    public function iDeleteOrg($id)
    {
      $st = $this->conn->prepare("SELECT `activityImage` FROM `studentact_data` WHERE `activityId` = ?");
      $st->bind_param("i", $id);
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
          if ($r !== "") {
            if (unlink("../../../upload/gallery/$r")) {
              $st = $this->conn->prepare("DELETE FROM `studentact_data` WHERE `activityId` = ? ");
              if ($st->bind_param("i", $id)) {
                if ($st) {
                  if ($st->execute()) {
                    $st->close();
                    $this->conn->close();
                    return true;
                  }
                }
              }
            }
          }
        }
      }
    }
    //
    // Acedemic year
    //
    // Get AY
    public function iGetAY()
    {
      $st = $this->conn->prepare("SELECT * FROM `cur_data`");
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          if ($r) {
            return $r;
          }
        }
      }
      $st->close();
      $this->conn->close();
    }
    // Get message data
    public function getMessageData()
    {
      $st = $this->conn->prepare("SELECT `messagePos`, `messageName`, `messageDesc`, `messageImage` FROM `message_data`");
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get school data
    public function getSchoolData($col)
    {
      if ($col == "history") {
        $st = $this->conn->prepare("SELECT `history` FROM `school_data`");
      } elseif ($col == "philosophy") {
        $st = $this->conn->prepare("SELECT `philosophy` FROM `school_data`");
      } elseif ($col == "mission") {
        $st = $this->conn->prepare("SELECT `mission` FROM `school_data`");
      } else {
        $st = $this->conn->prepare("SELECT `vision` FROM `school_data`");
      }
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get program name
    public function iGetProgramName($programId)
    {
      $st = $this->conn->prepare("SELECT `programTitle` FROM `program_data` WHERE `programId` = ? ");
      $st->bind_param("i", $pId);
      if($st->execute()) {
        $r = $st->get_result();
        $f =  $r->fetch_array();
        $name = $f[0];
      } else {
        $name = 0;
      }
      $st->close();
      $this->conn->close();
      return $name;
    }
    // Get all program
    public function iGetAllProgram($action, $dept, $title)
    {
      if($action == "name") {
        $st = $this->conn->prepare("SELECT program_data.programId, `programTitle`, `programName`, `programDesc`, `programImage`, `deptTitle` FROM `program_data`
        INNER JOIN `deptjunc_data` ON program_data.programId = deptjunc_data.programId INNER JOIN `dept_data` ON deptjunc_data.deptId = dept_data.deptId  WHERE `deptTitle` = ? ");
        $st->bind_param("s", $dept);
      } elseif ($action == "one") {
        $st = $this->conn->prepare("SELECT program_data.programId, `programTitle`, `programName`, `programDesc`, `programImage`, `deptTitle` FROM `program_data`
        INNER JOIN `deptjunc_data` ON program_data.programId = deptjunc_data.programId INNER JOIN `dept_data` ON deptjunc_data.deptId = dept_data.deptId WHERE `programTitle` = ? ");
        $st->bind_param("s", $title);
      } else {
        $st = $this->conn->prepare("SELECT program_data.programId, `programTitle`, `programName`, `programDesc`, `programImage`, `deptTitle` FROM `program_data`
        INNER JOIN `deptjunc_data` ON program_data.programId = deptjunc_data.programId INNER JOIN `dept_data` ON deptjunc_data.deptId = dept_data.deptId");
      }
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get organization names
    public function iGetOrgName($orgId) {
      $st = $this->conn->prepare("SELECT `orgTitle` FROM `studentorg_data` WHERE `orgId` = ? ");
      $st->bind_param("i", $oId);
      if($st->execute()) {
        $r = $st->get_result();
        $f = $r->fetch_array();
        $name = $f[0];
      }
      $st->close();
      $this->conn->close();
      return $name;
    }
    // Show requirements data
    public function iShowRequirements($col)
    {
      $cData = new process();
      $dCol = $cData->iAvoidInject($col);
      $st = $this->conn->prepare("SELECT $dCol FROM `requirements_data`");
      if($st->execute()) {
        $r = $st->get_result();
        $f = $r->fetch_array();
        $r = stripslashes($f[0]);
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Populate nav for events
    public function iShowNavEvents()
    {
      $v = "";
      $st = $this->conn->prepare("SELECT `eventId`, `eventTitle` FROM `events_data` ORDER BY `eventDate` DESC");
      if($st->execute()) {
        $r = $st->get_result();
        while ($f = $r->fetch_array()) {
          $v .= '<li><a href="#" class="navEvents" id="navEvents'.stripslashes($f["eventId"]).'">'.stripslashes($f["eventTitle"]).'</a></li>';
        }
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $v;
    }
    // Populate nav for news
    public function iShowNavNews()
    {
      $v = "";
      $st = $this->conn->prepare("SELECT `newsId`, `newsTitle` FROM `news_data` ORDER BY `newsDate` DESC");
      if($st->execute()) {
        $r = $st->get_result();
        while ($f = $r->fetch_array()) {
          $v .= '<li><a href="#" class="navNews" id="navNews'.stripslashes($f["newsId"]).'">'.stripslashes($f["newsTitle"]).'</a></li>';
        }
      } else {
        $v = 0;
      }
      $st->close();
      $this->conn->close();
      return $v;
    }
    // Show faculty  data
    public function iShowFaculty($program)
    {
      $cData  = new process();
      $dProgram = $cData->iAvoidInject($program);
      $st = $this->conn->prepare("SELECT faculty_data.facultyId, `firstName`, `middleName`, `lastName`, `Image`, `posName`, `deptTitle`, `qualDesc` FROM `faculty_data`
      INNER JOIN `facultyjunc_data` ON facultyjunc_data.facultyId = faculty_data.facultyId
      INNER JOIN `dept_data`        ON dept_data.deptId           = facultyjunc_data.deptId
      INNER JOIN `category_data`    ON category_data.catId        = facultyjunc_data.catId
      INNER JOIN `facpos_data`      ON facpos_data.posId          = facultyjunc_data.posId
      INNER JOIN `qual_data`        ON qual_data.qualId           = facultyjunc_data.qualId
      WHERE `catName` = ? ORDER BY `lastName` ASC");
      if ($st->bind_param("s", $dProgram)) {
        if ($st) {
          if ($st->execute()) {
            $r = $st->get_result();
            $st->close();
            $this->conn->close();
          }
        }
      }
      return $r;
    }
    // Get faculty  data
    public function iGetFacultyInfo($id)
    {
      $cData  = new process();
      $dId = $cData->iAvoidInject($id);
      $st = $this->conn->prepare("SELECT faculty_data.facultyId, `firstName`, `middleName`, `lastName`, `Image`, `posName`, `deptTitle`, `qualDesc` FROM `faculty_data`
      INNER JOIN `facultyjunc_data` ON facultyjunc_data.facultyId = faculty_data.facultyId
      INNER JOIN `dept_data`        ON dept_data.deptId           = facultyjunc_data.deptId
      INNER JOIN `category_data`    ON category_data.catId        = facultyjunc_data.catId
      INNER JOIN `facpos_data`      ON facpos_data.posId          = facultyjunc_data.posId
      INNER JOIN `qual_data`        ON qual_data.qualId           = facultyjunc_data.qualId WHERE faculty_data.facultyId = ? ");
      if ($st->bind_param("i", $dId)) {
        if ($st) {
          if($st->execute()) {
            $r = $st->get_result();
            $st->close();
            $this->conn->close();
          }
        }
      }
      return $r;
    }
    // Get student activties  data
    public function iGetStudentActivity($cat)
    {
      $st = $this->conn->prepare("SELECT `activityId`, `activityName`, `activityDesc`, `activityImage`, `activityCat` FROM `studentact_data` WHERE `activityCat` = ? ");
      $st->bind_param("s", $cat);
      if($st) {
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Show images  data
    public function iGetImages($program)
    {
      $cData  = new process();
      $pName = $cData->iAvoidInject($program);
      $st = $this->conn->prepare("SELECT `galleryId`, `galleryName`, `galleryDesc`, `galleryImage` FROM `programgallery_data` WHERE `galleryProgram` = ? ");
      $st->bind_param("s", $pName);
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Show images  data
    public function iGetSchoolImages()
    {
      $st = $this->conn->prepare("SELECT `galleryId`, `galleryName`, `galleryDesc`, `galleryImage` FROM `gallery_data`");
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get all Events or news
    public function iGetNewsEvents($action)
    {
      if($action == "news") {
        $st = $this->conn->prepare("SELECT `newsId`, `newsDate`, `newsTitle`,`newsDesc`, `newsImage` FROM `news_data` ORDER BY `newsDate` DESC");
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      } else {
        $st = $this->conn->prepare("SELECT `eventId`, `eventDate`, `eventTitle`, `eventWhere`, `eventDesc`, `eventImage` FROM `events_data` ORDER BY `eventDate` DESC");
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get one events or news
    public function iGetNewsEventsOne($id, $action)
    {
      $cData  = new process();
      $dId = $cData->iAvoidInject($id);
      if($action == "news") {
        $st = $this->conn->prepare("SELECT `newsId`, `newsDate`, `newsTitle`,`newsDesc` FROM `news_data` WHERE `newsId` = ? ");
        $st->bind_param("i", $dId);
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      } elseif($action == "events") {
        $st = $this->conn->prepare("SELECT `eventId`, `eventDate`, `eventTitle`,`eventDesc` FROM `events_data` WHERE `eventId` = ? ");
        $st->bind_param("i", $dId);
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      } else {
        $st = $this->conn->prepare("SELECT `galleryId`, `galleryName`, `galleryDesc` FROM `gallery_data` WHERE `galleryId` = '$dId'");
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
  }
?>
