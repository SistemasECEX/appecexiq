<?php

namespace App\Http\Controllers;

use App\Models\notify_users;
use App\Http\Requests\Storenotify_usersRequest;
use App\Http\Requests\Updatenotify_usersRequest;

class NotifyUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Storenotify_usersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storenotify_usersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notify_users  $notify_users
     * @return \Illuminate\Http\Response
     */
    public function show(notify_users $notify_users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notify_users  $notify_users
     * @return \Illuminate\Http\Response
     */
    public function edit(notify_users $notify_users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatenotify_usersRequest  $request
     * @param  \App\Models\notify_users  $notify_users
     * @return \Illuminate\Http\Response
     */
    public function update(Updatenotify_usersRequest $request, notify_users $notify_users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notify_users  $notify_users
     * @return \Illuminate\Http\Response
     */
    public function destroy(notify_users $notify_users)
    {
        //
    }
}
