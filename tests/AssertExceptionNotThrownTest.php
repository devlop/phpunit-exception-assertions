<?php

declare(strict_types=1);

namespace Devlop\PHPUnit\Tests;

use Devlop\PHPUnit\ExceptionAssertions;
use PHPUnit\Framework\TestCase;

final class AssertExceptionNotThrownTest extends TestCase
{
    use ExceptionAssertions;

    function test_assert_exception_not_thrown_does_not_pass_if_the_exception_was_thrown() : void
    {
        $assertionPasses = true;

        try {
            $this->assertExceptionNotThrown(\RuntimeException::class, function () : void {
                throw new \RuntimeException('Oh?');
            });
        } catch (\PHPUnit\Framework\Exception $exception) {
            $assertionPasses = false;
        }

        $this->assertFalse($assertionPasses);
    }

    function test_assert_exception_not_thrown_does_not_pass_if_parent_exception_was_thrown() : void
    {
        $assertionPasses = true;

        try {
            $this->assertExceptionNotThrown(\Throwable::class, function () : void {
                throw \RuntimeException('Oh?');
            });
        } catch (\PHPUnit\Framework\Exception $exception) {
            $assertionPasses = false;
        }

        $this->assertFalse($assertionPasses);
    }

    function test_assert_exception_not_thrown_passes_if_no_exception_was_thrown() : void
    {
        $assertionPasses = true;

        try {
            $this->assertExceptionNotThrown(\RuntimeException::class, function () : void {
                // do nothing
            });
        } catch (\PHPUnit\Framework\Exception $exception) {
            $assertionPasses = false;
        }

        $this->assertTrue($assertionPasses);
    }

    function test_assert_exception_not_thrown_passes_if_another_exception_was_thrown() : void
    {
        $assertionPasses = true;

        try {
            $this->assertExceptionNotThrown(\InvalidArgumentException::class, function () : void {
                throw new \RuntimeException('Oh?');
            });
        } catch (\PHPUnit\Framework\Exception $exception) {
            $assertionPasses = false;
        }

        $this->assertTrue($assertionPasses);
    }
}
