<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Enums;

use App\Domain\Enums\FormulaPlaceholder;
use PHPUnit\Framework\TestCase;

final class FormulaPlaceholderTest extends TestCase
{
    public function test_it_returns_the_expected_placeholder(): void
    {
        $this->assertSame(
            '[OMIE_MD]',
            FormulaPlaceholder::OmieMd->placeholder(),
        );
    }

    public function test_it_returns_the_expected_variable(): void
    {
        $this->assertSame(
            'OMIE_MD',
            FormulaPlaceholder::OmieMd->variable(),
        );
    }
}