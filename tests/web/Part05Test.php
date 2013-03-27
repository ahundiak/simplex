<?php

// simplex/tests/web/Part04Test.php

require_once 'PHPUnit2/Framework/TestCase.php';

class Part05Test extends PHPUnit2_Framework_TestCase
{
    protected $front = '/../../web/part05.php';
    
    public function testNotFound()
    {
        $_SERVER['REQUEST_URI'] = '/NotFound';
        $_GET['name'] = 'Fabien';
     
        ob_start();
        try
        {
            include __DIR__ . $this->front;
        }
        catch( \Exception $e)
        {
            die('Caught Exception');
        }
        $content = ob_get_clean();
 
        $this->assertEquals('Not Found', $content);
    }
    public function testBye()
    {
        $_SERVER['REQUEST_URI'] = '/bye';
 
        ob_start();
        include __DIR__ . $this->front;
        $content = ob_get_clean();
        
        $this->assertEquals("Bye Bye", trim($content));
    }
    public function testHello()
    {
        $_SERVER['REQUEST_URI'] = '/hello/Fabien';
 
        ob_start();
        include __DIR__ . $this->front;
        $content = ob_get_clean();
        
        $this->assertEquals("Hello Fabien", trim($content));
    }
    public function testLeapYear2012()
    {
        $_SERVER['REQUEST_URI'] = '/is_leap_year/2012';
 
        ob_start();
        include __DIR__ . $this->front;
        $content = ob_get_clean();
        
        $this->assertEquals("Yep, this is a leap year!", trim($content));
    }
    public function testLeapYear2011()
    {
        $_SERVER['REQUEST_URI'] = '/is_leap_year/2011';
 
        ob_start();
        include __DIR__ . $this->front;
        $content = ob_get_clean();
        
        $this->assertEquals("Nope, this is not a leap year.", trim($content));
    }
    public function testLeapYearCurrent()
    {
        $_SERVER['REQUEST_URI'] = '/is_leap_year';
 
        ob_start();
        include __DIR__ . $this->front;
        $content = ob_get_clean();
        
        $this->assertEquals("Nope, this is not a leap year.", trim($content));
    }
    
}