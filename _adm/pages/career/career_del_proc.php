<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

    $id = $_GET['id'];
    if(!$id) msg_exit('ID is not exist!!');

    $my->conn();
    $my->qry("DELETE FROM career WHERE uid='{$id}'");
    $my->stop();

    go('index.php');
?>