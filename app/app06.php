<?php

// simplex/app/app06.php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

if (!function_exists('render_template'))
{
    function render_template(Request $request = null)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
 
        return new Response(ob_get_clean());
    }
}


// Generate and return collection of routes
$routes = new RouteCollection();
$routes->add('leap_year', new Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => 'LeapYearController06::indexAction',
)));
$routes->add('hello', new Route('/hello/{name}', array(
    'name'    => 'World',
    '_controller' => function (Request $request) 
    {
        // $foo will be available in the template
        $request->attributes->set('foo', 'bar');
        $response = render_template($request);
 
        // change some header
        $response->headers->set('Content-Type', 'text/plain');
 
        return $response;
    },
)));
$routes->add('bye',new Route('/bye', array('_controller' => 'render_template')));
 
return $routes;
