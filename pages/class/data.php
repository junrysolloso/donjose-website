<?php
  // Class connection
  include_once 'connect.php';
  // Class for data processing
  class process extends connection
  {
    function __construct()
    {
      $this->connect();
    }
    // Avoid mysql injection
    public function iAvoidInject($data)
    {
      $escape = mysqli_real_escape_string($this->conn, $data);
      $ready = stripcslashes($escape);
      return $ready;
    }
    public function iCheckLettersAll($letters)
    {
      if(preg_match("/^[a-zA-Z 0-9-]*$/", $letters)) {
        return 1;
      }
    }
    // Check letters
    public function iCheckLetters($string)
    {
      if (preg_match("/^[a-zA-Z]*$/", $string)) {
        return true;
      }
    }
    // Check numbers
    public function iCheckNumbers($string)
    {
      if (preg_match("/^[0-9]*$/", $string)) {
        return true;
      }
    }
    // Get news title
    public function iGetNewsName()
    {
      $st = $this->conn->prepare("SELECT `newsId`, `newsTitle`, `newsImage`, `newsDesc` FROM `news_data` ORDER BY `newsDate` DESC");
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      return $r;
      $st->close();
      $this->conn->close();
    }
    // Get activity names
    public function iGetActivityName($cat)
    {
      $cData  = new process();
      $pName = $cData->iAvoidInject($cat);
      $st = $this->conn->prepare("SELECT `activityId`, `activityName` FROM `studentact_data` WHERE `activityCat` = ? ");
      $st->bind_param("s", $pName);
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      return $r;
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
      $cData = new process();
      $dCol  = $cData->iAvoidInject($col);
      $st = $this->conn->prepare("SELECT $dCol FROM `school_data`");
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
    //Get all Department
    public function iGetAllDept()
     {
       $st = $this->conn->prepare("SELECT `deptTitle` FROM `dept_data` WHERE `deptStat` = 1");
       if ($st) {
         if ($st->execute()) {
           $r = $st->get_result();
           return $r;
         }
       }
       $st->close();
       $this->conn->close();
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
    // Get history One
    public function iGetHistoryOne($id)
    {
      $st = $this->conn->prepare("SELECT * FROM `history_data` WHERE `historyId` = ? ");
      $st->bind_param("i", $id);
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get history Year
    public function iGetHistoryYear()
    {
      $st = $this->conn->prepare("SELECT `historyId`, `historyYear` FROM `history_data`");
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
    public function iGetProgramData($programId)
    {
      $st = $this->conn->prepare("SELECT program_data.programId, `programTitle`, `programName`, `programDesc`, `programImage`, `deptTitle` FROM `program_data`
      INNER JOIN `deptjunc_data` ON program_data.programId = deptjunc_data.programId INNER JOIN `dept_data` ON deptjunc_data.deptId = dept_data.deptId  WHERE program_data.programId = ?");
      if ($st->bind_param("s", $programId)) {
        if ($st) {
          if($st->execute()) {
            $r = $st->get_result();
          }
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get all program
    public function iGetAllProgram($dept)
    {
      $st = $this->conn->prepare("SELECT program_data.programId, `programTitle`, `programName`, `programDesc`, `programImage`, `deptTitle` FROM `program_data`
      INNER JOIN `deptjunc_data` ON program_data.programId = deptjunc_data.programId INNER JOIN `dept_data` ON deptjunc_data.deptId = dept_data.deptId  WHERE `deptTitle` = ? ");
      if ($st->bind_param("s", $dept)) {
        if ($st) {
          if($st->execute()) {
            $r = $st->get_result();
          }
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get organization names
    public function iGetOrgName($orgId) {
      $st = $this->conn->prepare("SELECT `orgTitle` FROM `studentorg_data` WHERE `orgId` = '$oId'");
      if($st->execute()) {
        $r = $st->get_result();
        $f = $r->fetch_array();
        $name = $f[0];
      }
      $st->close();
      $this->conn->close();
      return $name;
    }
    // Get student activties  data
   public function iGetStudentActivity($action, $cat)
   {
     if($action == "all") {
       $st = $this->conn->prepare("SELECT `activityId`, `activityName`, `activityDesc`, `activityImage` FROM `studentact_data` WHERE `activityCat` = ?");
       $st->bind_param("s", $cat);
       if ($st) {
         if($st->execute()) {
           $r = $st->get_result();
         } else {
           $r = 0;
         }
       }
     } else {
       $st = $this->conn->prepare("SELECT `activityId`, `activityName`, `activityDesc`, `activityImage` FROM `studentact_data` WHERE `activityId` = ?");
       $st->bind_param("i", $cat);
       if($st->execute()) {
         $r = $st->get_result();
       } else {
         $r = 0;
       }
     }
     return $r;
     $st->close();
     $this->conn->close();
   }
    // Get stting ay
    public function iGetSetting()
    {
      $st = $this->conn->prepare("SELECT `courseAY` FROM `setting_data`");
      if($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
          if ($r !== "") {
            $st->close();
            $this->conn->close();
            return $r;
          }
        }
      }
    }
    // Get AY
    public function iGetAY()
    {
      $st = $this->conn->prepare("SELECT `curYear` FROM `cur_data` ORDER BY `curYear` DESC");
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $st->close();
          $this->conn->close();
          return $r;
        }
      }
    }
    // Show course in table
    public function iShowTable($year, $sem, $pName, $ay)
    {
      $clean = new process();
      $count = new process();
      $lec = $lab = 0;
      $cYear = $clean->iAvoidInject($year);
      $cSem  = $clean->iAvoidInject($sem);
      $pName = $clean->iAvoidInject($pName);
      $aYear = $clean->iAvoidInject($ay);
      if($cSem == 1) {
        $s = "1st Semester";
      } else {
        $s = "2nd Semester";
      }
      $v = '<div class="section-title text-center center">';
			$v .= '<h4>'.$cYear.' - '.$s.'</h4>';
			$v .= '</div>';
	    $v .= '<table class="table table-condensed table-hover table-bordered">';
	    $v .= '<thead class="bg-success">';
			$v .= '<tr>';
	    $v .= '<th width="20%">Code</th>';
	  	$v .= '<th width="60%">Description</th>';
	    $v .= '<th width="10%">Lec</th>';
	    $v .= '<th width="10%">Lab</th>';
			$v .= '</tr>';
	  	$v .= '</thead>';
	    $v .= '<tbody>';
      $st = $this->conn->prepare("SELECT subject_data.subjectId, `subjectCode`, `subjectDesc`, `subjectLab`, `subjectLec`, `curYear` FROM `subject_data`
      INNER JOIN `subjunc_data` ON subject_data.subjectId = subjunc_data.subjectId
      INNER JOIN `year_data`    On year_data.yearId       = subjunc_data.yearId
      INNER JOIN `sem_data`     ON sem_data.semId         = subjunc_data.semId
      INNER JOIN `cur_data`     ON cur_data.curId         = subjunc_data.curId
      INNER JOIN `program_data` ON program_data.programId = subjunc_data.programId
      WHERE `yearName` = ? AND `semName` = ? AND `programTitle` = ? AND `curYear` = ? ");
      $st->bind_param("iiss", $cYear, $cSem, $pName, $aYear);
      if($st->execute()) {
        $r = $st->get_result();
  			while($f = $r->fetch_array()) {
  				$v .= '<tr>';
  				$v .= '<td>'.$f["subjectCode"].'</td>';
  				$v .= '<td>'.$f["subjectDesc"].'</td>';
  				$v .= '<td>'.$f["subjectLec"].'</td>';
  				$v .= '<td>'.$f["subjectLab"].'</td>';
  				$v .= '</tr>';
          $lec += $f["subjectLec"];
          $lab += $f["subjectLab"];
        }
      }
      $v .= '</tbody>';
      $v .= '<tfoot>';
      $v .= '<tr>';
      $v .= '<td colspan="4"><b class="pull-right">Total Units: '.($lec + $lab).'</b>&nbsp;</td>';
      $v .= '</tr>';
      $v .= '</tfoot>';
	    $v .= '</table>';
      return $v;
      $st->close();
      $this->conn->close();
    }
    // Image query
    public function iQueryImage($action)
    {
      if($action == "insertImage") {
        $st = $this->conn->prepare("TRUNCATE TABLE `imagetemp_data`");
        if($st->execute()) {
          $st = $this->conn->prepare("INSERT INTO `imagetemp_data` (`tempImage`, `fromId`, `fromName`, `fromTable`) SELECT `galleryImage`, `galleryId`, `galleryName`, 'gallery_data' FROM `gallery_data` LIMIT 0,5");
          if($st->execute()) {
            $st = $this->conn->prepare("INSERT INTO `imagetemp_data` (`tempImage`, `fromId`, `fromName`, `fromTable`) SELECT `eventImage`, `eventId`, `eventTitle`, 'events_data' FROM `events_data` ORDER BY `eventDate` LIMIT 0,5");
            if($st->execute()) {
              $st = $this->conn->prepare("INSERT INTO `imagetemp_data` (`tempImage`, `fromId`, `fromName`, `fromTable`) SELECT `newsImage`, `newsId`, `newsTitle`, 'news_data' FROM `news_data` ORDER BY `newsDate` LIMIT 0,5");
              if($st->execute()) {
                $r = 1;
              } else {
                $r = 0;
              }
            }
          }
        }
      } elseif($action == "getAll") {
        $st = $this->conn->prepare("SELECT `fromId`, `tempImage`, `fromName`, `fromTable` FROM `imagetemp_data`");
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      } else {
        $st = $this->conn->prepare("SELECT COUNT(tempId) FROM `imagetemp_data`");
        if($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
        } else {
          $r = 0;
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Show scool data
    public function  iShowData($col, $img, $tbl)
    {
      $cData  = new process();
      $dCol = $cData->iAvoidInject($col);
      $dImg = $cData->iAvoidInject($img);
      $dTbl = $cData->iAvoidInject($tbl);
      if($dImg == "") {
        $st = $this->conn->prepare("SELECT $dCol FROM $dTbl");
        if($st->execute()) {
          $r = $st->get_result();
          $f = $r->fetch_array();
          $r = $f[0];
        } else {
          $r = 0;
        }
      } else {
        $r = "";
        $st = $this->conn->prepare("SELECT $dImg, $dCol FROM $dTbl");
        if($st->execute()) {
          $r = $st->get_result();
          while ($f = $r->fetch_array()) {
            $r .= '<img src="../../upload/gallery/'.stripslashes($f[0]).'" width="100%" height="400px"><br><br>';
			      $r .= '<big><p class="justify">'.stripslashes($f[1]).'</p></big>';
          }
        } else {
          $r = 0;
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get gallery data
    public function iGetGalleryData($id)
    {
      $st = $this->conn->prepare("SELECT * FROM `gallery_data` WHERE `galleryId` = ? ");
      $st->bind_param("i", $id);
      if ($st) {
        if ($st->execute()) {
          $r = $st->get_result();
          $st->close();
          $this->conn->close();
          return $r;
        }
      }
    }
    // Count number of enrollees
    public function iCount($col, $tbl)
    {
      $cData = new process();
      $dCol = $cData->iAvoidInject($col);
      $dTbl = $cData->iAvoidInject($tbl);
      $st = $this->conn->prepare("UPDATE `summary_data` INNER JOIN `faculty_data`
      SET `facultySum` = (SELECT COUNT(faculty_data.facultyId) FROM `faculty_data`
      INNER JOIN `facultyjunc_data` ON faculty_data.facultyId = facultyjunc_data.facultyId
      INNER JOIN `category_data` ON category_data.catId = facultyjunc_data.catId WHERE `catName` = 'faculty') WHERE `summaryId` = 1");
      if ($st->execute()) {
        $st = $this->conn->prepare("UPDATE `summary_data` INNER JOIN `faculty_data`
        SET `partSum` = (SELECT COUNT(faculty_data.facultyId) FROM `faculty_data`
        INNER JOIN `facultyjunc_data` ON faculty_data.facultyId = facultyjunc_data.facultyId
        INNER JOIN `category_data` ON category_data.catId = facultyjunc_data.catId WHERE `catName` = 'Part-Time') WHERE `summaryId` = 1");
        if ($st->execute()) {
          $st = $this->conn->prepare("UPDATE `summary_data` INNER JOIN `faculty_data`
          SET `staffSum` = (SELECT COUNT(faculty_data.facultyId) FROM `faculty_data`
          INNER JOIN `facultyjunc_data` ON faculty_data.facultyId = facultyjunc_data.facultyId
          INNER JOIN `category_data` ON category_data.catId = facultyjunc_data.catId WHERE `catName` = 'Staff') WHERE `summaryId` = 1");
          $st->execute();
        }
      }
      $st = $this->conn->prepare("SELECT $dCol FROM $dTbl");
      if($st->execute()) {
        $r = $st->get_result();
        $f = $r->fetch_array();
        $r = $f[0];
      } else {
        $r = 0;
      }
      $st->close();
      $this->conn->close();
      return $r;
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
      return $r;
      $st->close();
      $this->conn->close();
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
      return $v;
      $st->close();
      $this->conn->close();
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
      return $v;
      $st->close();
      $this->conn->close();
    }
    // Show faculty  data
    public function iShowFaculty($program)
    {
      $cData  = new process();
      $dProgram = $cData->iAvoidInject($program);
      if($dProgram == "none") {
        $st = $this->conn->prepare("SELECT faculty_data.facultyId, `firstName`, `middleName`, `lastName`, `Image`, `posName`, `deptTitle`, `qualDesc` FROM `faculty_data`
        INNER JOIN `facultyjunc_data` ON facultyjunc_data.facultyId = faculty_data.facultyId
        INNER JOIN `dept_data`        ON dept_data.deptId           = facultyjunc_data.deptId
        INNER JOIN `category_data`    ON category_data.catId        = facultyjunc_data.catId
        INNER JOIN `facpos_data`      ON facpos_data.posId          = facultyjunc_data.posId
        INNER JOIN `qual_data`        ON qual_data.qualId           = facultyjunc_data.qualId
        ORDER BY `lastName` ASC");
        if ($st) {
          if($st->execute()) {
            $r = $st->get_result();
          }
        }
      } else {
        $st = $this->conn->prepare("SELECT faculty_data.facultyId, `firstName`, `middleName`, `lastName`, `Image`, `posName`, `deptTitle`, `qualDesc` FROM `faculty_data`
        INNER JOIN `facultyjunc_data` ON facultyjunc_data.facultyId = faculty_data.facultyId
        INNER JOIN `dept_data`        ON dept_data.deptId           = facultyjunc_data.deptId
        INNER JOIN `category_data`    ON category_data.catId        = facultyjunc_data.catId
        INNER JOIN `facpos_data`      ON facpos_data.posId          = facultyjunc_data.posId
        INNER JOIN `qual_data`        ON qual_data.qualId           = facultyjunc_data.qualId
        WHERE `deptTitle` = ? ORDER BY `lastName` ASC");
        $st->bind_param("s", $dProgram);
        if ($st) {
          if($st->execute()) {
            $r = $st->get_result();
          }
        }
      }
      return $r;
      $st->close();
      $this->conn->close();
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
    // Show faculty qualifation  data
    public function iShowFacultyQual($id, $action)
    {
      $cData  = new process();
      $dId = $cData->iAvoidInject($id);
      if($action == "faculty") {
        $st = $this->conn->prepare("SELECT `facultyQual` FROM `facultyqual_data` WHERE `facultyId` = '$dId'");
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      } elseif ($action == "staff")  {
        $st = $this->conn->prepare("SELECT `staffQual` FROM `staffqual_data` WHERE `staffId` = '$dId'");
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      } else {
        $st = $this->conn->prepare("SELECT `partQual` FROM `partqual_data` WHERE `partId` = '$dId'");
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      }
      return $r;
      $st->close();
      $this->conn->close();
    }
    // Get all staff  data
    public function iShowAllStaff($id, $action)
    {
      $cData  = new process();
      $dId = $cData->iAvoidInject($id);
      if($action == "one") {
        $st = $this->conn->prepare("SELECT `staffName`, `staffImage` FROM `staff_data` WHERE `staffId` = '$dId'");
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      } else {
        $st = $this->conn->prepare("SELECT `staffId`,`staffName`, `staffAssign` FROM `staff_data` ORDER BY `staffName` ASC");
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      }
      return $r;
      $st->close();
      $this->conn->close();
    }
    // Get all staff  data
    public function iShowAllPartTime()
    {
      $st = $this->conn->prepare("SELECT faculty_data.facultyId, `firstName`, `middleName`, `lastName`, `Image`, `posName`, `deptTitle`, `qualDesc` FROM `faculty_data`
      INNER JOIN `facultyjunc_data` ON facultyjunc_data.facultyId = faculty_data.facultyId
      INNER JOIN `dept_data`        ON dept_data.deptId           = facultyjunc_data.deptId
      INNER JOIN `category_data`    ON category_data.catId        = facultyjunc_data.catId
      INNER JOIN `facpos_data`      ON facpos_data.posId          = facultyjunc_data.posId
      INNER JOIN `qual_data`        ON qual_data.qualId           = facultyjunc_data.qualId
      WHERE `catName` = 'Part-Time' ORDER BY `lastName` ASC");
      if ($st) {
        if($st->execute()) {
          $r = $st->get_result();
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
    // Get events title
    public function iGetEventsName()
    {
      $st = $this->conn->prepare("SELECT `eventId`, `eventTitle`, `eventDesc`, `eventImage` FROM `events_data` ORDER BY `eventDate` DESC");
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      return $r;
      $st->close();
      $this->conn->close();
    }
    // Show images  data
    public function iGetImages($program)
    {
      $cData  = new process();
      $pName = $cData->iAvoidInject($program);
      $st = $this->conn->prepare("SELECT `galleryName`, `galleryDesc`, `galleryImage` FROM `programgallery_data` WHERE `galleryProgram` = ? ");
      $st->bind_param("s", $pName);
      if($st->execute()) {
        $r = $st->get_result();
      } else {
        $r = 0;
      }
      return $r;
      $st->close();
      $this->conn->close();
    }
    // Get all Events or news
    public function iGetNewsEvents($action)
    {
      if($action == "news") {
        $st = $this->conn->prepare("SELECT `newsId`, `newsDate`, `newsTitle`, `newsDesc`, `newsImage` FROM `news_data` ORDER BY `newsDate` DESC");
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
      return $r;
      $st->close();
      $this->conn->close();
    }
    // Get one Events or news
    public function iGetNewsEventsOne($action, $id)
    {
      if($action == "news") {
        $st = $this->conn->prepare("SELECT `newsId`, `newsDate`, `newsTitle`, `newsDesc`, `newsImage` FROM `news_data` WHERE `newsId` = ? ");
        $st->bind_param("i", $id);
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      } else {
        $st = $this->conn->prepare("SELECT `eventId`, `eventDate`, `eventTitle`, `eventWhere`, `eventDesc`, `eventImage` FROM `events_data` WHERE `eventId` = ? ");
        $st->bind_param("i", $id);
        if($st->execute()) {
          $r = $st->get_result();
        } else {
          $r = 0;
        }
      }
      return $r;
      $st->close();
      $this->conn->close();
    }
    // Get program name
    public function iGetProgramOne($dept)
    {
      $st = $this->conn->prepare("SELECT program_data.programId, `programTitle`, `programName`, `programDesc`, `programImage`, `deptTitle` FROM `program_data`
      INNER JOIN `deptjunc_data` ON program_data.programId = deptjunc_data.programId INNER JOIN `dept_data` ON deptjunc_data.deptId = dept_data.deptId  WHERE `deptTitle` = ?");
      if ($st->bind_param("s", $dept)) {
        if ($st) {
          if($st->execute()) {
            $r = $st->get_result();
          }
        }
      }
      $st->close();
      $this->conn->close();
      return $r;
    }
  }
?>
