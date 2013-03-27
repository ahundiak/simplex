<?php
//error_reporting(E_ERROR);

// framework/test.php
require_once 'PHPUnit2/Framework/TestCase.php';

class Part01Test extends PHPUnit2_Framework_TestCase
{
    public function testHello()
    {
        $_GET['name'] = 'Fabien';
 
        ob_start();
        include __DIR__ . '/../../web/part01.php';
        $content = ob_get_clean();
 
        $this->assertEquals('Hello Fabien', $content);
    }
}