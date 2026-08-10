<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Consumption extends Model
{
    protected $fillable = [
        'date',

        'h1','h2','h3','h4','h5',
        'h6','h7','h8','h9','h10',
        'h11','h12','h13','h14','h15',
        'h16','h17','h18','h19','h20',
        'h21','h22','h23','h24','h25',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}