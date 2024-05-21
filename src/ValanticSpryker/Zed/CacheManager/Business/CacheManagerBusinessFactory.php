<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManager\Business;

use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use ValanticSpryker\Zed\CacheManager\Business\Model\CacheManager;
use ValanticSpryker\Zed\CacheManager\CacheManagerDependencyProvider;
use ValanticSpryker\Zed\CacheManager\Communication\Plugin\CacheManagerPluginCollection;

class CacheManagerBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \ValanticSpryker\Zed\CacheManager\Business\Model\CacheManager
     */
    public function createCacheManager(): CacheManager
    {
        return new CacheManager(
            $this->createCacheManagerPluginCollection(),
            $this->getStorageClient(),
        );
    }

    /**
     * @return \ValanticSpryker\Zed\CacheManager\Communication\Plugin\CacheManagerPluginCollection
     */
    protected function createCacheManagerPluginCollection(): CacheManagerPluginCollection
    {
        return new CacheManagerPluginCollection($this->getCacheManagerPlugins());
    }

    /**
     * @return array<\ValanticSpryker\Zed\CacheManager\Communication\Plugin\CacheManagerPluginInterface>
     */
    protected function getCacheManagerPlugins(): array
    {
        return $this->getProvidedDependency(CacheManagerDependencyProvider::CACHE_MANAGER_PLUGINS);
    }

    /**
     * @return \Spryker\Client\Storage\StorageClientInterface
     */
    protected function getStorageClient(): StorageClientInterface
    {
        return $this->getProvidedDependency(CacheManagerDependencyProvider::CLIENT_STORAGE);
    }
}
