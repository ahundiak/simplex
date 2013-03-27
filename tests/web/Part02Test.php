<?php

// simplex/tests/web/Part02Test.php

require_once 'PHPUnit2/Framework/TestCase.php';

class Part02Test extends PHPUnit2_Framework_TestCase
{
    public function testHello()
    {
        $_GET['name'] = 'Fabien';
 
        ob_start();
        include __DIR__ . '/../../web/part02.php';
        $content = ob_get_clean();
 
        $this->assertEquals('Hello Fabien', $content);
    }
}