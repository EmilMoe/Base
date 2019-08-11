<?php

namespace EmilMoe\Base;

class Language
{
    /**
     * @var array
     */
    private $paths;

    /**
     * Language constructor.
     */
    public function __construct()
    {
        $this->paths = [];
    }

    /**
     * Add translation path.
     *
     * @param string $namespace
     * @param string $path
     */
    public function add(string $namespace, string $path): void
    {
        $this->paths[$namespace][] = $path;
    }

    /**
     * Get all translation paths.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->paths;
    }
}
