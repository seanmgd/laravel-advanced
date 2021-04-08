<?php


namespace App\Facades;


class Postcard
{

    protected static function resolveFacade($name)
    {
        return app()[$name];
    }

    // Magic PHP method to grab any calls or methods that not exists in the class
    public static function __callStatic($method, $arguments)
    {
        // Using self instead of this when its a static function
        return (self::resolveFacade('Postcard'))
            ->$method(...$arguments); // Call with prefix $ when its a static function
    }
}
