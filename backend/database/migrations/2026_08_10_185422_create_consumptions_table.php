<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consumptions', function (Blueprint $table) {

            $table->id();

            $table->date('date')->unique();

            for ($hour = 1; $hour <= 25; $hour++) {
                $table->double("h{$hour}")->default(0);
            }

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consumptions');
    }
};