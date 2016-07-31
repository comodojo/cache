<?php

use \Comodojo\Cache\Tests\CommonCases;
use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

class PhpRedisTest extends CommonCases {

    protected static $logger;

    public static function setupBeforeClass() {

        self::$logger = new Logger('PhpRedisCacheTest');

        self::$logger->pushHandler(new StreamHandler(__DIR__."/../tmp/PhpRedisCacheTest.log", Logger::DEBUG));

    }

    protected function setUp() {

        $this->cache = new \Comodojo\Cache\Providers\PhpRedis('127.0.0.1', 6379, 0, self::$logger);

    }

    protected function tearDown() {

        unset($this->cache);

    }

}
