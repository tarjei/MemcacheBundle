<?php
namespace SM\MemcacheBundle;
/**
 * Factoryclass for memcache instances.
 * @todo Add support for creating a mock memcache for tests
 * @author Tarjei Huse (tarjei - a - scanmine.com) http://www.kraken.no
 */
class MemcacheFactory
{
    public static function create($host, $port, $use_mock) 
    {
        if ($use_mock) {
            return new MockMemcache;
        }
        $memcache = new \Memcache();
        if (!$memcache->connect($host, $port)) {
            throw new \Exception("Could not connect to memcache service on $host:$port");
        }
        return $memcache;
    }

}

