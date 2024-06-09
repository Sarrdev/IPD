<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    
    DB::table('preinscriptions')->update(['user_id' => 1]); 
}

public function down()
{
    DB::table('preinscriptions')->update(['user_id' => null]);
}
};
