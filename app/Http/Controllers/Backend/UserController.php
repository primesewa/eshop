<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RoleInterface;
use App\Repositories\AdminInterface;

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

        return view('backend.pages.dashboard.user.showuser',compact('admins','i'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all();
        return view('backend.pages.dashboard.user.adduser',compact('roles'));
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
            'Username' => 'required|min:3|max:50',
            'First_name' => 'required|min:3|max:50',
            'Last_name' => 'required|min:3|max:50',
            'Nick_name' => 'required|min:3|max:50',
            'Email' => 'required',
            'Password' => 'required|min:2|max:50',
            'Role'=>'required',
            'Image' =>'image|required',
            'Image.*' =>'mimes:jpeg,png,bmp,gif,svg'
        ]);

        if($request->hasFile('Image')) {
            $filenameWithExt = $request->file('Image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('Image')->getClientOriginalExtension();
            // Filename to store
            $validatedData['Image'] = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('Image')->storeAs('public/image', $validatedData['Image']);
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
        return view('backend.pages.dashboard.user.edituser',compact('admin','roles'));
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
            'Username' => 'required|min:3|max:50',
            'First_name' => 'required|min:3|max:50',
            'Last_name' => 'required|min:3|max:50',
            'Nick_name' => 'required|min:3|max:50',
            'Email' => 'required',
            'Role'=>'required',
            'Password'=>'',
            'Image' =>'image',
            'Image.*' =>'mimes:jpeg,png,bmp,gif,svg'
        ]);

        if($request->hasFile('Image')) {
            $filenameWithExt = $request->file('Image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('Image')->getClientOriginalExtension();
            // Filename to store
            $validatedData['Image'] = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('Image')->storeAs('public/image', $validatedData['Image']);
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
        $this->admin->delete($id);
        return redirect()->back()->with('success', 'User Destroyed');
    }
}
