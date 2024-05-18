<?php

namespace LaravelCustomizableApiResource;

use Illuminate\Http\Request;

trait CustomizableApiResource
{
    public static array $withSubResources = [];

    /**
     * Dynamically pass method calls to the underlying resource.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    // public function __call($method, $parameters)
    // {
    //     $method = Str::camel((str_replace('with', '', $method)));

    //     if (method_exists($this, $method)) {
    //         static::$withSubResources[$method] = $parameters;
    //         return $this;
    //     }

    //     return parent::__call($method, $parameters);
    // }

    public function toArray(Request $request): array
    {
        $resourceContent = $this->basicResource($request);
        foreach (static::$withSubResources as $method => $parameters) {
            if (method_exists($this, $method)) {
                $resourceContent = array_merge($resourceContent, $this->{$method}($parameters));
            }elseif(method_exists($this, $parameters)){
                $method = $parameters;
                $resourceContent = array_merge($resourceContent, $this->{$method}());
            }
        }

        return $resourceContent;
    }

    public static function customMake($resource, $withSubResources)
    {
        static::$withSubResources = array_merge(static::$withSubResources, $withSubResources);

        return parent::make($resource);
    }

    public static function customCollection($resource, $withSubResources)
    {
        static::$withSubResources = array_merge(static::$withSubResources, $withSubResources);

        return parent::collection($resource);
    }
}
