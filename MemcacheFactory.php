<?php

namespace SM\MemcacheBundle;

/**
 * Factoryclass for memcache instances.
 * 
 * @todo Add support for creating a mock memcache for tests
 * @author Tarjei Huse (tarjei - a - scanmine.com) http://www.kraken.no
 */
class MemcacheFactory
{
    /**
     * Creates the instance. The 
     * @param $host memcached host
     * @param $port port to memcache instance
     * @param $use_mock if the factory should return a mock instanc
     * @param $memcacheClass what implementation of memcached to use.
     */
    public static function create($host, $port, $use_mock, $memcacheClass)
    {
        if ($use_mock) {
            return new MockMemcache;
        }
        
        $memcache = new $memcacheClass();

        if ($memcache instanceof Memcache) {
            if (!$memcache->connect($host, $port)) {
                throw new \Exception("Could not connect to memcache service on $host:$port");
            }
        } else {
            $memcache->addServer($host, $port);
        }

        return $memcache;
    }
}