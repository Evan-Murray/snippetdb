<?php
    function dbConnection(){
        $db_hostname = 'us-cdbr-iron-east-01.cleardb.net';
        $db_username = 'b153636fdead3d';
        $db_password = '600a9857';
        $db_database = 'heroku_a4a59466a34f772';
        $db_port = 3306;
        // Create connection
        $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database, $db_port);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
?>
