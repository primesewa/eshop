<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MaincategoryInterface;
use App\Repositories\SubcategoryInterface;
use App\Repositories\MinicategoryInterface;

class CategoryController extends Controller
{
    private $maincategory,$subcategory,$minicategory;
    public function __construct(MaincategoryInterface $maincategory,SubcategoryInterface $subcategory,MinicategoryInterface $minicategory)
    {
        $this->maincategory = $maincategory;
        $this->subcategory = $subcategory;
        $this->minicategory =$minicategory;

    }
    public function get_main_category()
    {
        return view('backend.pages.dashboard.Categories.maincategory');


    }

    public function add_main_category(Request $request)
    {
        $validatedData = $request->validate([
            'main_category' => 'required|min:3|max:50',
            'position' =>'required|unique:maincategories,position',//unique:tablename,column
            ]);
        $this->maincategory->create($validatedData);
        return redirect()->back()->with('success','Main category added');
    }

    public function get_sub_category()
    {
        $maincategory = $this->maincategory->all();
        return view('backend.pages.dashboard.Categories.subcategory',compact('maincategory'));


    }
    public  function add_sub_category(Request $request)
    {
        $validatedData = $request->validate([
            'sub_category' => 'required|min:3|max:50',
            'main_id' =>'required'
        ]);
        $this->subcategory->create($validatedData);
        return redirect()->back()->with('success','Sub category added');


    }
    public function get_mini_category()
    {
        $subcategory = $this->subcategory->all();
        return view('backend.pages.dashboard.Categories.minicategory',compact('subcategory'));

    }
    public  function add_mini_category(Request $request)
    {
        $validatedData = $request->validate([
            'mini_category' => 'required|min:3|max:50',
            'sub_id' =>'required'
        ]);


        $this->minicategory->create($validatedData);
        return redirect()->back()->with('success','Mini category added');


    }
}
