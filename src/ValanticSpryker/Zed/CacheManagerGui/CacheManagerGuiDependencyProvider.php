<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CacheManagerGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_CACHE_MANAGER = 'FACADE_CACHE_MANAGER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $this->addCacheManagerFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return void
     */
    private function addCacheManagerFacade(Container $container): void
    {
        $container->set(static::FACADE_CACHE_MANAGER, function (Container $container) {
            return $container->getLocator()->cacheManager()->facade(); // @phpstan-ignore method.notFound
        });
    }
}
