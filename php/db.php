<?php

	$mysqli = new mysqli('127.0.0.1', 'root', '', 'iocdb');

    if (!$mysqli) {
        echo "Unable to connect to MySQL: ", $mysqli -> connect_error();
    }

?>