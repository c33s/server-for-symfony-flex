<?php

namespace App\Service;

use Symfony\Component\Cache\Simple\FilesystemCache;

/**
 * Class Cache
 * @package App\Service
 * @author Manuel Voss <manuel.voss@i22.de>
 */
class Cache
{
    const CACHE_DIR = '/var/cache/data';

    /**
     * @var FilesystemCache
     */
    private $cache;

    /**
     * Cache constructor.
     * @param string $projectDir
     */
    public function __construct(string $projectDir)
    {
        $cachePath = $projectDir . self::CACHE_DIR;

        if(!is_dir($cachePath)) {
            mkdir($cachePath);
        }
        $this->cache = new FilesystemCache('flex-server', 0, $cachePath);
    }

    /**
     * @param $method
     * @param $arguments
     */
    public function __call($method, $arguments)
    {
        call_user_func_array([$this->cache, $method], $arguments);
    }
}