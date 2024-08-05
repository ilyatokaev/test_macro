<?php

namespace App\Controllers;

abstract class AbstractController implements ControllerInterface
{

    public function __construct(public readonly ?array $params)
    {
    }

}