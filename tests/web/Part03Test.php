<?php

// simplex/tests/web/Part03Test.php

require_once 'PHPUnit2/Framework/TestCase.php';

class Part03Test extends PHPUnit2_Framework_TestCase
{
    public function testNotFound()
    {
        $_SERVER['REQUEST_URI'] = '/NotFound';
        $_GET['name'] = 'Fabien';
     
        ob_start();
        include __DIR__ . '/../../web/part03.php';
        $content = ob_get_clean();
 
        $this->assertEquals('Not Found', $content);
    }
    public function testHello()
    {
        $_SERVER['REQUEST_URI'] = '/hello';
        $_GET['name'] = 'Fabien';
 
        ob_start();
        include __DIR__ . '/../../web/part03.php';
        $content = ob_get_clean();
        
        $this->assertEquals("Hello Fabien", trim($content));
    }
    public function testBye()
    {
        $_SERVER['REQUEST_URI'] = '/bye';
 
        ob_start();
        include __DIR__ . '/../../web/part03.php';
        $content = ob_get_clean();
        
        $this->assertEquals("Bye Bye", trim($content));
    }
}