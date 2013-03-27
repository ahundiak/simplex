<?php
// simplex/web/part05.php
 
require_once __DIR__.'/../app/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$routes = include __DIR__.'/../app/app05.php';

$request = Request::createFromGlobals();

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);
 
try
{
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $response = call_user_func($request->attributes->get('_action','render_template'), $request);
}
catch (ResourceNotFoundException $e) 
{
    $response = new Response('Not Found', 404);
}
// Think need back slash?
catch (Exception $e) 
{
    $response = new Response('An error occurred', 500);
}
$response->send();

return;

