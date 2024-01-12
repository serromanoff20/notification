<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
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
        Schema::connection('sqlsrv_ogkh')->create(
            $this->setSchemeName('mediatorTablesServiceIPU'),
            function (Blueprint $table) {
                $table->id();
                $table->string('accountNumber', 40);
                $table->string('idCode', 64);
                $table->string('adrId', 24)->nullable();
                $table->string('counterName', 64)->nullable();
                $table->decimal('counterVal', 15, 6)->nullable();
                $table->date('counterValDate')->nullable();
                $table->string('serialNumber')->nullable();
                $table->dateTime('dateVerification')->nullable();
                $table->date('dateLoading')->default(new Expression('CONVERT (date, GETDATE())'));
                $table->tinyInteger('fromOGKH')->default(0);
                $table->tinyInteger('fromAIS')->default(0);
                $table->tinyInteger('fromOutside')->default(0);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->isDevEnv()) {
            Schema::connection('sqlsrv_ogkh')->
                dropIfExists(
                    $this->setSchemeName('mediatorTablesServiceIPU')
                );
        }
    }
};
