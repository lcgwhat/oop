<?php
/**
 * Signal.php
 * @author liuchg
 */

namespace app\behavior;


use phpDocumentor\Reflection\Types\Self_;

class Singleton
{
    private function __construct()
    {
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance() {
        if (self::$instance instanceof Singleton) return self::$instance;
        self::$instance = new Singleton();
        self::$time = microtime();
        return self::$instance;
    }

    public function getTime() {
        return self::$time;
    }
    private static $time;
    private static $instance = null;
}
