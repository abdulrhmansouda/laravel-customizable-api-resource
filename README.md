# Laravel Customizable API Resource

The package provides a flexible way to customize the API resource response based on the user's request, allowing you to include or exclude specific resource fields as needed.

## Installation

To install the package, use Composer:

```bash
composer require abdulrhmansouda/laravel-customizable-api-resource
```

## Usage

Create a new resource class that implements the `Customizable` interface and uses the `CustomizableApiResource` trait:

```php
<?php

namespace App\Http\Mobile\V1\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use LaravelCustomizableApiResource\Customizable;
use LaravelCustomizableApiResource\CustomizableApiResource;

class TestResource extends JsonResource implements Customizable
{
    use CustomizableApiResource;


    // replace toArray method with basicResource method
    public function basicResource(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
        ];
    }

    // a custom subResource
    public function secretSubResource(): array
    {
        return [
            'ownerName'     => $this->owner_name,
        ];
    }

    // another custom subResource
    public function someDetails($parameters): array
    {
        return [
            'moreDetail'                    => $this->more_detail,
            'somePassedDetailAsParameters'  => $parameters['somePassedDetailAsParameters'],
        ];
    }
}

```

In your routes, you can use the `customMake` and `customCollection` methods to create resource instances with the desired configurations:

```php
Route::get('test', function () {
    $ad = Ad::first();

    return TestResource::customMake($ad, [
        'secretSubResource',
        'someDetails' => [
            'somePassedDetailAsParameters' => 'detail one',
        ],
    ]);
});

```

Deal with collection:

```php
Route::get('test', function () {
    $ad = Ad::limit(10)->get();

    return TestResource::customCollection($collection, [
        'secretSubResource',
    ]);
});
```

You can make as much function as you prefer. Addtionally you can change the name of `secretSubResource` and `someDetails`.