<?php

namespace TapestryCloud\Asset;

use League\Container\ServiceProvider\AbstractServiceProvider;
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
     */
    public function register()
    {
        $engine = $this->getContainer()->get(Engine::class);
        $helper = new AssetHelper();
        $engine->loadExtension($helper);
    }
}