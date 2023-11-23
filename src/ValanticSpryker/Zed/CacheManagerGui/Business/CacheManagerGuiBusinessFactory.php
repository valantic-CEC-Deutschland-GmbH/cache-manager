<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui\Business;

use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use ValanticSpryker\Zed\CacheManagerGui\Business\Model\CacheManager;
use ValanticSpryker\Zed\CacheManagerGui\CacheManagerGuiDependencyProvider;
use ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginCollection;

class CacheManagerGuiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \ValanticSpryker\Zed\CacheManagerGui\Business\Model\CacheManager
     */
    public function createCacheManager(): CacheManager
    {
        return new CacheManager(
            $this->createCacheManagerPluginCollection(),
            $this->getStorageClient(),
        );
    }

    /**
     * @return \ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginCollection
     */
    protected function createCacheManagerPluginCollection(): CacheManagerPluginCollection
    {
        return new CacheManagerPluginCollection($this->getCacheManagerPlugins());
    }

    /**
     * @return array<\ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginInterface>
     */
    protected function getCacheManagerPlugins(): array
    {
        return $this->getProvidedDependency(CacheManagerGuiDependencyProvider::CACHE_MANAGER_PLUGINS);
    }

    /**
     * @return \Spryker\Client\Storage\StorageClientInterface
     */
    protected function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(CacheManagerGuiDependencyProvider::CLIENT_STORAGE);
    }
}
