<?php

namespace App\Controllers;

abstract class AbstractController implements ControllerInterface
{

    /**
     * @param array|null $params
     */
    public function __construct(public readonly ?array $params)
    {
    }

}