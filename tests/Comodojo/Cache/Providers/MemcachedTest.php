<?php namespace Comodojo\Cache\Tests\Providers;

use \Comodojo\Cache\Tests\Utils\EnhancedProviderCommonCases;
use \Comodojo\Cache\Providers\Memcached;

/**
 * @group provider
 * @group cache
 * @group memcached
 */
class MemcachedTest extends EnhancedProviderCommonCases {

    protected function setUp() {

        $this->pool = new Memcached();

    }

    protected function tearDown() {

        unset($this->pool);

    }

}
