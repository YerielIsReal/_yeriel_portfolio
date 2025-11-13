<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

    if($_FILES){
        $my->conn();

        // file common
        $file           = file_check($_FILES['profile_img'],5);
        $dir            = '/_static/asset/upload/about/';

        // previous file del
        $get = $my->get("SELECT img FROM about WHERE uid=1");
        if($get['img']){
            $file_before = $_SERVER['DOCUMENT_ROOT'].$dir.$get['img'];
            $file_before = str_replace('//','/',$file_before);
            @unlink($file_before);
        }

        // file_upload
        $upfile_name    = 'about_'.time().'.'.$file['exec'];
        $upfile         = file_upload('about',$_FILES['profile_img'],$dir,$upfile_name);

        
        $my->qry("UPDATE about SET img='{$upfile['save']}' WHERE uid=1");

        $my->stop();
    }

    reload();
?>