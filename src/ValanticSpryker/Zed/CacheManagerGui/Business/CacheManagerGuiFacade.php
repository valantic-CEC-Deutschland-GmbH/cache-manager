<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui\Business;

use Generated\Shared\Transfer\CacheManagerDeleteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \ValanticSpryker\Zed\CacheManagerGui\Business\CacheManagerGuiBusinessFactory getFactory()
 */
class CacheManagerGuiFacade extends AbstractFacade implements CacheManagerGuiFacadeInterface
{
    /**
     * @return array<\Generated\Shared\Transfer\CacheManagerPluginTransfer>
     */
    public function getCacheManagerPluginsData(): array
    {
        return $this->getFactory()->createCacheManager()->getPlugins();
    }

    /**
     * @param \Generated\Shared\Transfer\CacheManagerDeleteTransfer $cacheManagerDeleteTransfer
     *
     * @return \Generated\Shared\Transfer\CacheManagerDeleteTransfer
     */
    public function deleteCache(CacheManagerDeleteTransfer $cacheManagerDeleteTransfer): CacheManagerDeleteTransfer
    {
        return $this->getFactory()->createCacheManager()->deleteCache($cacheManagerDeleteTransfer);
    }
}
