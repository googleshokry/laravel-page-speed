<?php

namespace GoogleShokry\LaravelPageSpeed\Test\Middleware;

use GoogleShokry\LaravelPageSpeed\Middleware\ElideAttributes;
use GoogleShokry\LaravelPageSpeed\Test\TestCase;

class ElideAttributesTest extends TestCase
{
    protected function getMiddleware()
    {
        $this->middleware = new ElideAttributes();
    }

    public function testElideAttributes()
    {
        $response = $this->middleware->handle($this->request, $this->getNext());

        $this->assertContains('<input type="text" disabled value="teste" width="100%">', $response->getContent());
        $this->assertContains('<input type="text" disabled>', $response->getContent());
        $this->assertContains('<option selected class="selected" style="cursor: default">', $response->getContent());
        $this->assertContains('<button name="ok" disabled class="btn" style="border:3px solid blue;">OK</button>', $response->getContent());
        $this->assertContains('<form class="form" style="display:block;border:1px solid red;">', $response->getContent());
    }

    public function testSupport_NGDisabled()
    {
        $response = $this->middleware->handle($this->request, $this->getNext());

        $this->assertContains('<button type="submit" class="btn btn-success btn-block" ng-disabled="form.$invalid || btnLoading">', $response->getContent());
    }
}
