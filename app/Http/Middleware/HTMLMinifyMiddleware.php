<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\Console\Output\ConsoleOutput;

class HTMLMinifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var \Illuminate\Http\Response $response */
        $response = $next($request);
        $minify=false;

        if($minify) {
            if (!$response->headers->contains("Content-Type", "text/html; charset=UTF-8"))
                return $response;

            $buffer = $response->getContent();
            $buffer = $this->sanitize_output($buffer);
            $response->setContent($buffer);
        }

        return $response;
    }

    private function sanitize_output($buffer) {

        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s'       // shorten multiple whitespace sequences
        );

        $replace = array(
            '>',
            '<',
            '\\1'
        );

        $buffer=$this->unicode2html($buffer);
        $buffer=preg_replace($search, $replace, $buffer);

        return $buffer;
    }

    private function unicode2html($string) {
        $working = json_encode($string);
        $working = preg_replace('/\\\u([0-9a-z]{4})/', '&#x$1;', $working);
        return json_decode($working);
    }
}
