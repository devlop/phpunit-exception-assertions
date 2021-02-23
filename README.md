<p align="center">
    <a href="https://packagist.org/packages/devlop/phpunit-exception-assertions"><img src="https://img.shields.io/packagist/v/devlop/phpunit-exception-assertions" alt="Latest Stable Version"></a>
    <a href="https://github.com/devlop-ab/phpunit-exception-assertions/blob/master/LICENSE.md"><img src="https://img.shields.io/packagist/l/devlop/phpunit-exception-assertions" alt="License"></a>
</p>

# PHPUnit Exception Assertions

Trait containing assertions for easier testing of thrown (or not thrown) exceptions.

# Installation

```bash
composer require --dev devlop/phpunit-exception-assertions
```

# Usage

Include the trait to get access to the assertions.

```php
use Devlop\PHPUnit\ExceptionAssertions;

class YourTest extends TestCase
{
    use ExceptionAssertions;
}
```

# Available Assertions

## assertExceptionThrown

Asserts that a specific exception was thrown during the execution of the callback,
if the callback finishes without the exception being thrown, the assertion fails.

To check for any exception, use `\Throwable::class` as first argument since all exceptions inherits from [`\Throwable`](https://www.php.net/manual/en/class.throwable.php).

```php
$this->assertExceptionThrown(\InvalidArgumentException::class, function () : void {
    // code that should throw the expected exception
});
```

## assertExceptionNotThrown

Asserts that a specific exception was not thrown during the execution of the callback,
if the specified exception was thrown during execution the assertion fails.

**use with caution** - this will only assert that a specific exception was not thrown and
the assertion will pass for any other exceptions thrown, intentional or accidental.
In most cases it is probably better to `assertNoExceptionsThrown` instead.

```php
$this->assertExceptionNotThrown(\InvalidArgumentException::class, function () : void {
    // code that should not throw the exception
});
```

## assertNoExceptionsThrown

Asserts that no exceptions was thrown during the execution of the callback,
if any exceptions was thrown during the execution the assertion fails.

```php
$this->assertNoExceptionsThrown(function () : void {
    // code that should not throw any exceptions
});
```
