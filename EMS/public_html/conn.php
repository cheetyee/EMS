<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $server = "localhost";
        $databaseName = "id19984907_ems";
        $userName = "id19984907_root";
        $password = "HQ?z<(84D)ZYWn(L";
        
        $conn = mysqli_connect($server,$userName,$password,"$databaseName");
        if( !$conn ){
            die( 'Unable to connect' );
        }  
        
        /*if(!$db_found){
            die('Could not Connect My Sql:' .mysql_error());
        }*/
        ?>
    </body>
</html>
