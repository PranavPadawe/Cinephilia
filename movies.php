<?php
 require_once("includes/header.php");
 $preview = new PreviewProvider($con, $userLoggedIn);
 echo $preview->createMoviesPreviewVideo();

 $preview = new CategoryContainers($con, $userLoggedIn);
 echo $preview->showMoviesCateogry();
?>
