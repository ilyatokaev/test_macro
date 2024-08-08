<?php

namespace App\Models;

class EtlDraftInputDataForUpdate extends AbstractEtlDraftInputData
{
    protected static string $repositoryClass = EtlSessionDbRepository::class;
}