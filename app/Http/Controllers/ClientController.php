<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Validator;

class ClientController extends Controller
{
    //
    public function index()
    {
        //return Client::all();
	$clients = \DB::table('clients_view')->get();
	return $clients;
    }
 
    public function show($id)
    {
//\DB::setFetchMode(\PDO::FETCH_ASSOC);
	$clients = \DB::table('clients_view')->where('id', $id)->first();

//var_dump($client);die;
//get();

//$fetchMode = \DB::getFetchMode();
// set mode to custom
//\DB::setFetchMode(\PDO::FETCH_ASSOC);
// get data
//$result = \DB::select('select * from clients_view where id = '.$id);
// restore mode the original
//\DB::setFetchMode($fetchMode);
//var_dump($result);die;

//        return Client::find($id);
//	if ($client){
$clients = Json_encode($clients);
//var_dump($clients); die;
//if (isset($clients[0])){
// $clients = $clients->toArray();
//}
return $clients;
//} else {
//return abort(404);
//}
    }

    public function store(Request $request)
    {
//	die('me here!');
//var_dump($request->all());die;
//        return Client::create($request->all());
	$validator = Validator::make($request->all(), [

            'firstname_id' => 'required',

            'lastname_id' => 'required',

            'email' => 'required|email',

            'adress' => 'required',

        ]);


        if ($validator->passes()) {
//try to submit stored procedure .
$post = $request->all();
$post = array_replace(
array_fill_keys([
'firstname_id',
'lastname_id',
'personal_code',
'email',
'adress',
'city_id',
'country_id',
'ed',
'cd',
],null),$post);
//var_dump($post); die('new exception!');
return $data = \DB::select( 'select ClientInsert(:firstname_id,:lastname_id,:personal_code,:email,:adress,:city_id,:country_id,:ed,:cd);',
$post);
//country_id
//	    return response()->json(['success'=>'Added new records.']);

        }


	return response()->json(['error'=>$validator->errors()->all()]);
	//return \DB::select('select ClientInsert("Param1", "param2",..)');
    }

    public function update(Request $request, $id)
    {
        $article = Client::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Client::findOrFail($id);
        $article->delete();

        return 204;
    }
}
