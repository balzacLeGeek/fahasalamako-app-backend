<?php
    namespace App\Services;

    class Header
    {
        static function set()
        {
            header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE,HEAD,OPTIONS');
            header('Access-Control-Allow-origin: *');
            header('Content-Type: application/json; charset=utf-8');
            header('Access-Control-Expose-Header: X-Requested-With,X-jsonblob,X-Hello-Human,Location,Date,Content-Type,Accept,Origin');
            header('Vary: Accept-Encoding');
            header('X-Firefox-Spdy: h2');
        }
    }