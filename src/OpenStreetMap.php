<?php

namespace Kriosmane\OpenStreetMap;

use Illuminate\Support\Facades\Http;

class OpenStreetMap
{
    /**
     * The configuration array for the package.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Constructor method that initializes the class with the package configuration.
     *
     * @param  array  $config
     * @return void
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Retrieves the latitude and longitude (lat, lon) of a given address
     * using the Nominatim (OpenStreetMap) API.
     *
     * @param  string  $address
     * @return array|null Returns ['lat' => float, 'lon' => float] or null if an error occurs
     */
    public function getCoordinates(string $address): ?array
    {
        // Build the full endpoint
        // For Nominatim, the minimal query is: /search?q=address&format=jsonv2&limit=1
        $baseUrl = rtrim($this->config['api_base_url'] ?? 'https://nominatim.openstreetmap.org', '/');

        try {
            $response = Http::withHeaders([
                // Provide a descriptive User-Agent (policy requirement for Nominatim)
                'User-Agent' => env('APP_NAME').':Kriosmane-OpenStreetMap-Package (krios.mane@gmail.com)',
            ])
            ->timeout($this->config['timeout'] ?? 5)
            ->get($baseUrl . '/search', [
                'q'      => $address,
                'format' => 'jsonv2',
                'limit'  => 1,
            ]);

            // If the request is successful, parse the JSON response
            if ($response->successful()) {
                $results = $response->json(); // This will be an array of results
                if (!empty($results) && isset($results[0]['lat'], $results[0]['lon'])) {
                    return [
                        'lat' => (float)$results[0]['lat'],
                        'lon' => (float)$results[0]['lon'],
                    ];
                }
            }
        } catch (\Exception $e) {
            // Basic error handling
            // Could log, re-throw, or simply return null
            echo $e->getMessage();
            return null;
        }

        return null;
    }

    /**
     * Retrieves detailed information about a given address (e.g., type of location, bounding box, etc.).
     *
     * @param  string  $address
     * @return array|null
     */
    public function getAddressDetails(string $address): ?array
    {
        $baseUrl = rtrim($this->config['api_base_url'] ?? 'https://nominatim.openstreetmap.org', '/');

        try {
            $response = Http::timeout($this->config['timeout'] ?? 5)
                ->get($baseUrl . '/search', [
                    'q'              => $address,
                    'format'         => 'json',
                    'limit'          => 1,
                    'addressdetails' => 1, // parameter to request detailed address info
                ]);

            if ($response->successful()) {
                $results = $response->json();
                return $results[0] ?? null;
            }
        } catch (\Exception $e) {
            return null;
        }

        return null;
    }
}
