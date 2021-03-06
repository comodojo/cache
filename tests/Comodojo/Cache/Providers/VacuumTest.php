<?php namespace Comodojo\Cache\Tests\Providers;

use \Comodojo\Cache\Providers\Vacuum;
use \Comodojo\Cache\Item;
use \DateTime;

/**
 * @group provider
 * @group cache
 * @group vacuum
 */
class VacuumTest extends \PHPUnit_Framework_TestCase {

    protected function setUp() {

        $this->pool = new Vacuum();

    }

    protected function tearDown() {

        unset($this->pool);

    }

    public function testGetItem() {

        $item = $this->pool->getItem('Ford');

        $this->assertFalse($item->isHit());

        $this->assertNull($item->get());

        $this->assertNull($item->getRaw());

    }

    public function testHasItem() {

        $item = $this->pool->getItem('Ford');

        $item->set('I\'m perfect!')->expiresAfter(10);

        $this->assertTrue($this->pool->save($item));

        $this->assertFalse($this->pool->hasItem('Ford'));

    }

    public function testClear() {

        $this->assertTrue($this->pool->clear());

        $this->assertTrue($this->pool->clearNamespace());

    }

}
