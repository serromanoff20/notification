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
        Schema::create($this->setSchemeName('Contracts'), function (Blueprint $table) {
            $table->id();
            $table->string('contractType', 30)->nullable();
            $table->string('contractName')->nullable();
            $table->tinyInteger('valid')->nullable();

            $table->foreignId('organizationId')->constrained(
                table: $this->setSchemeName('Organizations'),
                indexName: 'Contracts_Organizations_id'
            )->onDelete('cascade');

            $table->string('code', 8)->nullable();
            $table->string('base1c', 8)->nullable();
            $table->string('inn', 12)->nullable();
            $table->string('kpp', 9)->nullable();
            $table->string('rs', 20)->nullable();
            $table->string('bik', 9)->nullable();
            $table->string('st', 20)->nullable();
            $table->string('bankName')->nullable();
            $table->bigInteger('bankId')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->bigInteger('counterTypeId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->isDevEnv()) {
            Schema::dropIfExists($this->setSchemeName('Contracts'));
        }
    }
};
