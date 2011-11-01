<?php
namespace SM\MemcacheBundle;

/**
 * Memcache class to use in test. Only partially implemnted (set/get/add is 
 * supported) - feel free to extend. The implementation is not perfect.
 * @author Tarjei Huse (tarjei@scanmine.com) http://www.kraken.no
 */

class MockMemcache {

    private $_cache = array();

    /**
     * For querying the key info
     * @return array array of key, array($flag, $expire)
     */
    public function getKeyInfo($key) {
        return array($this->get($key), (isset($this->cacheVars[$key])) ? $this->_cacheVars[$key] : null);
    }


    public function get ( $key , &$flags = 0 ) {
        return (isset($this->_cache[$key])) ? unserialize($this->_cache[$key]): null;
    }


    public function add ( $key , $var, $flag = 0, $expire = 0) {
        if (isset($this->_cache[$key])) throw new \Exception("Memcache::add() stores variable var with key only if such key doesn't exist at the server yet");
        $this->set($key, $var, $flag, $expire);
        $this->_cache[$key] =  $var;
    }
    public function set ( $key , $var , $flag = 0, $expire = 0 ) {
        $this->_cache[$key] = serialize($var);
        $this->_cacheVars[$key] = array($flag, $expire);
    }

    public function addServer ( $host , $port = 11211 , $persistent , $weight , $timeout , $retry_interval , $status ,  $failure_callback , $timeoutms ) {
    }
    public function close () {
    }
    public function connect ( $host , $port , $timeout  ) {
    }
    public function decrement ( $key , $value = 1  ) {
    }
    public function delete ( $key , $timeout = 0  ) {
    }
    public function flush ( ) {
    }
    public function getExtendedStats ( $type , $slabid , $limit = 100  ) {
    }
    public function getServerStatus ( $host , $port = 11211  ) {
    }
    public function getStats ($type = null, $slabid = null, $limit = 100) {
    }
    public function getVersion ( ) {
    }
    public function increment ( $key , $value = 1  ) {
    }
    public function pconnect ( $host , $port , $timeout  ) {
    }
    public function replace ( $key , $var , $flag , $expire  ) {
    }
    public function setCompressThreshold ( $threshold , $min_savings  ) {
    }
    public function setServerParams ( $host , $port = 11211 , $timeout , $retry_interval = false , $status , $failure_callback  ) {
    }

}

