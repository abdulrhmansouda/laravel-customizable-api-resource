<?php

namespace LaravelCustomizableApiResource;

use Illuminate\Http\Request;

interface Customizable {
    public function BasicResource(Request $request): array;
    public static function customMake($resource, $withSubResources = []);
    public static function customCollection($resource, $withSubResources = []);
}