<?php
 require_once("includes/header.php");
 $preview = new PreviewProvider($con, $userLoggedIn);
 echo $preview->createTvShowPreviewVideo();

 $preview = new CategoryContainers($con, $userLoggedIn);
 echo $preview->showTvShowCateogry();

?>
