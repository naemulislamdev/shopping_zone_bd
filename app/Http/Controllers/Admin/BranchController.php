<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Branch;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
            $branches = Branch::when($request['search'], function ($q) use($request){
                $key = explode(' ', $request['search']);
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%");
                }
            })->latest()->paginate(Helpers::pagination_limit($query_param));
            // dd($branches);
           return view('admin-views.branch.index', compact('branches','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-views.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ], [
            'name.required'   => 'Brand name is required!',
            'email.required'   => 'Brand email is required!',
            'phone.required'   => 'Brand phone is required!',
            'address.required'   => 'Brand address is required!',
        ]);

        $branch = new Branch();
        $branch->user_id = auth('admin')->id();
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->phone = $request->phone;
        $branch->address = $request->address;
        $branch->status = 1;
        $branch->save();


        Toastr::success('Branch added successfully!');
        return back();
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
        $b = Branch::where(['id' => decrypt($id)])->withoutGlobalScopes()->first();
        // dd($b);
        return view('admin-views.branch.edit', compact('b'));
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
        // dd($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ], [
            'name.required'   => 'Brand name is required!',
            'email.required'   => 'Brand email is required!',
            'phone.required'   => 'Brand phone is required!',
            'address.required'   => 'Brand address is required!',
        ]);

        $branch = Branch::find($id);
        $branch->user_id = auth('admin')->id();
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->phone = $request->phone;
        $branch->address = $request->address;
        $branch->status = $request->status;
        $branch->save();
        Toastr::success('Branch Updated successfully!');
        return back();
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
