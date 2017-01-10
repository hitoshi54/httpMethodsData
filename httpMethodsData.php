<?php
class httpMethodsData {
    private static $post;
    private static $get;
    private static $put;
    private static $delete;
    private static $head;
    private static $patch;

    private static $init = false;

    public static function init() {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if($method != 'post' && $method != 'get' && $method != 'put' && $method != 'delete' && $method != 'head' && $method != 'patch')
            return false;
        $values = json_decode(file_get_contents("php://input"));
        if($values === null) {
            if($method == 'post')
                $values = (object)$_POST;
            elseif($method == 'get')
                $values = (object)$_GET;
        }

        self::$$method = $values;
        self::$init = true;
        return true;
    }

    public static function post() {
        if(!self::$init)
            self::init();
        return self::$post;
    }

    public static function get() {
        if(!self::$init)
            self::init();
        return self::$get;
    }

    public static function put() {
        if(!self::$init)
            self::init();
        return self::$put;
    }

    public static function delete() {
        if(!self::$init)
            self::init();
        return self::$delete;
    }

    public static function head() {
        if(!self::$init)
            self::init();
        return self::$head;
    }

    public static function patch() {
        if(!self::$init)
            self::init();
        return self::$patch;
    }
};
