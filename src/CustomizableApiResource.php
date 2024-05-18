<?php

namespace LaravelCustomizableApiResource;

use Illuminate\Http\Request;

trait CustomizableApiResource {
    private $with = [
        'BasicArray',
    ];

    final public function toArray(Request $request): array
    {
       $resourceContent = [];

       foreach($this->with as $element){
        $resourceContent .= $element;
       }

       return $resourceContent;
    }
}