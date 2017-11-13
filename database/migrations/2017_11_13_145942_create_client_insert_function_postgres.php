<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientInsertFunctionPostgres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared('
        CREATE FUNCTION ClientInsert(_fnr varchar(255), _lnr varchar(255) , pc varchar(255) , em varchar(255) , adr varchar(255), _cr varchar(255), _cor varchar(255), _ed date, _cd date)
  RETURNS INT AS
  
  $BODY$
  DECLARE 
  _fnr_id INT;
  _lnr_id INT;
  _cr_id INT;
  _cor_id INT;
  _raw_id INT;
      BEGIN
        BEGIN
        select RefInsert(_fnr, _ed,_cd, \'firstname_ref\') into _fnr_id;
        select RefInsert(_lnr, _ed,_cd, \'lastname_ref\') into _lnr_id;
        select RefInsert(_cr, _ed,_cd, \'city_ref\') into _cr_id;
        select RefInsert(_cor, _ed,_cd, \'country_ref\') into _cor_id;
        
        INSERT INTO clients(firstname_id, lastname_id, personal_code, email, adress, city_id, country_id, created_at, updated_at) VALUES (_fnr_id, _lnr_id, pc, em, adr, _cr_id, _cor_id , _cd , _ed ) RETURNING id into _raw_id;
        exception when others then 
        
        end;
        
        return _raw_id;
        
      END;
  $BODY$
  LANGUAGE \'plpgsql\';
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
        DB::unprepared('DROP FUNCTION IF EXISTS ClientInsert;');
    }
}
