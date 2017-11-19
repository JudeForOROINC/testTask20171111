<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Validator;
use Storage;

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
	$clients = \DB::table('clients_view')->where('id', $id)->first();

	$client = Json_encode($clients);
	return $client;
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
$data = \DB::select( 'select ClientInsert(:firstname_id,:lastname_id,:personal_code,:email,:adress,:city_id,:country_id,:ed,:cd);',
$post);
//country_id
	    return response()->json($data,201);

        }


	return response()->json(['error'=>$validator->errors()->all()]);
	//return \DB::select('select ClientInsert("Param1", "param2",..)');
    }

    public function update(Request $request, $id)
    {
        
//$article = Client::findOrFail($id);
//        $article->update($request->all());
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
'id',
'firstname_id',
'lastname_id',
'personal_code',
'email',
'adress',
'city_id',
'country_id',
'ed',
'cd',
],null),$post,['id'=>$id]);
//var_dump($post); die('new exception!');
return $data = \DB::select( 'select ClientEdit(:id,:firstname_id,:lastname_id,:personal_code,:email,:adress,:city_id,:country_id,:ed,:cd);',
$post);
}
//
	return response()->json(['error'=>$validator->errors()->all()]);
        //return $article;
    }

    public function delete(Request $request, $id)
    {
        $article = Client::findOrFail($id);
        $article->delete();

        return response()->json([],204);
    }

    public function upload(Request $request)
    {
	return response()->json([],404);
    }

    public function download(Request $request)
    {
	$clients = \DB::table('clients_view')->get();
	$data = json_encode($clients);
//store it or throw.

      	$file = time() . '_file.json';
        if (Storage::put($file,$clients)){
	    $pathToFile=storage_path()."/app/".$file;
		//TODO: clear storage?
	    return response()->download($pathToFile,'clients_file.json',['Content-Type'=>'application/json']);
        };

 	return response()->json([],404);
    }

}
