<?php

namespace TapestryCloud\Asset\Tests;


use Symfony\Component\Console\Input\ArrayInput;
use Tapestry\Console\DefaultInputDefinition;
use Tapestry\Tapestry;
use TapestryCloud\Asset\AssetHelper;

class PluginTest extends \PHPUnit_Framework_TestCase
{
    public function testAssetsAreCorrectlyParsed(){

        //
        // The asset helper makes use of the `url` helper function which needs Tapestry loading
        // for it to work. Therefore we init Tapestry with a mock project folder.
        //
        $definitions = new DefaultInputDefinition();
        new Tapestry(new ArrayInput([
            '--site-dir' => __DIR__ . DIRECTORY_SEPARATOR . 'mock_project',
            '--env' => 'testing'
        ], $definitions));

        $assetPlugin = new AssetHelper(__DIR__ . DIRECTORY_SEPARATOR . 'manifest.json');

        $this->assertEquals('http://localhost:3000/js/main.b68bbcd6.js', $assetPlugin->asset('main.js'));
        $this->assertEquals('http://localhost:3000/css/main.b68bbcd6.css', $assetPlugin->asset('main.css'));

        $this->assertEquals('http://localhost:3000/js/main.b68bbcd6.js', $assetPlugin->asset('js/main.js'));
        $this->assertEquals('http://localhost:3000/css/main.b68bbcd6.css', $assetPlugin->asset('css/main.css'));

        $this->assertEquals('http://localhost:3000/test/test.css', $assetPlugin->asset('test/test.css'));
        $this->assertEquals('http://localhost:3000/test.css', $assetPlugin->asset('test.css'));
    }
}