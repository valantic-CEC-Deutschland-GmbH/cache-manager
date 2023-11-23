<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui\Business;

use Generated\Shared\Transfer\CacheManagerDeleteTransfer;

/**
 * @method \ValanticSpryker\Zed\CacheManagerGui\Business\CacheManagerGuiBusinessFactory getFactory()
 */
interface CacheManagerGuiFacadeInterface
{
    /**
     * @return array<\Generated\Shared\Transfer\CacheManagerPluginTransfer>
     */
    public function getCacheManagerPluginsData(): array;

    /**
     * @param \Generated\Shared\Transfer\CacheManagerDeleteTransfer $cacheManagerDeleteTransfer
     *
     * @return \Generated\Shared\Transfer\CacheManagerDeleteTransfer
     */
    public function deleteCache(CacheManagerDeleteTransfer $cacheManagerDeleteTransfer): CacheManagerDeleteTransfer;
}
