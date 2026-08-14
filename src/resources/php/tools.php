<?php

    function sanitize($conn, $var){
        $var = strip_tags($var);
        $var = htmlentities($var);

        return $conn->real_escape_string($var);
    }

?>