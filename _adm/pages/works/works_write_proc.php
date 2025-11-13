<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

    if($_FILES){
        // file check
        foreach($_FILES AS $f=>$v){
            if($_FILES[$f]) $files[$f]  =   file_check($_FILES[$f],5,'JPG,JPEG,PNG,GIF,jpg,jpeg,png,gif');  // file check
        }
    }

    // make insert data
    $data['title']      =   trim(addslashes(strip_tags($_POST['title'])));
    $data['position']   =   trim(addslashes(strip_tags($_POST['position'])));
    $data['i_stamp']    =   time();

    $my->conn();
    
    $my->insert_array('works',$data);

    if($_FILES){
        $id = $my->get("SELECT uid FROM works ORDER BY uid DESC LIMIT 1");
    
        // make file data (update)
        $dir    =   '/_static/asset/upload/works/';
        foreach($files AS $gb=>$v){
            $upfile_name    =   $gb.'_'.$id['uid'].'_'.time().'.'.$v['exec'];
            
            // file_upload($tbn,$file,$dir,$upfile_name)
            $file[$gb]  =   file_upload('works',$_FILES[$gb],$dir,$upfile_name);
    
            $updata[$gb]   =   $file[$gb]['save'];
        }
        $where['uid']   =   $id['uid'];
    
        $my->update_array('works',$updata,$where);
    }

    $my->stop();

    go('index.php');
?>