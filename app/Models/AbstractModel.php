<?php

namespace App\Models;

abstract class AbstractModel implements ModelInterface
{

    protected static string $repositoryClass;

    private string $id;

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }


    /**
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
    }


    /**
     * @param array $params
     * @return mixed
     */
    public static function filter(array $params)
    {
        return static::$repositoryClass::filter($params);
    }

}