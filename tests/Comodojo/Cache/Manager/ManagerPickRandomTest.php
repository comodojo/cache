<?php namespace Comodojo\Cache\Tests\Manager;

use \Comodojo\Cache\Tests\Utils\ManagerCommonCases;
use \Comodojo\Cache\Manager;
use \Comodojo\Cache\Providers\Memory;
use \Comodojo\Cache\Item;
use \Comodojo\Foundation\Logging\Manager as LogManager;

/**
 * @group manager
 * @group cache
 */
class ManagerPickRandomTest extends ManagerCommonCases {

    protected $manager;
    protected $memory_a;
    protected $memory_b;
    protected $memory_c;

    public function setUp() {

        $logger = LogManager::create('cache', false)->getLogger();

        $this->memory_a = new Memory([], $logger);
        $this->memory_b = new Memory([], $logger);
        $this->memory_c = new Memory([], $logger);

        $this->manager = new Manager(Manager::PICK_RANDOM, $logger, true, 5);

        $this->manager
            ->addProvider($this->memory_a, 100)
            ->addProvider($this->memory_b, 50)
            ->addProvider($this->memory_c, 0);

    }

    public function testProviderMatchAlgorithm() {

        $results = [];

        foreach ($this->providerPrimitiveItems() as $item_a) {

            $item = $item_a[0];

            $this->assertTrue($this->manager->save($item));

        }

        foreach ($this->providerPrimitiveItems() as $item_a) {

            $item = $item_a[0];

            $this->assertTrue($this->manager->hasItem($item->getKey()));

            $results[] = $this->manager->getSelectedProvider()->getId();

        }

        $this->assertGreaterThan(1, count(array_unique($results)));

    }

}
