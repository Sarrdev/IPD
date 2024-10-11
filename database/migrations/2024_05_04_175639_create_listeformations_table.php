<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('liste_formations')) {
            Schema::create('liste_formations', function (Blueprint $table) {
                $table->id();
                $table->string('nomfiliere');
                $table->string('parcours');
                $table->decimal('cout', 8, 2);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liste_formations');
    }
};
