<?php

namespace TapestryCloud\Asset;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class AssetHelper implements ExtensionInterface
{
    /**
     * var \Tapestry\Plates\Template
     */
    public $template;

    /**
     * @var Manifest
     */
    private $manifest;

    /**
     * AssetHelper constructor.
     *
     * @param $manifestPath
     * @throws \Exception
     */
    public function __construct($manifestPath)
    {
        $this->manifest = new Manifest($manifestPath);
    }

    /**
     * @param Engine $engine
     */
    public function register(Engine $engine)
    {
        $engine->registerFunction('asset', [$this, 'asset']);
    }

    /**
     * @param $src
     * @return string
     */
    public function asset($src)
    {
        return url($this->manifest->find($src));
    }
}
