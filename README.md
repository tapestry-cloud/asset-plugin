<h1 align="center">Tapetry Asset Plugin</h1>
<p align="center"><em>An equivilant to Laravel mix()</em></p>

<p align="center">
 <a href="https://packagist.org/packages/tapestry-cloud/asset-plugin" title="Packagist"><img src="https://img.shields.io/packagist/v/tapestry-cloud/asset-plugin.svg?style=flat-square" alt="Packagist"/></a>
 <a href="https://php.net/" title="Minimum PHP Version"><img src="https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square" alt="Minimum PHP Version"/></a>
 <a href="LICENSE" title="Software License"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"/></a>
 <a href="https://gitmoji.carloscuesta.me" title="Gitmoji"><img src="https://img.shields.io/badge/gitmoji-%20😜%20😍-FFDD67.svg?style=flat-square" alt="Gitmoji"/></a>
</p>

## Install

To install run: `composer require tapestry-cloud/asset-plugin`
 
Next you need to update your site configuration to include the path to manifest.json: 

```php
// ...

    'plugins' => [
        'asset_manifest_path' => __DIR__ . '/rev-manifest.json'
    ],

// ...
```

Finally within your site Kernel.php you need to register the plugin's service provider:

```php
<?php

use Tapestry\Modules\Kernel\KernelInterface;

class Kernel implements KernelInterface
{
    /**
     * @var Tapestry
     */
    private $tapestry;
    
    public function __construct(Tapestry $tapestry)
    {
        $this->tapestry = $tapestry;
    }
    
    /**
     * This method is executed by Tapestry when the Kernel is registered.
     *
     * @return void
     */
    public function register()
    {
        // Use project autoloader
        require_once(__DIR__ . '/vendor/autoload.php');
    }
    
    /**
     * This method of executed by Tapestry as part of the build process.
     *
     * @return void
     */
    public function boot()
    {
        $this->tapestry->register(\TapestryCloud\Asset\ServiceProvider::class);
    }
}
```

## Usage

This plugin adds the `$this->asset('main.css')` helper, which when paired with a gulp or grunt task that produces a manifest.json file for mapping asset revisions means you don't have to update your html source each time you build your css/js assets.
