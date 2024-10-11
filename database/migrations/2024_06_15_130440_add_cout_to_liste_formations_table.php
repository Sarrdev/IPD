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
        Schema::table('liste_formations', function (Blueprint $table) {
            if (!Schema::hasColumn('liste_formations', 'cout')) {
                $table->decimal('cout', 8, 2)->notNull()->after('parcours');
            }
        });
    }

    public function down(): void
    {
        Schema::table('liste_formations', function (Blueprint $table) {
            $table->dropColumn('cout');
        });
    }
};
