<?php

namespace App\Models;


use App\Services\DbService;

abstract class AbstractDbRepository implements RepositoryInterface
{

    protected static string $dbTable;
    protected static array $filterAttributes = [];

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

    /**
     * @return array
     */
    public static function getFilterAttributes(): array
    {
        return static::$filterAttributes;
    }


    /**
     * @return array|null
     */
    public static function all(): ?array
    {
        $result = DbService::getDB()->query('select * from ' . static::getDbTable());

        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * @param array $params
     * @return array|null
     */
    public static function filter(array $params): ?array
    {

        $filterAttribute = static::getFilterAttributes();
        $whereString = self::generateWhereStringByArray($filterAttribute, $params);
        $sql = 'select * from ' . static::getDbTable() . " where {$whereString}";
        $st = DbService::getDB()->prepare($sql);

        foreach ($filterAttribute as $attributeName => $attributeType) {
            if (!isset($params[$attributeName])) {
                continue;
            }

            $value = $params[$attributeName];

            $st->bindParam(":{$attributeName}", $value, $attributeType);
        }

        $st->execute();

        return $st->fetchAll(\PDO::FETCH_ASSOC);

    }


    /**
     * @param array $attributes массив атрибутов с bind-типами PDO
     * @param array $params ассоциативный массив параметров запрос/контекста
     * @return string|null
     */
    public static function generateWhereStringByArray(array $attributes, array $params): ?string
    {

        foreach ($attributes as $attributeName => $value) {

            if (!isset($params[$attributeName])) {
                continue;
            }

            if (isset($resultString)) {
                $resultString .= ' AND ';
            } else {
                $resultString = '';
            }

            $resultString .= "{$attributeName} = :{$attributeName}";
        }

        return $resultString ?? 'FALSE';
    }


    /**
     * @param ModelInterface $model
     * @return ModelInterface|null
     */
    public static function saveNewInstance(ModelInterface $model): ?ModelInterface
    {
        // TODO: Implement saveNewInstance() method.
    }

    /**
     * @param ModelInterface $model
     * @return ModelInterface
     */
    public static function updateInstance(ModelInterface $model): ModelInterface
    {
        // TODO: Implement updateInstance() method.
    }


}