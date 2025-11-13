<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

    $id =   $_GET['id'];
    $gb =   $_GET['gb'];
    if(!$id||!$gb)    msg_exit('ID/GB is not exist!!');

    $my->conn();

    $img = $my->get("SELECT {$gb} FROM works WHERE uid='{$id}'");

    $dir        =   '/_static/asset/upload/works/';
    $file_url   =   $_SERVER['DOCUMENT_ROOT'].$dir.$img[$gb];
    $file_url   =   str_replace('//','/',$file_url);

    // file unlink
    @unlink($file_url);

    // update db
    $my->qry("UPDATE works SET {$gb}='' WHERE uid='{$id}'");

    $my->stop();

    reload();
?>