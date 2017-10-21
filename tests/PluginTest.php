<?php

namespace TapestryCloud\Asset\Tests;


use TapestryCloud\Asset\AssetHelper;

class PluginTest extends \PHPUnit_Framework_TestCase
{
    public function testAssetsAreCorrectlyParsed(){
        $assetPlugin = new AssetHelper(__DIR__ . DIRECTORY_SEPARATOR . 'manifest.json');

        var_dump($assetPlugin->asset('main.js'));
    }
}