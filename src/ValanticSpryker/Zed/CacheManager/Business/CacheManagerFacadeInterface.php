<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManager\Business;

interface CacheManagerFacadeInterface
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
