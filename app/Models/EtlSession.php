<?php

namespace App\Models;


class EtlSession extends AbstractModel
{

    protected static string $repositoryClass = EtlSessionDbRepository::class;

    public function __construct(public readonly string $typeCode)
    {
    }

}