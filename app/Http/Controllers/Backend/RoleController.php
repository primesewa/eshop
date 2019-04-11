<?php

namespace App\Http\Controllers\Backend;

use App\Htitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleInterface;
use App\Icon;
class RoleController extends Controller
{
    private $role,$admin;
    public function __construct(RoleInterface $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        $roles=$this->role->all();
        $i=0;
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Role'));
        return view('backend.pages.dashboard.Role.role',$this->data,compact('roles','i','icons'));

    }
    public function title()
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Title'));
        $titles =  Htitle::all();

        return view('backend.pages.dashboard.title',$this->data,compact('icons','titles'));

    }
    public function title_create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:50',
        ]);
        Htitle::create($validatedData);
        return redirect()->back()->with('sucess','Title Added');
    }
    public function title_delete($id)
    {
        $title =  Htitle::find($id);
        $title->delete($id);
        return redirect()->back()->with('sucess','Title Added');
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'Name' => 'required|min:3|max:50',
    ]);
    $this->role->create($validatedData);
    return redirect()->back()->with('success','Role Added');

}

    public function delete($id)
    {

        $this->role->delete($id);
        return redirect()->back()->with('success','Role Deleted');

    }
    public function status($id)
{
    return $this->role->conformed($id);

}

    public function edit($id)
    {
        $role= $this->role->find($id);
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Edit Role'));
        return view('backend.pages.dashboard.Role.roleedit',$this->data,compact('role','icons'));


    }


    public function update($id ,Request $request)
    { $validatedData = $request->validate([
        'Name' => 'required|min:3|max:50',
    ]);
        $this->role->update($validatedData,$id);
        return redirect()->back()->with('success','Role Updated');
    }
}
