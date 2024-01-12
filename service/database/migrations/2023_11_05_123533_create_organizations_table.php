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
        Schema::create($this->setSchemeName('Organizations'), function (Blueprint $table) {
            $table->id();
            $table->string('nameOrg')->nullable();
            $table->tinyInteger('valid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->isDevEnv()) {
            Schema::dropIfExists($this->setSchemeName('Organizations'));
        }
    }
};
