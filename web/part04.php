<?php
// simplex/web/part04.php
 
require_once __DIR__.'/../vendor/autoload.php';
 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

use Symfony\Component\Routing\Generator\UrlGenerator;

$request = Request::createFromGlobals();

// Move to app later
$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', array('name' => 'World')));
$routes->add('bye',   new Route('/bye'));

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);
 
try
{
    $attributes = $matcher->match($request->getPathInfo());
    extract($attributes); // $_route $name
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
    $response = new Response(ob_get_clean());
}
catch (ResourceNotFoundException $e) 
{
    $response = new Response('Not Found', 404);
} 
catch (MethodNotAllowedException $e) 
{
    $response = new Response('Method Not Allowed', 404);
} 
catch (Exception $e) 
{
    $response = new Response('An error occurred', 500);
}
$response->send();

return;

/* ====================================================
 * Generating route stuff
 */
$generator = new UrlGenerator($routes, $context);
 
// outputs /hello/Fabien
echo $generator->generate('hello', array('name' => 'Fabien'));
// outputs /hello/Fabien

// outputs something like http://example.com/somewhere/hello/Fabien
echo $generator->generate('hello', array('name' => 'Fabien'), true);

// Generate optimized UrlMatcher
$dumper = new Routing\Matcher\Dumper\PhpMatcherDumper($routes); 
echo $dumper->dump();

$dumper = new Routing\Matcher\Dumper\ApacheMatcherDumper($routes);
echo $dumper->dump();