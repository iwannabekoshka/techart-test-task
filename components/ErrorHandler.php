<?php

class ErrorHandler
{
    public static function throwError404()
    {
        $domain = $_SERVER['HTTP_HOST'];
        header("HTTP/1.1 404 Not Found");
        header("Location: http://$domain/not-found");
        exit;
    }
}