<?php
// simplex/web/part06.php
 
require_once __DIR__.'/../app/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

use Symfony\Component\HttpKernel\Controller\ControllerResolver;

$routes = include __DIR__.'/../app/app06.php';

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher  = new UrlMatcher($routes, $context);
$resolver = new ControllerResolver();
 
try
{
    $request->attributes->add($matcher->match($request->getPathInfo()));
 
    $controller = $resolver->getController($request);
    $arguments  = $resolver->getArguments ($request, $controller);
    $response = call_user_func_array($controller, $arguments);
}
catch (ResourceNotFoundException $e) 
{
    $response = new Response('Not Found', 404);
}
catch (Exception $e) 
{
    die($e->getMessage());
    $response = new Response('An error occurred', 500);
}
$response->send();

return;

