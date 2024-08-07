<?php

namespace App\Models;


abstract class AbstractDbRepository implements RepositoryInterface
{

    protected static string $dbTable;


    /**
     * @param int $id
     * @return static|null
     */
    public static function find(int $id): static
    {
        // TODO: Implement find() method.
    }

    /**
     * Сохраняет новый, или изменяет существующий экземпляр в БД
     *
     * @param ModelInterface $model
     * @return ModelInterface
     */
    public static function save(ModelInterface $model): ModelInterface
    {

        if ($model->getId() === null) {
            static::saveNewInstance($model);
        } else {
            static::updateInstance($model);
        }

        return $model;
    }

    /**
     * Возвращает имя таблицы в БД, соответствующей репозиторию
     *
     * @return string
     */
    public static function getDbTable(): string
    {
        return static::$dbTable;
    }
}