<?
    $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
    if($language=='ko'){
        echo "<meta http-equiv='Refresh' content='0; URL=/kr/'>";
    }else{
        echo "<meta http-equiv='Refresh' content='0; URL=/en/'>";
    }
?>