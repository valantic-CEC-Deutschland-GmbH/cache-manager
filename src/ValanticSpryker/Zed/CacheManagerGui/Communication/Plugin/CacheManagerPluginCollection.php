<?php

declare(strict_types = 1);

namespace ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin;

use InvalidArgumentException;

class CacheManagerPluginCollection
{
    private array $plugins = [];

    /**
     * @param array<\ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginInterface> $plugins
     */
    public function __construct(array $plugins)
    {
        foreach ($plugins as $plugin) {
            $this->add($plugin);
        }
    }

    /**
     * @param \ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginInterface $plugin
     *
     * @return void
     */
    public function add(CacheManagerPluginInterface $plugin): void
    {
        $this->plugins[$plugin->getName()] = $plugin;
    }

    /**
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return \ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginInterface
     */
    public function get(string $name): CacheManagerPluginInterface
    {
        if (!$this->has($name)) {
            throw new InvalidArgumentException("No CacheManagerPlugin found for $name");
        }

        return $this->plugins[$name];
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->plugins[$name]);
    }

    /**
     * @return array<\ValanticSpryker\Zed\CacheManagerGui\Communication\Plugin\CacheManagerPluginInterface>
     */
    public function getAll(): array
    {
        return $this->plugins;
    }
}
