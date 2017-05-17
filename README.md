# Tapetry Asset Plugin

## Install

To install run: `composer require tapestry-cloud/asset-plugin`
 
Next you need to update your site configuration to include the path to manifest.json: 

```php
// ...

    'asset' => [
        'manifest_path' => __DIR__ . '/rev-manifest.json'
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