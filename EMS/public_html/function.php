<?php

    define('DBINFO', 'mysql:host=localhost;dbname=id19984907_ems');
    define('DBUSER','id19984907_root');
    define('DBPASS','HQ?z<(84D)ZYWn(L');

    function fetchAll($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->query($query);
        return $stmt->fetchAll();
    }
    function performQuery($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

?>