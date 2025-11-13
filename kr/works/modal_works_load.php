<?
  include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

  $id = $_GET['id'];
  if(!$id) msg_exit('This work is not exist!');

  $my->conn();
  $work = $my->get("SELECT works FROM works WHERE uid='{$id}'");
  $my->stop();
?>

const modalImg = document.getElementById("modal_img");
modalImg.src = "/_static/asset/upload/works/<?=$work['works']?>";

