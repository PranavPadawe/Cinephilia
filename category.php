<?php
 require_once("includes/header.php");

 if(!isset($_GET["id"]))
 {
   ErrorMessage::show("NO id Passed to page");
 }
 $preview = new PreviewProvider($con, $userLoggedIn);
 echo $preview->createCategoryPreviewVideo($_GET["id"]);

 $preview = new CategoryContainers($con, $userLoggedIn);
 echo $preview->showCategory($_GET["id"]);
?>
