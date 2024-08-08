<?php

namespace App\Models;

class EtlDraftInputDataForSeed extends AbstractEtlDraftInputData
{
    protected static string $repositoryClass = EtlSessionDbRepository::class;
}