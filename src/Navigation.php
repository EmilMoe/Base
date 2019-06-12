<?php
namespace EmilMoe\Base;

class Navigation
{
    private $text;
    private $link;
    private $icon;
    private $backend;
    private $active;

    public function __construct(string $text, string $link, string $icon, bool $backend, array $active)
    {
        $this->text    = $text;
        $this->link    = $link;
        $this->icon    = $icon;
        $this->backend = $backend;
        $this->active  = $active;
    }

    public function active(string $route): bool 
    {
        return in_array($route, $this->active);
    }

    public function link(): string
    {
        return $this->link;
    }

    public function icon(): string
    {
        return $this->icon;
    }

    public function text(): string
    {
        return $this->text;
    }
}