<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laracasts\Integrated\Extensions\Laravel as IntegratedTest;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
