<?php

namespace Bishopm\Studioblog\Http\Controllers;

use App\Http\Controllers\Controller;
use Bishopm\Studioblog\Models\Studioblog;
use Illuminate\Http\Request;

class StudioblogsController extends Controller
{

    public function index()
    {
        $studioblogs = Studioblog::orderBy('created_at')->get();
        return view('studioblog::studioblogs.index',compact('studioblogs'));
    }

    public function edit($id)
    {
        $studioblog = Studioblog::find($id);
        return view('studioblog::studioblogs.edit',compact($studioblog));
    }

    public function create()
    {
        return view('studioblog::studioblogs.create');
    }

    public function show($slug)
    {

    }

    public function store(Request $request)
    {
        $studioblog = Studioblog::create($request->except('_token','files'));
        return redirect()->route('studioblogs.index')
            ->withSuccess('New studioblog added');
    }
    
    public function update(Request $request)
    {
        $studioblog = Studioblog::find($request->id);
        $studioblog->update($request->except('_token','files'));
        return redirect()->route('studioblogs.index')
            ->withSuccess('Studioblog updated');
    }

    public function destroy()
    {

    }
}
