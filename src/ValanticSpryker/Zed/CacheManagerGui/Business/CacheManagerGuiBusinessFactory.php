<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use ValanticSpryker\Zed\CacheManager\Business\CacheManagerFacadeInterface;
use ValanticSpryker\Zed\CacheManagerGui\CacheManagerGuiDependencyProvider;

class CacheManagerGuiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \ValanticSpryker\Zed\CacheManager\Business\CacheManagerFacadeInterface
     */
    public function getCacheManagerFacade(): CacheManagerFacadeInterface
    {
        return $this->getProvidedDependency(CacheManagerGuiDependencyProvider::FACADE_CACHE_MANAGER);
    }
}
