<?php
use Symfony\Component\HttpFoundation\Response;
class LeapYearController06
{
    protected function isLeapYear($year = null) 
    {
        if (null === $year) {
            $year = date('Y');
        }
 
        return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
    }
    
    public function indexAction($year)
    {
        if ($this->isLeapYear($year)) {
            return new Response('Yep, this is a leap year!');
        }
 
        return new Response('Nope, this is not a leap year.');
    }
}