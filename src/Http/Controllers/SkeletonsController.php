<?php

namespace Bishopm\Studioblog\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Studioblog\Models\Skeleton;
use Illuminate\Http\Request;

class SkeletonsController extends Controller
{

    public function index()
    {
        $skeletons = Skeleton::orderBy('created_at')->get();
        return view('skeleton::skeletons.index',compact('skeletons'));
    }

    public function edit($id)
    {
        $skeleton = Skeleton::find($id);
        return view('skeleton::skeletons.edit',compact($skeleton));
    }

    public function create()
    {
        return view('skeleton::skeletons.create');
    }

    public function show($slug)
    {

    }

    public function store(Request $request)
    {
        $skeleton = Skeleton::create($request->except('_token','files'));
        return redirect()->route('skeletons.index')
            ->withSuccess('New skeleton added');
    }
    
    public function update(Request $request)
    {
        $skeleton = Skeleton::find($request->id);
        $skeleton->update($request->except('_token','files'));
        return redirect()->route('skeletons.index')
            ->withSuccess('Skeleton updated');
    }

    public function destroy()
    {

    }
}
