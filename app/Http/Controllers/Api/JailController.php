<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateJailRequest;
use App\Services\JailService;
use Auth;
use JWTAuth;
use GuzzleHttp\Client;

class JailController extends Controller
{
    protected $jailService;

    public function __construct(JailService $jailService)
    {
        $this->jailService = $jailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jailsStatus = $this->jailService->getJailsStatus()['data'];
        $jails = \App\Jail::with(['owner', 'ip'])->get();
        $jails->each(function ($item, $key) use ($jailsStatus) {
            foreach ($jailsStatus as $key => $value) {
                if ($item['hostname'] === $value->name) {
                    $item['status'] = $value->running ? 'running' : 'stopped';
                }
            }
        });
        return [ 'data' => $jails ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJailRequest $request)
    {
        $ip = \App\Ip::findOrFail($request->input('ip_id'));
        $res = $this->jailService->createJail(
            $request->input('hostname'),
            $ip->ip,
            $request->input('quota'),
            $request->input('ssh_key')
        );
        if ($res['success']) {
            $jail = new \App\Jail($request->only([ 'hostname', 'ip_id', 'quota', 'ssh_key' ]));
            $jail->user_id = $request->user()->id;
            $jail->save();
            return [ 'date' => $jail ];
        }
        return response()->json([
            'success' => false, 
            'error' => isset($res['error']) ? $res['error'] : null,
        ], 500);
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
