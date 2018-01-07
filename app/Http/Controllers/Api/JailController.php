<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJailRequest;
use Auth;
use JWTAuth;

class JailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [ 'data' => \App\Jail::with(['owner', 'ip'])->get() ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJailRequest $request)
    {
        $jail = new \App\Jail($request->only([ 'hostname', 'ip_id', 'quota', 'ssh_key' ]));
        $jail->user_id = $request->user()->id;
        $jail->save();
        return [ 'date' => $jail ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return [ 'data' => \App\Jail::with(['owner', 'ip'])->findOrFail($id) ];
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
        $ip = \App\Jail::findOrFail($id);
        $ip->delete();
        return [ 'success' => true ];
    }
}
