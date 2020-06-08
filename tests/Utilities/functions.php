<?php

/**
 * Shorthand to create objects via model factories.
 */
function create($class, $attributes = [])
{
    return factory($class)->create($attributes);
}

/**
 * Shorthand to create objects via model factories.
 */
function createCollection($class, $number = 1, $attributes = [])
{
    return factory($class, $number)->create($attributes);
}

/**
 * Shorthand to create objects via model factories.
 */
function createWithState($class, $state, $attributes = [])
{
    return factory($class)->states($state)->create($attributes);
}

/**
 * Shorthand to make objects via model factories.
 */
function make($class, $attributes = [])
{
    return factory($class)->make($attributes);
}

/**
 * Shorthand to make objects via model factories.
 */
function makeWithState($class, $state, $attributes = [])
{
    return factory($class)->states($state)->make($attributes);
}
