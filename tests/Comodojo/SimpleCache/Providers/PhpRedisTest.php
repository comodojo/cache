<?php namespace Comodojo\SimpleCache\Tests\Providers;

use \Comodojo\SimpleCache\Providers\PhpRedis;
use \Comodojo\SimpleCache\Tests\Utils\EnhancedProviderCommonCases;

/**
 * @group provider
 * @group simplecache
 * @group phpredis
 */
class PhpRedisTest extends EnhancedProviderCommonCases {

    protected function setUp() {

        $this->provider = new PhpRedis();

    }

}
