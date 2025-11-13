<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';
    
    $id = $_GET['id'];
    if(!$id)    msg_exit('ID is not exist!!');

    if($_FILES){
        // file check
        foreach($_FILES AS $f=>$v){
            if($_FILES[$f]) $files[$f]  =   file_check($_FILES[$f],5);  // file check
        }

        // make file data (update)
        $dir    =   '/_static/asset/upload/gallery/';
        foreach($files AS $gb=>$v){
            $upfile_name    =   $gb.'_'.$id.'_'.time().'.'.$v['exec'];
            
            // file_upload($tbn,$file,$dir,$upfile_name)
            $file[$gb]  =   file_upload('gallery',$_FILES[$gb],$dir,$upfile_name);
    
            $data[$gb]   =   $file[$gb]['save'];
        }        
    }

    // make update data
    $data['title']      =   trim(addslashes(strip_tags($_POST['title'])));
    $data['i_stamp']    =   time();
    $where['uid']       =   $id;

    $my->conn();
    $my->update_array('gallery',$data,$where);
    $my->stop();

    go('index.php')
?>