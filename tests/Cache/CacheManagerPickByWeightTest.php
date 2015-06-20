<?php

use \Comodojo\Cache\ApcCache;
use \Comodojo\Cache\DatabaseCache;
use \Comodojo\Cache\FileCache;
use \Comodojo\Cache\MemcachedCache;
use \Comodojo\Cache\PhpRedisCache;
use \Comodojo\Cache\CacheManager;
use \Comodojo\Cache\Tests\ManagerCommonCases;

class CacheManagerPickByWeightTest extends ManagerCommonCases {

    protected function setUp() {
        
        $cache_folder = __DIR__ . "/../localcache/";  

        $edb = DatabaseCache::getDatabase('MYSQLI', '127.0.0.1', 3306, 'comodojo', 'root');

        $this->manager = new CacheManager( CacheManager::PICK_BYWEIGHT);

        $this->manager->add( new ApcCache(), 10 );
        $this->manager->add( new DatabaseCache($edb, 'cache', 'comodojo_'), 20 );
        $this->manager->add( new FileCache($cache_folder), 30 );
        $this->manager->add( new MemcachedCache('127.0.0.1'), 50 );
        $this->manager->add( new PhpRedisCache('127.0.0.1'), 50 );
    
    }

    protected function tearDown() {

        unset($this->manager);

    }

}