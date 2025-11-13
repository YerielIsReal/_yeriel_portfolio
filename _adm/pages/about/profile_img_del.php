<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

    $my->conn();

    // file info / unlink
    $get = $my->get("SELECT img FROM about WHERE uid=1");
    $file_url = $_SERVER['DOCUMENT_ROOT'].'/_static/asset/upload/about/'.$get['img'];
    $file_url = str_replace('//','/',$file_url);
    @unlink($file_url);

    // db update
    $my->qry("UPDATE about SET img='' WHERE uid=1");

    $my->stop();

    reload();
?>