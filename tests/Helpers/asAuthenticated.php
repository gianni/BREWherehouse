<?php

use Tests\TestCase;

function asAuthenticated($user): TestCase
{
    return test()->actingAs($user);
}
