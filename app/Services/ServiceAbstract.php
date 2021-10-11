<?php

declare(strict_types=1);


namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class ServiceAbstract
{
    protected $model;

    public function store(array $data): void
    {
        foreach ($data as $dataSet) {
            $this->getModel()::create($dataSet);
        }
    }

    public function setModel($model): void
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function isEmpty(): bool
    {
        return (bool)$this->model->first();
    }

    public static function changeArrayKeys(array $array, array $keys): array
    {
        $newArray = [];

        foreach ($array as $item) {
            $newItem = [];

            foreach ($item as $keyItem => $valueItem) {
                if (array_key_exists($keyItem, $keys)) {
                    $newKey = $keys[$keyItem];
                    $newItem[$newKey] = $valueItem;
                } else {
                    $newItem[$keyItem] = $valueItem;
                }
            }

            $newArray[] = $newItem;
        }

        return $newArray;
    }

}
