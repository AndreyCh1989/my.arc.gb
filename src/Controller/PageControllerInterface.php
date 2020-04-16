<?php


namespace Controller;


use Symfony\Component\HttpFoundation\Request;

interface PageControllerInterface
{
    public function action(Request $request);
}