	<?php
		if (!isset($_SESSION['userId'])) {
			if(print('<script>window.location.href="../../../admin/index.php"</script>')) {
				$msgClass = "danger";
      	$msg = "Access denied.";
			}
		}
	?>
  <meta charset="utf-8">
  <meta name="viewport" content = "width = device-width, initial-scale=1">
  <title>Don Jose</title>
  <link type="image" rel="icon" href="../../../upload/images/icon.png">
