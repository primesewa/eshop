<?php

namespace App\Http\Controllers\Backend;

use App\Admin;
use App\Fakevendor;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleInterface;
use App\Repositories\AdminInterface;
use App\Icon;
use App\contact;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $role,$admin;
    public function __construct(RoleInterface $role,AdminInterface $admin)
    {
        $this->role = $role;
        $this->admin = $admin;
    }
    public function index()
    {
        $admins = $this->admin->paginate();
        $i=0;
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Show Users'));
        return view('backend.pages.dashboard.user.showuser',$this->data,compact('admins','i','icons'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all();
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Users'));
        return view('backend.pages.dashboard.user.adduser',$this->data,compact('roles','icons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|min:3|max:50|unique:admins,username',
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'nick_name' => 'required|min:3|max:50',
            'email' => 'required|unique:admins,email',
            'password' => 'required|min:2|max:50',
            'role'=>'required',
            'image' =>'image|required',
            'image.*' =>'mimes:jpeg,png,bmp,gif,svg'
        ]);

        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $file = public_path("storage/image/".$filenameWithExt);

            if (File::exists($file))
            {
                return redirect()->back()->with('error', 'Image Exist,Please Rename The Image Or Add Another Image');
            }

            $path = $request->file('image')->storeAs('public/image',$filenameWithExt);
            $validatedData['image'] = $filenameWithExt;
        }
        $this->admin->create($validatedData);
        return redirect()->back()->with('success','User added');

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->admin->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $admin =  $this->admin->find($id);
      $roles = $this->role->all();
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Show Users'));
        return view('backend.pages.dashboard.user.edituser',$this->data,compact('admin','roles','icons'));
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
        $validatedData = $request->validate([
            'username' => 'required|min:3|max:50',
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|min:3|max:50',
            'nick_name' => 'required|min:3|max:50',
            'email' => 'required',
            'role'=>'required',
            'password'=>'',
            'image' =>'image',
            'image.*' =>'mimes:jpeg,png,bmp,gif,svg'
        ]);

        if($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $admin = Admin::find($id);
            $file = public_path("storage/image/".$admin->image);

            if (File::exists($file))
            {
                File::delete($file);
            }
            $path = $request->file('image')->storeAs('public/image', $filenameWithExt);
            $validatedData['image'] = $filenameWithExt;
        }
        $this->admin->update($validatedData,$id);
        return redirect()->route('admins.index')->with('success','User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        $file = public_path("storage/image/".$admin->image);
        if (File::exists($file))
        {
            File::delete($file);
        }
        $this->admin->delete($id);
        return redirect()->back()->with('success', 'User Destroyed');
    }

    public function get_vendor()
    {

        $i=0;
        $vendor = Fakevendor::all();
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Vendors'));
        return view('backend.pages.dashboard.user.fakevendor',$this->data,compact('icons','vendor'));
    }
    public function fake_vendor_create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:50'
            ]);
        Fakevendor::create($validatedData);
        return redirect()->back()->with('success', 'Vendor Created');
    }

    public function fake_vendor_delete($id)
    {
        $f = Fakevendor::find($id);
        $f->delete($id);
        return redirect()->back()->with('success', 'Vendor Deleted');

    }

}
