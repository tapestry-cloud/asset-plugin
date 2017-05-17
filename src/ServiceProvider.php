<?php

namespace TapestryCloud\Asset;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Tapestry\Entities\Configuration;
use Tapestry\Plates\Engine;

class ServiceProvider extends AbstractServiceProvider
{
    /** @var array */
    protected $provides = [];

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     * @throws \Exception
     */
    public function register()
    {
        /** @var Engine $engine */
        $engine = $this->getContainer()->get(Engine::class);

        /** @var Configuration $configuration */
        $configuration = $this->getContainer()->get(Configuration::class);

        if (! $manifestPath = $configuration->get('asset.manifest_path')) {
            throw new \Exception('You need to set the location of your manifest path in your site configuration.');
        }

        $helper = new AssetHelper($manifestPath);
        $engine->loadExtension($helper);
    }
}