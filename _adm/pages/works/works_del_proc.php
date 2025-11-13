<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

    $id = $_GET['id'];
    if(!$id)    msg_exit('ID is not exist!!');

    $my->conn();

    // img information
    $get = $my->get("SELECT * FROM works WHERE uid='{$id}'");

    $gbs = array('thumb_l','thumb_s','works');
    foreach($gbs AS $gb){
        $dir        =   '/asset/upload/works/';
        $file_url   =   $_SERVER['DOCUMENT_ROOT'].$dir.$get[$gb];
        $file_url   =   str_replace('//','/',$file_url);

        // file unlink
        @unlink($file_url);        
    }

    // del db
    $my->qry("DELETE FROM works WHERE uid='{$id}'");
    
    $my->stop();

    go('index.php');
?>