<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('role', 'subscriber')->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if ($user) {
            return redirect()->back()->with('message', 'New User Added To Database');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        if (!empty($request->password))
            $data['password'] = Hash::make($request->password);

        $user = $user->update($data);

        if ($user) {
            return redirect()->back()->with('message', 'User Update');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->delete()) {
            return redirect()->back()->with('message', 'User Deleted');
        } else {
            return redirect()->back()->with('error', 'Something wrong. Please try after sometime.');
        }
    }
}
