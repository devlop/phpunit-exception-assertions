<?php

declare(strict_types=1);

namespace Devlop\PHPUnit;

use Throwable;

trait ExceptionAssertions
{
    /**
     * Assert that a specific exception was thrown during executing of the callback
     * Returns the thrown exception if additional assertions needs to be done
     *
     * @param  class-string  $expectedException
     * @param  callable  $callback
     * @return void
     */
    public function assertExceptionThrown(string $expectedException, callable $callback, ?callable $validator = null) : Throwable
    {
        $thrownException = null;

        try {
            $callback();
        } catch (Throwable $e) {
            $thrownException = $e;
        }

        $this->assertInstanceOf(
            $expectedException,
            $thrownException,
            $thrownException === null
                ? \sprintf('Failed asserting that an exception of type "%1$s" was thrown, no exception was thrown.', $expectedException)
                : \sprintf(
                    'Failed asserting that an exception of type "%1$s" was thrown, the thrown exception was of type "%2$s".',
                    $expectedException,
                    \get_class($thrownException),
                ),
        );

        if ($validator !== null) {
            $validator($thrownException);
        }

        return $thrownException;
    }

    /**
     * Assert that a specific exception was not thrown during execution of the callback
     * Assertion will pass if no exceptions was thrown or an exception
     * was thrown but not instanceof $expectedException
     *
     * @param  class-string  $expectedException
     * @param  callable  $callback
     * @return void
     */
    public function assertExceptionNotThrown(string $expectedException, callable $callback) : void
    {
        $thrownException = null;

        try {
            $callback();
        } catch (Throwable $e) {
            $thrownException = $e;
        }

        $this->assertNotInstanceOf(
            $expectedException,
            $thrownException,
            \sprintf(
                'Failed asserting that an exception of type "%1$s" was not thrown.',
                $expectedException,
            ),
        );
    }

    /**
     * Assert that no exceptions was thrown during execution of the callback
     *
     * @param  callable  $callback
     * @return void
     */
    public function assertNoExceptionsThrown(callable $callback) : void
    {
        $thrownException = null;

        try {
            $callback();
        } catch (Throwable $e) {
            $thrownException = $e;
        }

        $this->assertNull(
            $thrownException,
            \sprintf(
                'Failed asserting that no exceptions was thrown, exception of type "%1$s was thrown.',
                \get_class($thrownException),
            ),
        );
    }
}
