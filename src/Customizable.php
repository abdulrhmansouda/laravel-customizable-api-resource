<?php

namespace LaravelCustomizableApiResource;

use Illuminate\Http\Request;

interface CustomizableApiResource {
    public function BasicArray(Request $request): array;
}