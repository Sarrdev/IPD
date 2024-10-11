<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnneeAcademToPreinscriptionsTable extends Migration
{
    public function up(): void
    {
        Schema::table('preinscriptions', function (Blueprint $table) {
            if (!Schema::hasColumn('preinscriptions', 'annee_academ')) {
                $table->string('annee_academ')->nullable()->after('formation');
            }
        });
    }

    public function down(): void
    {
        Schema::table('preinscriptions', function (Blueprint $table) {
            $table->dropColumn('annee_academ');
        });
    }
}
