<?php
  // Application path
  define("path", "../../pages/");
  // Class initialize contents
  class initContents
  {
    private $path = path;
    // Get Title
    public function getTitle() {
      include_once $this->path.'index/title.php';
    }
    // Get Styles
    public function getStyle() {
      include_once $this->path.'static/style.php';
    }
    // Get Header
    public function getHeader() {
      include_once $this->path.'index/header.php';
    }
    // Get Navigation
    public function getNavigation() {
      include_once $this->path.'index/navigation.php';
    }
    // Get Loading
    public function getLoad() {
      include_once $this->path.'index/load.php';
    }
    // Get Header
    public function getFooter() {
      include_once $this->path.'index/footer.php';
    }
    // Get Script
    public function getScript() {
      include_once $this->path.'static/script.php';
    }
    // Get About Content
    public function getAboutContent() {
      include_once $this->path.'about/message.php';
      include_once $this->path.'about/missionVision.php';
      include_once $this->path.'about/history.php';
      include_once $this->path.'about/philosophy.php';
    }
    // Get Academics Content
    public function getAcademicsContent() {
      include_once $this->path.'academics/program.php';
    }
    // Get Academics Content
    public function getAdmissionContent() {
      include_once $this->path.'admission/requirements.php';
    }
    // Get Faculty and Staff Content
    public function getFacultyStaffContent() {
      include_once $this->path.'facultyStaff/facultyStaffPart.php';
    }
    // Get Faculty and Staff Content
    public function getStudentLifeContent() {
      include_once $this->path.'studentLife/studentActivities.php';
    }
    // Get News and Events Content
    public function getNewsEventsContent() {
      include_once $this->path.'newsEvents/news.php';
      include_once $this->path.'newsEvents/events.php';
    }
  }
?>
