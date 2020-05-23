<?php

/**
 * Creates a new class
 *
 * @param $class
 * @param array $attributes
 * @param null $times
 *
 * @return mixed
 */
function create($class, $attributes = [], $times = null)
{
    return factory($class, $times)->create($attributes);
}

/**
 * Makes new class
 *
 * @param $class
 * @param array $attributes
 * @param null $times
 *
 * @return mixed
 */
function make($class, $attributes = [], $times = null)
{
    return factory($class, $times)->make($attributes);
}
