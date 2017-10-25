<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$users = User::find(Auth::user()->id);

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
        $owner = Owner::where('id',$id)->first();
        $user = User::where('name',$owner->nama)->first();

        //dd("masuk agan",$id,$request['picture'],$request['nama']);

        if($request['nama']==""){
            $user->name = $owner->nama;
        }else{
            $user->name = $request['nama'];
        }

        $owner->nama = $request['nama'];
        $owner->alamat = $request['alamat'];
        $owner->pekerjaan = $request['pekerjaan'];
        $owner->noTelepon = $request['noTelepon'];
        $owner->noRekening = $request['noRekening'];

        if($request->file('picture')==null){
            $owner->foto = $owner->foto;
        }else{
            $file = $request->file('picture');
            $fileName = $file->getClientOriginalName();
            $request->file('picture')->move("img/",$fileName);
            $owner->foto = $fileName;
        }

        $user->update();
        $owner->update();

        //$data = DB::table('pemilikhomestay')->where('nama', $request['nama'])->first();

        //dd('succes Gan');

        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
