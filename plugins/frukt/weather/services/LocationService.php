<?php

namespace Frukt\Weather\services;

use Frukt\Weather\Models\Location;

class LocationService
{
    /**
     * Add new location in database
     *
     * @param array $data Массив с данными локации.
     * @return bool Возвращает true, если локация успешно добавлена.
     */
    public function addLocation(array $data) : bool
    {
        try {
            Location::firstOrCreate(
                [
                    'lat' => $data['lat'],
                    'lon' => $data['lon']
                ],
                [
                    'name' => $data['name'] ?? null
                ]
            );

            return true;
        } catch (\Exception $e) {
            // Логируем ошибку
            \Log::error("Failed to add location: " . $e->getMessage());
            return false;
        }
    }
}
