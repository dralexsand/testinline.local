<?php

declare(strict_types=1);


namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

abstract class ServiceAbstract
{
    protected $model;

    public function store(array $data)
    {
        foreach ($data as $data_set) {
            $this->getModel()::create($data_set);
        }
    }

    public function setModel($model)
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
        $new_array = [];

        foreach ($array as $item) {
            $new_item = [];

            foreach ($item as $keyItem => $valueItem) {
                if (array_key_exists($keyItem, $keys)) {
                    $newKey = $keys[$keyItem];
                    $new_item[$newKey] = $valueItem;
                } else {
                    $new_item[$keyItem] = $valueItem;
                }
            }

            $new_array[] = $new_item;
        }

        return $new_array;
    }

}
