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
     * @var string
     */
    private $manifestPath = '';

    /**
     * AssetHelper constructor.
     *
     * @param $manifestPath
     */
    public function __construct($manifestPath)
    {
        $this->manifestPath = $manifestPath;
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
        if (file_exists($this->manifestPath)) {
            $manifest = json_decode(file_get_contents($this->manifestPath), true);
            $filename = pathinfo($src, PATHINFO_BASENAME);
            if (isset($manifest[$filename])) {
                $src = str_replace($filename, $manifest[$filename], $src);
            }
        }
        return url($src);
    }
}
