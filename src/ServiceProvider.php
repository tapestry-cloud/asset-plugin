<?php

namespace TapestryCloud\Asset;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Tapestry\Entities\Configuration;
use Tapestry\Plates\Engine;

class ServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
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
        // ...
    }

    /**
     * Method will be invoked on registration of a service provider implementing
     * this interface. Provides ability for eager loading of Service Providers.
     *
     * @return void
     * @throws \Exception
     */
    public function boot()
    {
        /** @var Engine $engine */
        $engine = $this->getContainer()->get(Engine::class);

        /** @var Configuration $configuration */
        $configuration = $this->getContainer()->get(Configuration::class);

        if (! $manifestPath = $configuration->get('plugins.asset_manifest_path')) {
            throw new \Exception('You need to set the location of your manifest path in your site configuration.');
        }

        $engine->loadExtension(new AssetHelper($manifestPath));
    }
}