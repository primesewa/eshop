<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Icon;
class IconController extends Controller
{
    public function index()
    {
        $i=0;
        $icons = Icon::all()->take(1);
        $icon = Icon::all()->all();
        $this->data('title',$this->make_title('Add Icon'));
        return view('backend.pages.dashboard.homeicon.icon',$this->data,compact('i','icons','icon'));

    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' =>'image|required',
            'image.*' =>'mimes:jpeg,png,bmp,gif,svg'
        ]);
        $filename = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('public/image',$filename);
        $validatedData['image'] = $filename;
        Icon::create($validatedData);
        return redirect()->back()->with('success','Icon Added');

    }
    public function delete($id)
    {
        $icon = Icon::find($id);
        $icon->delete($id);
        return redirect()->back()->with('success','Icon Deleted');


    }

}
