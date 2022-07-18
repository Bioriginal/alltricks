<?php

class Article
{
    /**
     * @param string $name
     * @param string $sourceName
     * @param string $content
     */
    public function __construct(public string $name, public string $sourceName, public string $content)
    {
    }
}