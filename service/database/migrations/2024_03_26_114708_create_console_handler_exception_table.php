<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use App\Traits\MigrationTableSchemaTrait;

    const NAME_TABLE = 'ConsoleHandlerException';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->setScheme(self::NAME_TABLE), function (Blueprint $table) {
            $table->id();
            $table->string('nameProcedure', 100);
            $table->string('descriptionException', 500);
            $table->timestamp('createdAt', 3);
            $table->timestamp('updatedAt', 3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->isDevEnv()) {
            Schema::dropIfExists($this->setScheme(self::NAME_TABLE));
        }
    }
};
