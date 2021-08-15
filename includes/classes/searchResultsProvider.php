<?php
class searchResultsProvider{
    private $con, $username;
    public function __construct($con, $username){
        $this->con = $con;
        $this->uername = $username;
    }
    public function getResult($inputText){
      $entities = EntityProvider::getSearchEntities($this->con, $inputText);
      $html = "<div class='previewCategories noScroll'>";
      $html .= $this->getResultHtml($entities);
      return $html."</div>";
    }

    private function getResultHtml($entities){
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
        <div class='entities'>
          $entitiesHtml
        </div>
      </div>";
   }
  }

 ?>
