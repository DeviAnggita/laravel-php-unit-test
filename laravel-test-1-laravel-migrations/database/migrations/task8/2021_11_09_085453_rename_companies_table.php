<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCompaniesTable extends Migration // Ganti nama kelas menjadi RenameCompanyTable
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('company', 'companies'); // Menambahkan migrasi untuk merename tabel
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('companies', 'company'); // Menambahkan migrasi untuk mengembalikan nama tabel
    }
}