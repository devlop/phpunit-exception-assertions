<?php

declare(strict_types=1);

namespace Devlop\PHPUnit\Tests;

use Devlop\PHPUnit\ExceptionAssertions;
use PHPUnit\Framework\TestCase;

final class ExceptionAssertionsTest extends TestCase
{
    function test_assert_exception_thrown_should_be_statically_accessible() : void
    {
        $class = new class extends TestCase {
            use ExceptionAssertions;
        };

        $staticallyAccessible = true;

        try {
            $class::assertExceptionThrown(\Throwable::class, function () : void {
                throw new \RuntimeException('Oh?');
            });
        } catch (\Throwable $e) {
            $staticallyAccessible = false;
        }

        $this->assertTrue($staticallyAccessible, 'Method assertExceptionThrown is not static.');
    }

    function test_assert_exception_thrown_should_not_require_the_using_class_to_implement_dependant_phpunit_methods() : void
    {
        $class = new class {
            use ExceptionAssertions;
        };

        $executionFailed = false;

        try {
            $class::assertExceptionThrown(\Throwable::class, function () : void {
                throw new \RuntimeException('Oh?');
            });
        } catch (\Throwable $e) {
            $executionFailed = true;
        }

        $this->assertFalse($executionFailed, 'Method assertExceptionThrown does not working without the using class implementing dependant methods.');
    }

    function test_assert_exception_not_thrown_should_be_statically_accessible() : void
    {
        $class = new class extends TestCase {
            use ExceptionAssertions;
        };

        $staticallyAccessible = true;

        try {
            $class::assertExceptionNotThrown(\Throwable::class, function () : void {
                //
            });
        } catch (\Throwable $e) {
            $staticallyAccessible = false;
        }

        $this->assertTrue($staticallyAccessible, 'Method assertExceptionNotThrown is not static.');
    }

    function test_assert_exception_not_thrown_should_not_require_the_using_class_to_implement_dependant_phpunit_methods() : void
    {
        $class = new class {
            use ExceptionAssertions;
        };

        $executionFailed = false;

        try {
            $class::assertExceptionNotThrown(\Throwable::class, function () : void {
                //
            });
        } catch (\Throwable $e) {
            $executionFailed = true;
        }

        $this->assertFalse($executionFailed, 'Method assertExceptionNotThrown does not working without the using class implementing dependant methods.');
    }

    function test_assert_no_exceptions_thrown_should_be_statically_accessible() : void
    {
        $class = new class extends TestCase {
            use ExceptionAssertions;
        };

        $staticallyAccessible = true;

        try {
            $class::assertNoExceptionsThrown(function () : void {
                // do nothing
            });
        } catch (\Throwable $e) {
            $staticallyAccessible = false;
        }

        $this->assertTrue($staticallyAccessible, 'Method assertNoExceptionsThrown is not static.');
    }

    function test_assert_no_exceptions_thrown_should_not_require_the_using_class_to_implement_dependant_phpunit_methods() : void
    {
        $class = new class {
            use ExceptionAssertions;
        };

        $executionFailed = false;

        try {
            $class::assertNoExceptionsThrown(function () : void {
                // do nothing
            });
        } catch (\Throwable $e) {
            $executionFailed = true;
        }

        $this->assertFalse($executionFailed, 'Method assertNoExceptionsThrown does not working without the using class implementing dependant methods.');
    }
}
