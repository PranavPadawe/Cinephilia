<?php
require_once("includes/header.php");

if(!isset($_GET["id"]))
{
  ErrorMessage::show("No id passed into page");  //after exit remaining code wont bt executed
}
$entityId = $_GET["id"];
$entity = new Entity($con, $entityId);
$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createPreviewVideo($entity);

$seasonProvider = new SeasonProvider($con ,$userLoggedIn);
echo $seasonProvider->create($entity);

$categoryContainer = new CategoryContainers($con ,$userLoggedIn);
echo $categoryContainer->showCategory($entity->getCategoryId(), "You might also like");


?>
