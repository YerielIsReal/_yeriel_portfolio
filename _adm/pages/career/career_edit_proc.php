<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

    $id = $_GET['id'];

    if(!$id)                                msg_exit('ID is not exist!!');
    if(!$_POST['company'])                  msg_exit('회사명을 입력하세요.');
    if(!$_POST['date_s'])                   msg_exit('시작 날짜를 입력하세요.');
    if($_POST['date_s']>$_POST['date_e'])   msg_exit('시작 날짜가 종료 날짜보다 미래입니다.');

    $data['gb']         =   $_POST['gb'];
    $data['company']    =   text_process($_POST['company']);
    $data['position']   =   text_process($_POST['position']);
    $data['date_s']     =   $_POST['date_s'];
    $data['date_e']     =   $_POST['date_e'];    
    $data['conts']      =   text_process($_POST['conts']);
    $where['uid']       =   $id;

    $my->conn();
    $my->update_array('career',$data,$where);
    $my->stop();

    go('index.php');
?>