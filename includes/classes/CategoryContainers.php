<?php
class CategoryContainers{
  private $con, $username;
  public function __construct($con, $username)
  {
    $this->con = $con;
    $this->username = $username;
   }
   public function showAllCateogry(){
     $query = $this->con->prepare("SELECT * FROM categories");
     $query->execute();
     $html = "<div class='previewCategories'>";
     while($row = $query->fetch(PDO::FETCH_ASSOC)){
       $html .= $this->getCategoryHtml($row, null, true, true);
     }
     return $html . "</div>";
   }

   public function showTvShowCateogry(){
     $query = $this->con->prepare("SELECT * FROM categories");
     $query->execute();
     $html = "<div class='previewCategories'>
              <h1>Tv Shows</h1>";
     while($row = $query->fetch(PDO::FETCH_ASSOC)){
       $html .= $this->getCategoryHtml($row, null, true, false);
     }
     return $html . "</div>";
   }

   public function showMoviesCateogry(){
     $query = $this->con->prepare("SELECT * FROM categories");
     $query->execute();
     $html = "<div class='previewCategories'>
              <h1>Movies</h1>";
     while($row = $query->fetch(PDO::FETCH_ASSOC)){
       $html .= $this->getCategoryHtml($row, null, false, true);
     }
     return $html . "</div>";
   }


   public function showCategory($categoryId, $title = null){      //if not passed title as paramter title will be null by default
     $query = $this->con->prepare("SELECT * FROM categories WHERE id=:id");
     $query->bindValue(":id",$categoryId);
     $query->execute();
     $html = "<div class='previewCategories noScroll'>";
     while($row = $query->fetch(PDO::FETCH_ASSOC)){
       $html .= $this->getCategoryHtml($row, $title, true, true);
     }
     return $html . "</div>";
   }

   private function getCategoryHtml($sqlData, $title, $tvShows, $movies){
      $CategoryId = $sqlData["id"];
      $title = $title == null ? $sqlData["name"] : $title;
      if($tvShows && $movies)
      {
          $entities = EntityProvider::getEntities($this->con ,$CategoryId, 30);
      }
      else if($tvShows)
      {
        $entities = EntityProvider::getTvShowEntities($this->con ,$CategoryId, 30);
      }
      else {
        $entities = EntityProvider::getMoviesEntities($this->con ,$CategoryId, 30);
      }
      if(sizeof($entities) == 0)
      {
        return;
      }
      $entitiesHtml = "";
      $prevProvider = new PreviewProvider($this->con, $this->username);
      foreach($entities as $entity)
      {
        $entitiesHtml .= $prevProvider->createEntityPreviewSquare($entity);
      }
      return "<div class='category'>
        <a href='category.php?id=$CategoryId'>
          <h3>$title</h3>
        </a>
        <div class='entities'>
          $entitiesHtml
        </div>
      </div>";
   }
 }
 ?>
