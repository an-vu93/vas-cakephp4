<?php
namespace App\Middleware;

use Cake\Http\Response;
use Cake\Routing\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UnauthorizedMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        try {
            return $handler->handle($request);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            // Store the current URL for the "back" functionality
            if ($request->getHeader('Referer')) {
                $referer = $request->getHeader('Referer')[0];
                // Only store referer if it's from your domain
                if (strpos($referer, $request->getUri()->getHost()) !== false) {
                    $_SESSION['last_page'] = $referer;
                }
            }

            $redirectUrl = Router::url([
                'controller' => 'Error',
                'action' => 'error403'
            ], true);
            
            return (new Response())
                ->withStatus(403)
                ->withLocation($redirectUrl);
        }
    }
}