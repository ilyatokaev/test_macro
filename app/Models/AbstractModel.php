<?php

namespace App\Models;

abstract class AbstractModel implements ModelInterface
{

    protected RepositoryInterface $repository;

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




}