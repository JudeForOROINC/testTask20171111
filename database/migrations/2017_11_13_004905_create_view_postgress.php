<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewPostgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	DB::unprepared('CREATE OR REPLACE VIEW clients_view as 
select c.id as id, lnr.value as lastname_id, fnr.value as firstname_id, c.personal_code as personal_code, c.email as email, c.adress as adress, cr.value as city_id, cor.value as country_id from clients c left outer join lastname_ref lnr on ( lnr.id = c.lastname_id) left outer join firstname_ref fnr on ( fnr.id = c.firstname_id) left outer join city_ref cr on ( cr.id = c.city_id)  left outer join country_ref cor on ( cor.id = c.country_id);
');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
DB::unprepared('DROP VIEW IF EXISTS clients_view');
    }
}
