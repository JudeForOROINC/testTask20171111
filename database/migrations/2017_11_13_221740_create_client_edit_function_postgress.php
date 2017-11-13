<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientEditFunctionPostgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
DB::unprepared(
'CREATE OR REPLACE FUNCTION ClientEdit( _id int, _fnr varchar(255), _lnr varchar(255) , pc varchar(255) , em varchar(255) , adr varchar(255), _cr varchar(255), _cor varchar(255), ed date, _cd date)
  RETURNS INT AS
  
  $BODY$
  DECLARE 
  _fnr_id INT;
  _lnr_id INT;
  _cr_id INT;
  _cor_id INT;
  _raw_id INT;
  _raw clients%ROWTYPE;
      BEGIN
  IF 
   em is null 
  THEN 
       raise exception \'email can not be empty! id = %s\',_id
       USING ERRCODE = \'data_exception\';
  END IF;
      
      select id into _raw_id  from clients where email = em ;
  IF 
   _raw_id is not null and _raw_id != _id
  THEN 
   raise exception \' email dublicate!\' USING ERRCODE = \' duplicate_object\';
  END IF;
      
        BEGIN
        select RefInsert(_fnr, ed,_cd, \'firstname_ref\') into _fnr_id;
        select RefInsert(_lnr, ed,_cd, \'lastname_ref\') into _lnr_id;
        select RefInsert(_cr, ed,_cd, \'city_ref\') into _cr_id;
        select RefInsert(_cor, ed,_cd, \'country_ref\') into _cor_id;
        
        
        UPDATE clients SET 
firstname_id = _fnr_id, 
lastname_id = _lnr_id, 
personal_code = pc,  
email = em, 
adress = adr,
city_id = _cr_id,
country_id =_cor_id,
created_at =_cd, 
updated_at =ed 
WHERE id = _id ;
        return _id;

        exception when others then 
                raise exception \'% %\', SQLERRM, SQLSTATE;
        end;
        
        return _id;
        
      END;
  $BODY$
  LANGUAGE \'plpgsql\';');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
DB::unprepared('DROP FUNCTION IF EXISTS ClientEdit;');
    }
}
