<?php

namespace App\Http\Controllers;

use App\Darbai;
use App\User;
use APP\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('PabaigosData', 'DESC')->get();
        return view('user',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usercreate');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'termination' => ['max:255'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequests $request)
    {
        user::create($request->all());
        return redirect()->route('user.index')->with('message','item added succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $user
     * @return \Illuminate\Http\Response
     */

    /*
    public function edit(User $user)
    {
        return view('useredit',compact('user'));
    }
    */

    public function edit($user)
    {
        $darbai = Darbai::all();
        $user = User::find($user);
        return view('useredit',compact('user','darbai'));
    }


    public function search(Request $request)
    {


        $users = User::with('darbai')
            ->where('Vardas', 'like', '%'.$request->search.'%')
            ->orWhere('Pavarde', 'like', '%'.$request->search.'%')->get();
        return view('user',['users' => $users]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $user
     * @return \Illuminate\Http\Response
     */

/*
    public function update(UserRequests $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('user.index')->with('message','Updated succesfully');
    }

*/

    public function update(Request $request,$user)
    {
        $input = $request->all();
        $user = User::find($user);
        $user -> email = $input['email'];
        $user -> PabaigosData = $input['PabaigosData'];
        $user -> DarboKodas = $input['DarboKodas'];

        $user ->save();
        return redirect('/user');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('message','Deleted succesfully');

    }


}
