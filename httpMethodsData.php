<?php
namespace library;

class httpMethodsData {
    private static $post;
    private static $get;
    private static $put;
    private static $delete;
    private static $head;
    private static $patch;

    private static $init = false;

    private static $method;
    private static $headers;

    public static function init() {
        self::$method = strtolower($_SERVER['REQUEST_METHOD']);
        if(self::$method != 'post' && self::$method != 'get' && self::$method != 'put' && self::$method != 'delete' && self::$method != 'head' && self::$method != 'patch')
            return false;
        $values = json_decode(file_get_contents("php://input"));
        if($values === null) {
            if(self::$method == 'post')
                $values = (object)$_POST;
            elseif(self::$method == 'get')
                $values = (object)$_GET;
        }

        self::$$method = $values;

        /* Get all headers, example :
            Accept: *
            Accept-Language: en-us
            Accept-Encoding: gzip, deflate
            User-Agent: Mozilla/4.0
            Host: www.example.com
            Connection: Keep-Alive
        */
        self::$headers = getallheaders();
        self::$init = true;
        return true;
    }

    /* Get a value from header */
    public static function getHeader($name) {
        if(!self::$init)
            self::init();
        if(!array_key_exists($name, self::$headers))
            return false;
        return self::$headers[$name];
    }

    /* Get the requested method */
    public static function getMethod() {
        if(!self::$init)
            self::init();
        return self::$method;
    }

    /* Get data sent with post in an object */
    public static function post() {
        if(!self::$init)
            self::init();
        return self::$post;
    }

    /* Get data sent with get in an object */
    public static function get() {
        if(!self::$init)
            self::init();
        return self::$get;
    }

    /* Get data sent with put in an object */
    public static function put() {
        if(!self::$init)
            self::init();
        return self::$put;
    }

    /* Get data sent with delete in an object */
    public static function delete() {
        if(!self::$init)
            self::init();
        return self::$delete;
    }

    /* Get data sent with head in an object */
    public static function head() {
        if(!self::$init)
            self::init();
        return self::$head;
    }

    /* Get data sent with patch in an object */
    public static function patch() {
        if(!self::$init)
            self::init();
        return self::$patch;
    }
};
