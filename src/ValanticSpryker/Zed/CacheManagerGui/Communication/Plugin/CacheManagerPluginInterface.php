<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin;

interface CacheManagerPluginInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @return string
     */
    public function getKeyPattern(): string;
}
