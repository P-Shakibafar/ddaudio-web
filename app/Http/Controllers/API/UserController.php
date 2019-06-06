<?php

namespace App\Http\Controllers\API;

use App\User;
use function auth;
use function explode;
use function file_exists;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use function public_path;
use function strpos;
use function substr;
use function time;
use function unlink;

class UserController extends Controller {
	
	public function __construct()
	{
		$this -> middleware('auth:api');
//			$this -> middleware('auth:api', ['except' => ['index', 'show']]);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \App\User[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function index()
	{
		return User ::latest() -> paginate(5);
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function store(Request $request)
	{
		$this -> validate($request, [
				'name'     => 'required|string|max:191',
				'email'    => 'required|string|email|max:191|unique:users',
				'password' => 'required|string|min:6',
		]);
		
		return User ::create([
				'name'     => $request['name'],
				'email'    => $request['email'],
				'type'     => $request['type'],
				'bio'      => $request['bio'],
				'photo'    => $request['photo'],
				'password' => Hash ::make($request['password']),
		]);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @return void
	 */
	public function show($id)
	{
		//
	}
	
	/**
	 * Show something info user
	 **/
	public function profile()
	{
		return auth('api') -> user();
	}
	
	/**
	 * Update User profile
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function updateProfile(Request $request)
	{
		$user = auth('api') -> user();
		$this -> validate($request, [
				'name'     => 'required|string|max:191',
				'email'    => 'required|string|email|max:191|unique:users,email,' . $user -> id,
				'password' => 'sometimes|required|min:6',
		]);
		$currentPhoto = $user -> photo;
		if($request -> photo != $currentPhoto) {
			$name = time() . '.' . explode('/',
							explode(':',
									substr($request -> photo, 0,
											strpos($request -> photo, ';')
									)
							)[1]
			                       )[1];
			\Image ::make($request -> photo) -> save(public_path('images/profile/') . $name);
			$request -> merge(['photo' => $name]);
			$userPhoto = public_path('images/profile/') . $currentPhoto;
			if(file_exists($userPhoto)) {
				@unlink($userPhoto);
			}
		}
		if( !empty($request -> password)) {
			$request -> merge(['password' => Hash ::make($request['password'])]);
		}
		$user -> update($request -> all());
		
		return ['message' => 'Updated the user info'];
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return array
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function update(Request $request, $id)
	{
		$user = User ::findOrFail($id);
		$this -> validate($request, [
				'name'     => 'required|string|max:191',
				'email'    => 'required|string|email|max:191|unique:users,email,' . $user -> id,
				'password' => 'sometimes|min:6',
		]);
		$user -> update($request -> all());
		
		return ['message' => 'Updated the user info'];
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return array
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function destroy($id): array
	{
		$this -> authorize('isAdmin');
		$user = User ::findOrFail($id);
		//delete the user
		$user -> delete();
		
		return ['message' => 'User Deleted'];
	}
	
	/**
	 * Search any user
	 **/
	public function search()
	{
		if($search = \Request ::get('q')) {
			$users = User ::where(
					function($query) use ($search) {
						$query -> where('name', 'LIKE', "%$search%")
						       -> orWhere('email', 'LIKE', "%$search%")
						       -> orWhere('type', 'LIKE', "%$search%");
					}
			) -> paginate(20);
		} else {
			$users = User ::latest() -> paginate(5);
		}
		
		return $users;
	}
}