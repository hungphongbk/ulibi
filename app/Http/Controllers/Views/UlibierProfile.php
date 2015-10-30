<?php

namespace App\Http\Controllers\Views;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View;

class UlibierProfile extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('profile.show', [ Auth::user() ]);
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
     * @param Request $request
     * @param \App\Models\UlibierProfile $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $profile)
    {
        $tab=$request->query('tab','info');
        return View::make('pages.profile',[
            'ulibier'   => $profile->ulibier,
            'profile'   => $profile,
            'tab'       => $tab
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UlibierProfile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $profile)
    {
        //
        if($request->ajax()){
            try {
                $profile->fill($request->except('_token'));
                $profile->save();

                return response()->json(["status" => "OK"]);
            }
            catch (\Exception $ex) {
                return response()->json(["status" => "Error", "message" => $ex->getMessage()]);
            }
        }
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
