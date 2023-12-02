<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNameInCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add a new column 'name'
        Schema::table('companies', function (Blueprint $table) {
            $table->string('name')->after('title');
        });

        // Copy data from 'title' to 'name'
        DB::table('companies')->update(['name' => DB::raw('title')]);

        // Drop the 'title' column
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reverse the process
        Schema::table('companies', function (Blueprint $table) {
            $table->string('title')->after('name');
        });

        DB::table('companies')->update(['title' => DB::raw('name')]);

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}