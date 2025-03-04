<?php

namespace Kriosmane\OpenStreetMap\Traits;

use Kriosmane\OpenStreetMap\Facades\OpenStreetMap;

trait HasCoordinates
{
    /**
     * The default column name for latitude.
     * Private to prevent direct property conflicts; override via getLatitudeColumn() if needed.
     *
     * @var string
     */
    private string $latitudeColumn = 'lat';

    /**
     * The default column name for longitude.
     * Private to prevent direct property conflicts; override via getLongitudeColumn() if needed.
     *
     * @var string
     */
    private string $longitudeColumn = 'lon';

    /**
     * Get the latitude column name.
     * Override this in your Eloquent model if you use a different column name.
     *
     * @return string
     */
    public function getLatitudeColumn(): string
    {
        return $this->latitudeColumn;
    }

    /**
     * Get the longitude column name.
     * Override this in your Eloquent model if you use a different column name.
     *
     * @return string
     */
    public function getLongitudeColumn(): string
    {
        return $this->longitudeColumn;
    }

    /**
     * Accessor for the latitude attribute (virtual "lat").
     *
     * @return float|null
     */
    public function getLatAttribute(): ?float
    {
        $column = $this->getLatitudeColumn();
        return isset($this->attributes[$column])
            ? (float) $this->attributes[$column]
            : null;
    }

    /**
     * Mutator for the latitude attribute (virtual "lat").
     *
     * @param  float|null  $value
     * @return void
     */
    public function setLatAttribute(?float $value): void
    {
        $column = $this->getLatitudeColumn();
        $this->attributes[$column] = $value;
    }

    /**
     * Accessor for the longitude attribute (virtual "lon").
     *
     * @return float|null
     */
    public function getLonAttribute(): ?float
    {
        $column = $this->getLongitudeColumn();
        return isset($this->attributes[$column])
            ? (float) $this->attributes[$column]
            : null;
    }

    /**
     * Mutator for the longitude attribute (virtual "lon").
     *
     * @param  float|null  $value
     * @return void
     */
    public function setLonAttribute(?float $value): void
    {
        $column = $this->getLongitudeColumn();
        $this->attributes[$column] = $value;
    }

    /**
     * Checks if both latitude and longitude exist.
     *
     * @return bool
     */
    public function hasCoordinates(): bool
    {
        return !is_null($this->lat) && !is_null($this->lon);
    }

    /**
     * Sets both latitude and longitude at once.
     *
     * @param  float|null  $lat
     * @param  float|null  $lon
     * @return void
     */
    public function setCoordinates(?float $lat, ?float $lon): void
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    /**
     * Fetches coordinates from an address and sets them on the model.
     *
     * @param  string  $address
     * @return $this
     */
    public function setCoordinatesFromAddress(string $address): bool
    {
        $coords = OpenStreetMap::getCoordinates($address);

        if (!empty($coords)) {
            $this->setCoordinates($coords['lat'], $coords['lon']);

            return true;
        }

        return false;
    }
}
