<?php

/**
 * Created by PhpStorm.
 * User: kandorm
 * Date: 17-3-25
 * Time: 下午10:28
 */
class RedisConnect {
    const REDISHOSTNAME = "127.0.0.1";
    const REDISPORT = 6379;
    const REDISPASSWORD = "d-wan142014011290";
    const REDISTIMEOUT = 0;
    private static $instance;
    private $redis;

    private function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect(self::REDISHOSTNAME, self::REDISPORT, self::REDISTIMEOUT);
        $this->redis->auth(self::REDISPASSWORD);
    }

    private function __clone()
    {
    }

    public static function getRedisInstance () {
        if(!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getRedisConn() {
        return $this->redis;
    }

    public function __destruct()
    {
        self::$instance->redis->close();
        self::$instance = NULL;
    }
}
?>