<?php namespace Comodojo\Cache\Tests\Providers;

use \Comodojo\Cache\Tests\Utils\EnhancedProviderCommonCases;
use \Comodojo\Cache\Providers\Apc;

/**
 * @group provider
 * @group cache
 * @group apc
 */
class ApcTest extends EnhancedProviderCommonCases {

    protected function setUp() {

        $this->pool = new Apc();

    }

    protected function tearDown() {

        unset($this->pool);

    }

}
