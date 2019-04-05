<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MaincategoryInterface;
use App\Repositories\SubcategoryInterface;
use App\Repositories\MinicategoryInterface;
use Illuminate\Validation\Rule;
use App\Icon;
class CategoryController extends Controller
{
    private $maincategory,$subcategory,$minicategory;
    public function __construct(MaincategoryInterface $maincategory,SubcategoryInterface $subcategory,MinicategoryInterface $minicategory)
    {
        $this->maincategory = $maincategory;
        $this->subcategory = $subcategory;
        $this->minicategory =$minicategory;
//        $this->middleware('auth:admin');


    }
    //main category
    public function get_main_category()
    {
        $maincategory = $this->maincategory->getmaincategory();
        $i=0;
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add MainCategory'));
        return view('backend.pages.dashboard.Categories.maincategory',$this->data,compact('maincategory','i','icons'));


    }
    public function status_main_category($id)
    {
        $status= $this->maincategory->conformed($id);
        return redirect()->back()->with('success','Status updated');

    }
    public function edit_main_category($id)
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Edit MainCategory'));
        $maincategory= $this->maincategory->find($id);
        return view('backend.pages.dashboard.Categories.editmaincategory',$this->data,compact('maincategory','icons'));


    }
    public function update_main_category(Request $request,$id)
    {
        $validatedData = $request->validate([
            'main_category' => 'required|min:3|max:50',
            'position' =>['required',Rule::unique('maincategories','position')->ignore($id)],//unique:tablename,column
        ]);
        $maincategory= $this->maincategory->update($validatedData,$id);
        return redirect(route('main.category'))->with('success','Main-category Updated');


    }

    public function add_main_category(Request $request)
    {
        $validatedData = $request->validate([
            'main_category' => 'required|min:3|max:50',
            'position' =>'required|unique:maincategories,position',//unique:tablename,column
            ]);
        $this->maincategory->create($validatedData);
        return redirect()->back()->with('success','Main-category added');
    }

    public function delete_main_category($id)
    {
       return $this->maincategory->delete($id);
    }
//end main category
//sub catgory
    public function get_sub_category()
    {
        $maincategory = $this->maincategory->all();//get all main category status 1
        $subcategory = $this->subcategory->paginate(10);//get all sub category status 1 and 1
        $i=0;
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add SubCategory'));
        return view('backend.pages.dashboard.Categories.subcategory',$this->data,compact('maincategory','icons','i','subcategory'));
    }


    public function status_sub_category($id)
    {
       return $this->subcategory->conformed($id);

    }

    public function edit_sub_category($id)
    {
        $maincategory = $this->maincategory->all();//get all main category status 1
        $subcategory = $this->subcategory->find($id);
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Edit subCategory'));
        return view('backend.pages.dashboard.Categories.editsubcategory',$this->data,compact('maincategory','subcategory','icons'));
    }

    public function delete_sub_category($id)
    {
        return $this->subcategory->delete($id);
    }

    public  function update_sub_category(Request $request,$id)
    {
        $validatedData = $request->validate([
            'sub_category' => 'required|min:3|max:50',
            'main_id' =>'required',
            'price' =>'required',
            'expire_date' =>'required'

        ]);
        $this->subcategory->update($validatedData,$id);
        return redirect(route('sub.category'))->with('success','Sub category updated');

    }

    public  function add_sub_category(Request $request)
    {
        $validatedData = $request->validate([
            'sub_category' => 'required|min:3|max:50',
            'main_id' =>'required',
            'price' =>'required',
            'expire_date' =>'required'
        ]);

        $this->subcategory->create($validatedData);
        return redirect()->back()->with('success','Sub category added');

    }
    //end sub category
    //mini category

    public function get_mini_category()
    {
        $subcategory = $this->subcategory->all();
        $minicategory = $this->minicategory->paginate(10);
        $i=0;
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add MiniCategory'));
        return view('backend.pages.dashboard.Categories.minicategory',$this->data,compact('subcategory','icons','minicategory','i'));

    }
    public  function add_mini_category(Request $request)
    {
        $validatedData = $request->validate([
            'mini_category' => 'required|min:3|max:50',
            'sub_id' =>'required',
            'price' =>'required',
            'expire_date' =>'required'


        ]);
        $this->minicategory->create($validatedData);
        return redirect()->back()->with('success','Mini category added');
    }
    public function status_mini_category($id)
    {
        return $this->minicategory->conformed($id);

    }
    public function delete_mini_category($id)
    {
        return $this->minicategory->delete($id);
    }

    public function edit_mini_category($id)
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add MainCategory'));
        $subcategory = $this->subcategory->all();
        $minicategory = $this->minicategory->find($id);
        return view('backend.pages.dashboard.Categories.editminicategory',$this->data,compact('icons','subcategory','minicategory'));


    }
    public  function update_mini_category(Request $request,$id)
    {
        $validatedData = $request->validate([
            'mini_category' => 'required|min:3|max:50',
            'sub_id' =>'required',
            'price' =>'required',
            'expire_date' =>'required'

        ]);
        $this->minicategory->update($validatedData,$id);
        return redirect(route('mini.category'))->with('success','Mini category updated');
    }
}
