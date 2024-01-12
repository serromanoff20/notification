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
        Schema::create($this->setSchemeName('Counters'), function (Blueprint $table) {
            $table->id();
            $table->string('accountNumber', 40);
            $table->string('adrId', 24);
            $table->string('idCode', 64)->nullable();
            $table->string('counterName', 64)->nullable();
            $table->decimal('counterVal', 15, 6)->nullable();
            $table->date('counterValDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->isDevEnv()) {
            Schema::dropIfExists($this->setSchemeName('Counters'));
        }
    }
};
