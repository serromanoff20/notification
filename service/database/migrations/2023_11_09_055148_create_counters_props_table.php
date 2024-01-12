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
        Schema::create($this->setSchemeName('CountersProps'), function (Blueprint $table) {
            $table->id();
            $table->foreignId('counterId')->constrained(
                table: $this->setSchemeName("Counters"),
                indexName: "Counters_CountersProps_id"
            );
            $table->string('serialNumber', 64)->nullable();
            $table->date('dateVerification')->nullable();
            $table->tinyInteger('isVerification')->nullable();
//            $table->foreignId('counterTypeId')->constrained(
//                table: $this->setSchemeName("CountersProps"),
//                indexName: "CounterTypes_CountersProps_id"
//            );
            $table->string('through', 10)->nullable();
            $table->tinyInteger('onModeration')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->isDevEnv()) {
            Schema::dropIfExists($this->setSchemeName('CountersProps'));
        }
    }
};
