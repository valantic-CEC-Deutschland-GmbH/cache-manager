<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui\Business\Model;

use Generated\Shared\Transfer\CacheManagerDeleteTransfer;
use Generated\Shared\Transfer\CacheManagerPluginTransfer;
use Spryker\Client\Storage\Redis\Service;
use Spryker\Client\Storage\StorageClientInterface;
use ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginCollection;

class CacheManager
{
    /**
     * @param \ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginCollection $cacheManagerPluginCollection
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     */
    public function __construct(private CacheManagerPluginCollection $cacheManagerPluginCollection, private StorageClientInterface $storageClient)
    {
    }

    /**
     * @return array<\Generated\Shared\Transfer\CacheManagerPluginTransfer>
     */
    public function getPlugins(): array
    {
        $transfers = [];
        foreach ($this->cacheManagerPluginCollection->getAll() as $plugin) {
            $transfers[] = (new CacheManagerPluginTransfer())
                ->setName($plugin->getName())
                ->setDescription($plugin->getDescription())
                ->setKeyPattern($plugin->getKeyPattern());
        }

        return $transfers;
    }

    /**
     * @param \Generated\Shared\Transfer\CacheManagerDeleteTransfer $cacheManagerDeleteTransfer
     *
     * @return \Generated\Shared\Transfer\CacheManagerDeleteTransfer
     */
    public function deleteCache(CacheManagerDeleteTransfer $cacheManagerDeleteTransfer): CacheManagerDeleteTransfer
    {
        $cacheManagerDeleteTransfer->setSuccess(false);

        $name = $cacheManagerDeleteTransfer->getName();
        if ($this->cacheManagerPluginCollection->has($name)) {
            $plugin = $this->cacheManagerPluginCollection->get($name);

            $keys = $this->storageClient->getKeys($plugin->getKeyPattern());
            $formattedKeys = $this->getFormattedKeys($keys);

            $this->storageClient->deleteMulti($formattedKeys);

            $cacheManagerDeleteTransfer
                ->setSuccess(true)
                ->setAmount(count($keys));
        }

        return $cacheManagerDeleteTransfer;
    }

    /**
     * @param array $keys
     *
     * @return array
     */
    private function getFormattedKeys(array $keys): array
    {
        return array_map(function (string $key) {
            return ltrim($key, Service::KV_PREFIX);
        }, $keys);
    }
}
