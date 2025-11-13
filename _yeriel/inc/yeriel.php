<?
    @session_start();

    // db 세팅 불러오기
    include $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/db.php';  

    //
    function echor($array){
        echo "<pre>";
        echo print_r($array);
        echo "</pre>";
    }

    //
    function br(){
        echo "<br />";
    }

    //
	function ex_pop($ex,$gb=':'){
		$ex = explode($gb,$ex);
		if(!trim($ex[sizeof($ex)-1])) array_pop($ex);
		$c=sizeof($ex);
		$tmp='';
		for($i=1;$i<=$c;$i++){
			$tmp .= $ex[$i-1];
			if($i<$c) $tmp.=$gb;
		}
		return $tmp;
	}

    // 문자열 처리
    function text_process($txt){
        $result = nl2br(trim(htmlspecialchars(addslashes($txt))));
        $result = preg_replace('/\r\n|\r|\n/','',$result);
        return $result;
    }

    // 문자열 처리 복구
    function text_unprocess($txt){
        $result = htmlspecialchars_decode(stripslashes($txt));
        return $result;
    }



// ============================= javascript shortcut =================================== //

    //
	function msg($msg,$js=FALSE){
		if($js) echo "<script type='text/javascript'>";
		echo "alert(\"".$msg."\");";
		if($js) echo "</script>";
	}

    //
    function msg_exit($msg,$js=FALSE){
		if($js) echo "<script type='text/javascript'>";
		echo "alert(\"".$msg."\");";
		if($js) echo "</script>";
        exit;
    }

    //
    function msg_url($msg,$url,$js=FALSE){
		if($js) echo "<script type='text/javascript'>";
		echo "alert(\"".$msg."\");";
        echo "document.location.href=\"".$url."\";";
		if($js) echo "</script>"; 
    }

    //
    function msg_focus($msg,$id,$js=FALSE){
		if($js) echo "<script type='text/javascript'>";
		echo "alert(\"".$msg."\");";
        echo "$('#".$id."').focus();";
		if($js) echo "</script>";
        exit;  
    }
    
    //
    function msg_reload($msg,$js=FALSE){
        if($js) echo "<script type='text/javascript'>";
        echo "alert(\"".$msg."\");";
        echo "window.location.reload();";
        if($js) echo "</script>";
        exit;
    }

    //
    function go($url,$js=FALSE){
		if($js) echo "<script type='text/javascript'>";
		echo "document.location.href=\"".$url."\";";
		if($js) echo "</script>";
		exit;
    }

    //
    function focus($id,$js=FALSE){
		if($js) echo "<script type='text/javascript'>";
		echo "$('#".$id."').focus();";
		if($js) echo "</script>";
		exit;
    }

    //
    function reload($js=FALSE){
        if($js) echo "<script type='text/javascript'>";
        echo "window.location.reload();";
        if($js) echo "</script>";
        exit;
    }


// ============================= file upload =================================== //
    function file_check($files,$size='5',$exec_list='yeriel,jpg,jpeg,png,gif',$fknm='이미지'){
        if(!sizeof($files)) $check=0;
        else{
            $exec_ex	=	explode('.',$files['name']);
            $exec		=	strtolower($exec_ex[sizeof($exec_ex)-1]);
            $limit		=	1024*1024*$size;
            $exec_list	=	$exec_list;
            $execs		=	explode(',',$exec_list);
            $fsize		=	$files['size'];

            if($files['error'])					msg_exit('첨부된 '.$fknm.'은(는) 파일오류로 업로드가 불가합니다.');
            if($size>$limit)					msg_exit('첨부된 '.$fknm.'은(는) 제한 용량 초과로 업로드가 불가합니다.\n( '.$size.'MB 이하 )');
            if(!array_search($exec,$execs))	    msg_exit('첨부된 '.$fknm.' 업로드가 불가능한 확장자 입니다.');
            $check=1;
        }

        $result['check']	=	$check;
        $result['name']	    =	$files['name'];
        $result['tmp']		=	$files['tmp_name'];
        $result['size']		=	$files['size'];
        $result['exec']	    =	$exec;
        return $result;
    }

    //
    function file_upload($tbn,$file,$dir,$upfile_name){
		$tmp_file				=	$file['tmp_name'];
		$upload				    =	$_SERVER['DOCUMENT_ROOT'].'/'.$dir.$upfile_name;
		$upload					=	str_replace('//','/',$upload);
        $file['uploaded']		=	@move_uploaded_file($tmp_file,$upload);
        if(!$file['uploaded'])  msg('업로드에 실패하였습니다.');

        $result['name'] =   $file['name'];
        $result['save'] =   $upfile_name;

        return $result;
    }

    //
    function file_upload_array($tbn,$dir,$files){
		foreach($files['name'] AS $k=>$v){
			$j          =   $k+1;
			$tmp		=	$files['tmp'][$k];
			$upname		=	$tbn.'_'.$j.'_'.time().'.'.$files['exec'][$k];
			$upload		=	$_SERVER['DOCUMENT_ROOT'].$dir.$upname;
			$upload		=	str_replace('//','/',$upload);
			$move		=	@move_uploaded_file($tmp,$upload);
			if(!$move)		msg($j.'번째 파일을 업로드에 실패하였습니다.');
			else $uploaded.="{$upname}:{$v}|";
		}
        $uploaded = ex_pop($uploaded,'|');
		return $uploaded;
    }



// ============================= db insert/update =================================== //
    //
	function make_query($table,$data,$where=''){
		if(!$table||!$data){
			echo $table;
			echo $data;
			msg_exit('make_query_error');
		}

		$qry='';
		$w=0;
		$tmp='';

		if($where){

			$t=sizeof($where);
			foreach($where AS $k=>$v){
				$w++;
				$tmp.=" {$k}='{$v}'";
				if($w<$t) $tmp.=" AND ";
			}
			$where=$tmp;
		}

		if($data=='del'||$data=='delete'){
			$qry=$where?"DELETE FROM {$table} WHERE {$where} ;":"DELETE FROM {$table} ;";
			return $qry;
		}

		$t=sizeof($data);
		$c=0;
		foreach($data as $k=>$v){
			$c++;
			$qry.=$k."='".$v."'";
			$qry.=$c!=$t?',':'';
		}

		$qry=$where?"UPDATE {$table} SET {$qry} WHERE {$where} ;":"INSERT INTO {$table} SET {$qry} ";

		return $qry;
	}
    
?>