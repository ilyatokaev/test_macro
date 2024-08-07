<?php

namespace App\Models;

interface RepositoryInterface
{

    public static function save(ModelInterface $model): ModelInterface;
    public static function saveNewInstance(ModelInterface $model): ModelInterface;
    public static function updateInstance(ModelInterface $model): ModelInterface;

    public static function find(int $id): ?static;

    public static function all(): ?array;


}