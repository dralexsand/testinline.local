<?php

declare(strict_types=1);


namespace App\Traits;

class Helper
{

    public static function changeArrayKeys(array $array, array $keys): array
    {
        $new_array = [];

        foreach ($array as $item) {
            $new_item = [];
            foreach ($keys as $oldKey => $newKey) {
                if (array_key_exists($oldKey, $item)) {
                    $new_item[$newKey] = $item[$oldKey];
                } else {
                    $new_item[$oldKey] = $item[$oldKey];
                }
            }

            $new_array[] = $new_item;
        }

        return $new_array;
    }

}
