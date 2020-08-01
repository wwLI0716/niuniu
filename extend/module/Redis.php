<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/1
 * Time: 13:50
 */
namespace module;

class Redis extends \Redis
{
    /**
     * @return \Redis
     */
    public static function redis() {
        $con = new \Redis();
        $con->connect(config('redis.host'), config('redis.port'), 5);
        return $con;
    }

    /**
     *
     */




}