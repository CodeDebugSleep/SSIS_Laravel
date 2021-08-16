<?php

namespace App\Http\Controllers;

use App\User;
use App\UserArchive;
use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $users = DB::table('users')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->select('positions.*', 'users.*')
            ->where('users.id', '!=', auth()->user()->id)
            ->whereNull('deleted_at')
            ->get();
        //$roles = DB::table('positions')->get();
        $positions = DB::table('positions')
            ->leftJoin('users', 'users.position_id', '=', 'positions.id')
            ->select('positions.note', 'positions.position', 'users.*')
            ->get();

        return view('AdminFolder.viewUsers')->with([
            'users' => $users,
            'positions' => $positions,
        ]);
    }

    public function archive($id)
    {
        $users = User::find($id);
        $users->delete();
    }

    public function archUser(Request $request)
    {
        $users = DB::table('users')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->select('positions.note', 'positions.position', 'users.*')
            ->whereNotNull('deleted_at')
            ->get();
        
        return view('AdminFolder.userArchive')->with('users', $users);
    }

    public function restore($id)
    {
        User::where('id', $id)->restore();
        return redirect('/viewArchUser');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = DB::table('positions')->get();
        return view('auth.register')->with('positions', $positions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('AdminFolder.view_user_profile')->with('users', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //SELECT users.name, users.email, users.contact, positions.position, positions.note FROM users LEFT JOIN positions ON users.position_id = positions.id

        // $users = User::find($id);
        //$positions = Position::find($id);
        $users = DB::table('users')->find($id);
        return Response::json($users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $users = DB::table('users')
            ->where('id', '=', $id)->delete();
    }
}
