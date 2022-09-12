<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $data = User::all();
        return $data;
    }

    public function search(Request $request)
    {
        $data = User::where('name', 'LIKE', "%$request->search%")->get();
        // dd($data);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        User::create($request->all());
        return 'success';
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return 'success';
    }

    public function edit($id)
    {
        $data = User::find($id)->first();
        return response()->json([$data]);
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        User::where('id', $id)->update($request->all());
        return 'success';
    }
}
