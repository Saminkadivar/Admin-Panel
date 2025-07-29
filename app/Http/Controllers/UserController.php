<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $users = User::all();
         if ($request->ajax()) {
            $users = User::latest();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($Users) {
                    return '<a href="' . route('user.edit', $Users->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="' . $Users->id . '">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('user.userlist');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.userinsert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request-> validate([
            'name' =>'required',
            'email' =>'required',
            'phone' =>'required',
            'password' =>'required',
            'address' =>'required',
        ]);

        User::create($request->all());
        return redirect()->route('user.index')->with('success',"user inserst successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users =User::findOrFail($id);
        return view('user.useredit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

                $request-> validate([
            'name' =>'required',
            'email' =>'required',
            'phone' =>'required',
            'password' =>'required',
            'address' =>'required',
        ]);
        $users = User::findOrFail($id);
        $users ->update($request->all());
        return redirect()->route('user.index')->with('success',"user update successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
                $users =User::findOrFail($id);
                $users->delete($id);
            return response()->json(['success' => true]);
    }

    }
