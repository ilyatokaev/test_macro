<?php

namespace App\Models;

use PDO;

class Contact extends AbstractModel
{

    protected static string $repositoryClass = ContactDbRepository::class;

}