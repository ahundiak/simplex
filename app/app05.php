<?php

// simplex/app/app05.php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Response;

if (!function_exists('render_template'))
{
    function render_template($request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
 
        return new Response(ob_get_clean());
    }
}
if (!function_exists('is_leap_year'))
{
    function is_leap_year($year = null) {
        if (null === $year) {
            $year = date('Y');
        }
 
        return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
    }
}

// Generate and return collection of routes
$routes = new RouteCollection();
$routes->add('leap_year', new Route('/is_leap_year/{year}', array(
    'year' => null,
    '_action' => function ($request) {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Yep, this is a leap year!');
        }
        return new Response('Nope, this is not a leap year.');
    }
)));
$routes->add('hello', new Route('/hello/{name}', array(
    'name'    => 'World',
    '_action' => function ($request) 
    {
        // $foo will be available in the template
        $request->attributes->set('foo', 'bar');
        $response = render_template($request);
 
        // change some header
        $response->headers->set('Content-Type', 'text/plain');
 
        return $response;
    },
)));
$routes->add('bye',new Route('/bye'));
 
return $routes;
