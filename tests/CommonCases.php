<?php namespace Comodojo\Cache\Tests;

class CommonCases extends \PHPUnit_Framework_TestCase {

    private $string_content = "Lorem ipsum dolor";

    private $array_content = array(
        'Ford'      =>  'Prefect',
        'Zaphod'    =>  'Beeblebrox',
        'Tricia'    =>  'Mc Millan',
        'Marvin'    =>  null
    );

    protected $cache = null;

    public function testSet() {

        $result = $this->cache->set("test-cache-1", $this->string_content);

        $this->assertTrue($result);

    }

    public function testGet() {

        $result = $this->cache->get("test-cache-1");

        $this->assertEquals($this->string_content, $result);

    }

    public function testDelete() {

        $result = $this->cache->delete("test-cache-1");

        $this->assertTrue($result);

    }

    public function testSetArray() {

        $result = $this->cache->set("test-cache-2", $this->array_content);

        $this->assertTrue($result);

        $result = $this->cache->get("test-cache-2");

        $this->assertSame($this->array_content, $result);

    }

    public function testSetExpire() {

        $result = $this->cache->set("test-cache-3", $this->string_content, 1);

        $this->assertTrue($result);

    }

    /**
     * @runInSeparateProcess
     */
    public function testGetExpired() {

        sleep(3);

        $result = $this->cache->setTime()->get("test-cache-3");
        
        $this->assertNull($result);

    }

    public function testChangeNamespace() {

        $result = $this->cache->setNamespace('comodojo');

        $this->assertInstanceOf('\Comodojo\Cache\CacheInterface\CacheInterface', $result);

        $result = $this->cache->set("test-cache-4", $this->string_content);

        $this->assertTrue($result);

        $result = $this->cache->get("test-cache-4");

        $this->assertEquals($this->string_content, $result);

        $result = $this->cache->setNamespace('foonamespace');

        $this->assertInstanceOf('\Comodojo\Cache\CacheInterface\CacheInterface', $result);

        $result = $this->cache->get("test-cache-4");

        $this->assertNull($result);
        
    }

    public function testStatus() {

        $result = $this->cache->status();

        $this->assertInternalType('array', $result);

        $this->assertArrayHasKey("provider", $result);

        $this->assertArrayHasKey("enabled", $result);

        $this->assertArrayHasKey("objects", $result);

        $this->assertArrayHasKey("options", $result);

    }

    /**
     * @after
     */
    public function testFlush() {

        $result = $this->cache->flush();

        $this->assertTrue($result);

        $this->assertNull($this->cache->get("test-cache-1"));

        $this->assertNull($this->cache->get("test-cache-2"));
        
        $this->assertNull($this->cache->get("test-cache-3"));

    }

}
