<?php

namespace AdminBundle\Util\GameData\Smite;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;


class Session
{
    const CACHE_KEY = 'gamedata.smite.session';
    const CACHE_LIFETIME = 900;

    protected $_timestamp;

    protected $_id;

    public function __construct($id, $timestamp)
    {
        $this->_id = $id;
        $this->_timestamp = $timestamp;
    }


    /**
     * @param FilesystemAdapter  $cache
     * @return mixed
     */
    static public function fromCache($cache)
    {
        if ($cache->hasItem(self::CACHE_KEY)) {
            $cacheItem = $cache->getItem(self::CACHE_KEY);
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }
        }
        return null;
    }


    /**
     * @param FilesystemAdapter  $cache
     * @return mixed
     */
    public function persist($cache)
    {
        /** @var \Symfony\Component\Cache\CacheItem */
        $cacheItem = $cache->getItem(self::CACHE_KEY);
        $cacheItem->set($this);
        $cache->save($cacheItem);
    }


    public function isExpired($now)
    {
        return(($now - $this->_timestamp) > self::CACHE_LIFETIME);
    }

    public function getId()
    {
        return $this->_id;
    }
}