<?php

namespace GoogleShokry\LaravelPageSpeed\Test\Middleware;

use GoogleShokry\LaravelPageSpeed\Middleware\InsertDNSPrefetch;
use GoogleShokry\LaravelPageSpeed\Test\TestCase;

class InsertDNSPrefetchTest extends TestCase
{
    protected function getMiddleware()
    {
        $this->middleware = new InsertDNSPrefetch();
    }

    public function testInsertDNSPrefetch()
    {
        $response = $this->middleware->handle($this->request, $this->getNext());

        $this->assertContains('<link rel="dns-prefetch" href="//github.com">', $response->getContent());
        $this->assertContains('<link rel="dns-prefetch" href="//browsehappy.com">', $response->getContent());
        $this->assertContains('<link rel="dns-prefetch" href="//emblemsbf.com">', $response->getContent());
        $this->assertContains('<link rel="dns-prefetch" href="//code.jquery.com">', $response->getContent());
        $this->assertContains('<link rel="dns-prefetch" href="//www.google-analytics.com">', $response->getContent());
    }
}
