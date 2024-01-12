<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use App\Traits\MigrationTableSchemaTrait;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->setSchemeName('CounterTypes'), function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('shortName', 10)->nullable();
            $table->string('measure', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->isDevEnv()) {
            Schema::dropIfExists($this->setSchemeName('CounterTypes'));
        }
    }
};
