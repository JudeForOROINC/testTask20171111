<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionPostgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //return;
	DB::unprepared('  CREATE OR REPLACE FUNCTION RefInsert(value varchar(255), ed date, cd date, _tbl varchar(255))
  RETURNS integer AS
  $BODY$
  DECLARE 
  _raw RECORD;
  _raw_id INT;
      BEGIN
  IF 
   value is null 
  THEN 
   return null;
  END IF;
  if NOT (_tbl IN (\'city_ref\',\'country_ref\',\'firstname_ref\', \'lastname_ref\') )
  THEN 
   RAISE \'wrong table name % passed!\' , _tbl USING ERRCODE = \'data_exception\';
  END IF;
  
  execute format(\'SELECT %s.id FROM %1$s where %1$s.value = $1 limit 1\',_tbl) using value into _raw_id;
  
  if 
    _raw_id is not null
    THEN
  return _raw_id;
  END IF;
  
 
   execute format(\'INSERT INTO %s (value)  VALUES ($1) limit 1 RETURNING id ; \',_tbl) using value into _raw_id ;
  
   return _raw_id;
   
      END;
  $BODY$
  LANGUAGE \'plpgsql\' ;'
);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        //return;
DB::unprepared('DROP FUNCTION IF EXISTS RefInsert;');
    }
}
