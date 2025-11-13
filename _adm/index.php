<?
    // HTTPS SET
    if($_SERVER['SERVER_PORT']!='443'||$_SERVER['HTTPS']!='on'){
        echo "<meta http-equiv='refresh' content='0 url=https://yeriel.co.kr/_adm/login.php' />";
    }else{
        echo "<meta http-equiv='refresh' content='0 url=http://yeriel.co.kr/_adm/login.php' />";
    }
?>