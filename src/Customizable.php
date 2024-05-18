<?php

namespace LaravelCustomizableApiResource;

use Illuminate\Http\Request;

interface Customizable {
    public function BasicResource(Request $request): array;
}