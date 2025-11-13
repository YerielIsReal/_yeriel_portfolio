<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

    $id = $_GET['id'];
    if(!$id) msg_exit('This work is not exist!');

    $my->conn();
    $work = $my->get("SELECT works FROM gallery WHERE uid='{$id}'");
    $my->stop();
?>
$('.modal_body img').attr('src','/asset/upload/gallery/<?=$work['works']?>');
$('#modal_works').fadeIn(200);