<?php

namespace LaravelCustomizableApiResource;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait CustomizableApiResource
{
    public array $withSubResource = [
    ];

    /**
     * Dynamically pass method calls to the underlying resource.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        $method = Str::camel((str_replace('with', '', $method)));

        if (method_exists($this, $method)) {
            $this->withSubResource[$method] = $parameters;
            return $this;
        }

        return parent::__call($method, $parameters);
    }

    public function toArray(Request $request): array
    {
        $resourceContent = $this->basicResource($request);

        foreach ($this->withSubResource as $method => $parameters) {
            if (method_exists($this, $method)) {
                $resourceContent = array_merge($resourceContent, $this->{$method}($parameters));
            }
        }

        return $resourceContent;
    }
}
