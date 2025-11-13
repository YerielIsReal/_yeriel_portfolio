<?
    include_once $_SERVER['DOCUMENT_ROOT'].'/_yeriel/inc/yeriel.php';

    $my->conn();
    
    // truncate DB
    $my->qry("TRUNCATE TABLE about");
    $my->qry("TRUNCATE TABLE about_lan");
    $my->qry("TRUNCATE TABLE about_cer");
    $my->qry("TRUNCATE TABLE about_edu");

    // about
	$about['name_kr']   =   trim(strip_tags($_POST['name_kr']));
	$about['name_en']   =   trim(strip_tags($_POST['name_en']));
	$about['birth']     =   trim(strip_tags($_POST['birth']));
	$about['contact']   =   trim(strip_tags($_POST['contact']));
    $my->insert_array('about',$about);    


    // about_lan
    $lan_n = sizeof($_POST['lan_kr']);
    for($i=0;$i<=$lan_n-1;$i++){
        if(!$_POST['lan_kr'][$i] || !$_POST['lan_en'][$i]) continue;

        $about_lan['lan_kr']    =   trim(strip_tags($_POST['lan_kr'][$i]));
        $about_lan['lan_en']    =   trim(strip_tags($_POST['lan_en'][$i]));
        $my->insert_array('about_lan',$about_lan);
    }

    // about_cer
    $cer_n = sizeof($_POST['cer_date']);
    for($i=0;$i<=$cer_n-1;$i++){
        if(!$_POST['cer_date'][$i] || !$_POST['cer_type_kr'][$i] || !$_POST['cer_type_en'][$i]) continue;

        $about_cer['date']      =   trim(strip_tags($_POST['cer_date'][$i]));
        $about_cer['type_kr']   =   trim(strip_tags($_POST['cer_type_kr'][$i]));
        $about_cer['type_en']   =   trim(strip_tags($_POST['cer_type_en'][$i]));
        $my->insert_array('about_cer',$about_cer);
    }

    // about_edu
    $edu_n = sizeof($_POST['edu_kr']);
    for($i=0;$i<=$edu_n-1;$i++){
        if(!$_POST['edu_kr'][$i] || !$_POST['edu_en'][$i]) continue;

        $about_edu['ins_kr']    =   trim(strip_tags($_POST['edu_kr'][$i]));
        $about_edu['ins_en']    =   trim(strip_tags($_POST['edu_en'][$i]));
        $about_edu['date']      =   trim(strip_tags($_POST['edu_date'][$i]));
        $about_edu['cont_kr']   =   trim(strip_tags($_POST['edu_cont_kr'][$i]));
        $about_edu['cont_en']   =   trim(strip_tags($_POST['edu_cont_en'][$i]));
        $my->insert_array('about_edu',$about_edu);
    }    

    $my->stop();

    reload();
?>