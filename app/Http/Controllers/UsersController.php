<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UsersController extends Controller
{
	public function index()
	{
		$users = Users::all();
		return response->json($users);
	}
	
	public function store(Request $request)
	{
		$users = new Users;
		$users->id = $request->id;
		$users->name = $request->name;
		$users->nickname = $request->nickname;
		$users->email = $request->email;
		$users->email_verified_at = $request->email_verified_at;
		$users->password = $request->password;
		$users->remember_token = $request->remember_token;
		$users->created_at = $request->created_at;
		$users->updated_at = $request->updated_at;
		$users->save();
		return respnnse()->json(["message" => "Users added"], 201);
	}
	
	public function show($id)
	{
		$users = Users::find($id);
		if(!empty($users))
		{
			return response()->json($users);
		}
		else
		{
			return response()->json(["message" => "Users not found"], 404);
		}
	}
	
	public function update(Request $request, $id)
	{
		if (Users::where('id',$id)->exists())
		{
			$users = Users::find($id);
			$users->id = is_null($request->id) ? $users->id : $request->id;
			$users->name = is_null($request->name) ? $users->name : $request->name;
			$users->nickname = is_null($request->nickname) ? $users->nickname : $request->nickname;
			$users->email = is_null($request->email) ? $users->email : $request->email;
			$users->email_verified_at = is_null($request->email_verified_at) ? $users->email_verified_at : $request->email_verified_at;
			$users->password = is_null($request->password) ? $users->password : $request->password;
			$users->remember_token = is_null($request->remember_token) ? $users->remember_token : $request->remember_token;
			$users->created_at = is_null($request->created_at) ? $users->created_at : $request->created_at;
			$users->updated_at = is_null($request->updated_at) ? $users->updated_at : $request->updated_at;
			$users->save();
			
			return response()->json(["message" => "Users Updated"], 404);
		}
		else
		{
			return response()->json(["message" => "Users Not Found"], 404);
		}
	}
	
	public function destroy($id)
	{
		if(Users::where('id', $id)->exists())
		{
			$users = Users::find($id);
			$users->delete();
			
			return response()->json(["message" => "records deleted"], 202);
		}
		else
		{
			return response()->json(["message" => "users not found"], 404);
		}
	}
}
