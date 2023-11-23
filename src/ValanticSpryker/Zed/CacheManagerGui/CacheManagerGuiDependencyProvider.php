<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui;

use Spryker\Client\Storage\StorageClientInterface;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \ValanticSpryker\Zed\CacheManagerGui\CacheManagerGuiConfig getConfig()
 */
class CacheManagerGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CACHE_MANAGER_PLUGINS = 'CACHE_MANAGER_PLUGINS';
    public const CLIENT_STORAGE = 'CLIENT_STORAGE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $this->addCacheManagerPlugins($container);
        $this->addStorageClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addCacheManagerPlugins(Container $container): void
    {
        $container->set(self::CACHE_MANAGER_PLUGINS, function () {
            return $this->getCacheManagerPlugins();
        });
    }

    /**
     * @return array<\ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginInterface>
     */
    protected function getCacheManagerPlugins(): array
    {
        return [];
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    protected function addStorageClient(Container $container): void
    {
        $container->set(
            self::CLIENT_STORAGE,
            fn (): StorageClientInterface => $container->getLocator()->storage()->client()
        );
    }
}
