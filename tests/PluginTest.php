<?php

namespace TapestryCloud\Asset\Tests;


use Symfony\Component\Console\Input\ArrayInput;
use Tapestry\Console\DefaultInputDefinition;
use Tapestry\Tapestry;
use TapestryCloud\Asset\AssetHelper;
use Webmozart\Assert\Assert;

class PluginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \Exception
     */
    public function testAssetsAreCorrectlyParsed()
    {
        //
        // The asset helper makes use of the `url` helper function which needs Tapestry loading
        // for it to work. Therefore we init Tapestry with a mock project folder.
        //
        $definitions = new DefaultInputDefinition();
        new Tapestry(new ArrayInput([
            '--site-dir' => __DIR__ . DIRECTORY_SEPARATOR . 'mock_project',
            '--env' => 'testing'
        ], $definitions));

        $assetPlugin = new AssetHelper(__DIR__ . DIRECTORY_SEPARATOR . 'manifests' . DIRECTORY_SEPARATOR . 'manifest_a.json');

        $this->assertEquals('http://localhost:3000/js/main.b68bbcd6.js', $assetPlugin->asset('main.js'));
        $this->assertEquals('http://localhost:3000/css/main.b68bbcd6.css', $assetPlugin->asset('main.css'));

        $this->assertEquals('http://localhost:3000/js/main.b68bbcd6.js', $assetPlugin->asset('js/main.js'));
        $this->assertEquals('http://localhost:3000/css/main.b68bbcd6.css', $assetPlugin->asset('css/main.css'));

        $this->assertEquals('http://localhost:3000/test/test.css', $assetPlugin->asset('test/test.css'));
        $this->assertEquals('http://localhost:3000/test.css', $assetPlugin->asset('test.css'));

        $assetPlugin = new AssetHelper(__DIR__ . DIRECTORY_SEPARATOR . 'manifests' . DIRECTORY_SEPARATOR . 'manifest_b.json');

        $this->assertEquals('http://localhost:3000/js/app-0027e65274.js', $assetPlugin->asset('app.js'));
        $this->assertEquals('http://localhost:3000/style/main-14bb52651e.css', $assetPlugin->asset('main.css'));

        $this->assertEquals('http://localhost:3000/js/app-0027e65274.js', $assetPlugin->asset('js/app.js'));
        $this->assertEquals('http://localhost:3000/style/main-14bb52651e.css', $assetPlugin->asset('css/main.css'));

        $this->assertEquals('http://localhost:3000/test/test.css', $assetPlugin->asset('test/test.css'));
        $this->assertEquals('http://localhost:3000/test.css', $assetPlugin->asset('test.css'));
    }
}
