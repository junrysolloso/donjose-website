<?php
  // Class initialize contents
  class initContents
  {
    private $path = "../../../admin/pages/";
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
    // Get Header
    public function getFooter() {
      include_once $this->path.'index/footer.php';
    }
    // Get Script
    public function getScript() {
      include_once $this->path.'static/script.php';
    }
  }
?>
