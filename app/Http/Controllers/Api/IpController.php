<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateIpRequest;
use Auth;
use JWTAuth;

class IpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [ 'data' => \App\Ip::with(['owner', 'jail'])->get() ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateIpRequest $request)
    {
        $ip = new \App\Ip($request->only([ 'name', 'ip' ]));
        // echo var_dump(JWTAuth::parseToken()->authenticate());
        $ip->user_id = $request->user()->id;
        $ip->save();
        return [ 'date' => $ip ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return [ 'data' => \App\Ip::with('owner')->findOrFail($id) ];
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
        $ip = \App\Ip::findOrFail($id);
        $ip->delete();
        return [ 'success' => true ];
    }
}
