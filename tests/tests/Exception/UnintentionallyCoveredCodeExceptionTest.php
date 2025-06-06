<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-code-coverage.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeCoverage;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversClass(UnintentionallyCoveredCodeException::class)]
#[Small]
final class UnintentionallyCoveredCodeExceptionTest extends TestCase
{
    public function testCanConstructWithEmptyArray(): void
    {
        $unintentionallyCoveredUnits = [];

        $exception = new UnintentionallyCoveredCodeException($unintentionallyCoveredUnits);

        $this->assertSame($unintentionallyCoveredUnits, $exception->getUnintentionallyCoveredUnits());
        $this->assertSame('', $exception->getMessage());
    }

    public function testCanConstructWithNonEmptyArray(): void
    {
        $unintentionallyCoveredUnits = [
            'foo',
            'bar',
            'baz',
        ];

        $exception = new UnintentionallyCoveredCodeException($unintentionallyCoveredUnits);

        $this->assertSame($unintentionallyCoveredUnits, $exception->getUnintentionallyCoveredUnits());

        $expected = <<<'TXT'
- foo
- bar
- baz

TXT;

        $this->assertSame($expected, $exception->getMessage());
    }
}
