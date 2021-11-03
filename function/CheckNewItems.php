<?php
// ajout du 100221
class CheckMovementItems
{

     public function checkMove()
     {
          $newsItems = $this->selectNew();
          foreach ($newsItems as $item) {
               // inscrit ds new_article à 0
               // var_dump($item);
               $this->registerInNewArticle($item);
               // bascule en 0 dans les deux bases
               // $this->setIdSynchro($item['IDART'], 0);
               // rechek ID_name
          }
          $deletedItems = $this->selectDeleted();
          // var_dump($deletedItems);
          foreach ($deletedItems as $item) {
               // delete ds new_article à 0
               // var_dump($item);
               $this->deleteInNewArticle($item);
          }
     }

     private function selectDeleted()
     {
          $sql = "SELECT * FROM new_article  WHERE IDART
          NOT IN (SELECT IDART FROM web_article) ";
          $con = Db::PDO_T();
          $stmt = $con->query($sql);
          return $stmt->fetchAll();
     }

     public function selectNew()
     {
          $sql = "SELECT * FROM web_article WHERE IDART
          NOT IN (SELECT IDART FROM new_article) ";
          $con = Db::PDO_T();
          $stmt = $con->query($sql);
          return $stmt->fetchAll();
     }

     private function registerInNewArticle($item)
     {
          $idArt = $item['IDART'];
          $designation = $item['DESIGNATION'];
          $idSynchro = $item['id_synchro'];
          $sql = "INSERT INTO new_article 
           (IDART, DESIGNATION, ID_SYNCHRO) 
           VALUE( :idart, :designation , :idSynchro )";
          $con = Db::PDO_T();
          $sth = $con->prepare($sql);
          $sth->execute(['idart' => $idArt, 'designation' => $designation, 'idSynchro' => $idSynchro]);

     }

     private function deleteInNewArticle($item)
     {
          $idArt = $item['IDART'];
          $sql = "DELETE FROM new_article 
          WHERE IDART = $idArt";
          $con = Db::PDO_T();
          $con->exec($sql);
     }

     private function setIdSynchro($id_art, $state)
     {
          $con = Db::PDO_T();
          $update_synchro = "UPDATE WEB_ARTICLE SET id_synchro = $state WHERE IDART = $id_art ";
          $con->query($update_synchro);
     }
}
