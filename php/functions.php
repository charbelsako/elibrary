<?php
    function escape_email($string) {
        // sanitize variable
        return mysqli_real_escape_string($link, $string);
    }

    function escape_name($string) {
        // sanitize variable
        return mysqli_real_escape_string($link, $string);
    }

?>