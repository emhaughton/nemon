<?php

declare(strict_types=1);

namespace App\Domain\Enums;

enum FormulaPlaceholder: string
{
    case OmieMd = 'OMIE_MD';

    public function placeholder(): string
    {
        return sprintf('[%s]', $this->value);
    }

    public function variable(): string
    {
        return $this->value;
    }
}