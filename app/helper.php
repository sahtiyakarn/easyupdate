<?php

if (!function_exists("showmydata")) {
    function showmydata($data = null)
    {
        echo "<pre>";
        print_r($data ? $data : "fine the route");
        echo "</pre>";
        die;
    }
}
