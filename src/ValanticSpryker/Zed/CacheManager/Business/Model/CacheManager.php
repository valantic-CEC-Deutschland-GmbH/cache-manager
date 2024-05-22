<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManager\Business\Model;

use Generated\Shared\Transfer\CacheManagerDeleteTransfer;
use Generated\Shared\Transfer\CacheManagerPluginTransfer;
use Spryker\Client\Storage\Redis\Service;
use Spryker\Client\Storage\StorageClientInterface;
use ValanticSpryker\Zed\CacheManager\Communication\Plugin\CacheManagerPluginCollection;

class CacheManager
{
    /**
     * @param \ValanticSpryker\Zed\CacheManager\Communication\Plugin\CacheManagerPluginCollection $cacheManagerPluginCollection
     * @param \Spryker\Client\Storage\StorageClientInterface $storageClient
     */
    public function __construct(protected CacheManagerPluginCollection $cacheManagerPluginCollection, protected StorageClientInterface $storageClient)
    {
    }

    /**
     * @return array<\Generated\Shared\Transfer\CacheManagerPluginTransfer>
     */
    public function getPlugins(): array
    {
        $transfers = [];
        foreach ($this->cacheManagerPluginCollection->getAll() as $plugin) {
            $keyPattern = $plugin->getKeyPattern();
            $transfers[] = (new CacheManagerPluginTransfer())
                ->setName($plugin->getName())
                ->setDescription($plugin->getDescription())
                ->setKeyPattern($keyPattern)
                ->setTotalAmount(count($this->getKeys($keyPattern)));
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

            $keys = $this->getKeys($plugin->getKeyPattern());
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
    protected function getFormattedKeys(array $keys): array
    {
        return array_map(function (string $key) {
            return ltrim($key, Service::KV_PREFIX);
        }, $keys);
    }

    /**
     * @param string $keyPattern
     *
     * @return array
     */
    protected function getKeys(string $keyPattern): array
    {
        return $this->storageClient->getKeys($keyPattern);
    }
}
