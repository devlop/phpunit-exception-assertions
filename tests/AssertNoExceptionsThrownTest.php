<?php

declare(strict_types=1);

namespace Devlop\PHPUnit\Tests;

use Devlop\PHPUnit\ExceptionAssertions;
use PHPUnit\Framework\TestCase;

final class AssertNoExceptionsThrownTest extends TestCase
{
    use ExceptionAssertions;

    function test_assert_no_exceptions_thrown_does_not_pass_if_any_exception_was_thrown() : void
    {
        $assertionPasses = true;

        try {
            $this->assertNoExceptionsThrown(function () : void {
                throw new \RuntimeException('Oh?');
            });
        } catch (\PHPUnit\Framework\Exception $exception) {
            $assertionPasses = false;
        }

        $this->assertFalse($assertionPasses);
    }

    function test_assert_no_exceptions_thrown_passes_if_no_exceptions_was_thrown() : void
    {
        $assertionPasses = true;

        try {
            $this->assertNoExceptionsThrown(function () : void {
                // do nothing
            });
        } catch (\PHPUnit\Framework\Exception $exception) {
            $assertionPasses = false;
        }

        $this->assertTrue($assertionPasses);
    }
}
