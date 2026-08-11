<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\Exceptions\InvalidFormulaException;
use App\Domain\ValueObjects\Formula;
use PHPUnit\Framework\TestCase;

final class FormulaTest extends TestCase
{
    public function test_it_stores_the_expression(): void
    {
        $expression = '([OMIE_MD] * 0.6) + 0.88';

        $formula = new Formula($expression);

        $this->assertSame(
            $expression,
            $formula->expression(),
        );
    }

    public function test_it_requires_omie_md_placeholder(): void
    {
        $this->expectException(
            InvalidFormulaException::class,
        );

        new Formula(
            'PRICE * 0.5',
        );
    }
}