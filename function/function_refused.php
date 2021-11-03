<?php


function getItemsRefused()
{
  $sql = " SELECT * FROM WEB_ARTICLE WHERE id_synchro != 0 
    AND id_synchro != 1 AND id_synchro != 33 AND stock > 0 AND id_synchro != 65 ORDER BY id_name DESC";
  $con = Db::PDO_T();
  $sth = $con->query($sql);
  return $sth->fetchAll();
}


function getSizeForRefusedProduct($idSize, $idRay, $idSynchro)
{
  if ($idSynchro == 33) {
    return '<strong>Doublon Taille</strong>';
  }
  if ($idRay != 2 && $idSize <= 0) {
    return '<strong>Manque Taille</strong>';
  } else {
    return getNameAttribute(switch_taille($idSize));
  }
}

function getRayonName($idCategory)
{
  if ($idCategory == 57) {
    return '<strong>Manque le Rayon</strong>';
  }
  $con = Db::PDO_P();
  $sql = "SELECT name FROM ps_category_lang WHERE id_category = $idCategory ";
  $res = $con->query($sql);
  $result = $res->fetch();
  return $result['name'];
}

function getFamilleName($idCategory)
{
  if ($idCategory == 57) {
    return '<strong>Manque la Famille</strong>';
  }
  if ($idCategory == 0) {
    return '<strong>Famille inconnue</strong>';
  }
  $con = Db::PDO_P();
  $sql = "SELECT name FROM ps_category_lang WHERE id_category = $idCategory ";
  $res = $con->query($sql);
  $result = $res->fetch();
  return $result['name'];
}


function getNameAttribute($idAttribute)
{
  $con = Db::PDO_P();
  $req_att = "SELECT name FROM ps_attribute_lang WHERE id_attribute = $idAttribute ";
  $req = $con->query($req_att);
  $result = $req->fetch();
  return $result['name'];
}

function getColorBugNamePrice($idSynchro)
{
  if ($idSynchro == 99) {
    return '<strong>Prix différent sur le même nom</strong>';
  }
}
