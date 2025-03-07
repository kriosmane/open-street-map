[![Latest Version on Packagist](https://img.shields.io/packagist/v/kriosmane/open-street-map.svg?style=flat-square)](https://packagist.org/packages/kriosmane/open-street-map)
[![Total Downloads](https://img.shields.io/packagist/dt/kriosmane/open-street-map.svg?style=flat-square)](https://packagist.org/packages/kriosmane/open-street-map)

# Kriosmane/OpenStreetMap

A Laravel  package that simplifies integration with the OpenStreetMap Nominatim API to fetch coordinates, address details, and more.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [License](#license)

---

## Requirements

- **PHP** >= 8.1
- **Laravel** >= 11
- **Composer** installed

## Installation

1. **Require** the package via Composer:
   ```bash
   composer require kriosmane/open-street-map
   ```

2. **Publish configuration** (optional)
    ```bash
    php artisan vendor:publish --provider="Kriosmane\OpenStreetMap\Providers\OpenStreetMapServiceProvider" --tag="config"
    ```

## Configuration

By default, the package looks for the following configuration parameters:

```bash
return [
    'api_base_url' => env('OSM_API_BASE_URL', 'https://nominatim.openstreetmap.org'),
    'timeout'      => env('OSM_API_TIMEOUT', 5),
];
 ```



