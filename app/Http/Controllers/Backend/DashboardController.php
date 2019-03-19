<?php
namespace App\Http\Controllers\Backend;
use  App\Repositories\BookInterface;
use  App\Repositories\HomesectionInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\banner;
class DashboardController extends Controller
{
    //
    private $book,$section;
    public function __construct(BookInterface $book,HomesectionInterface $section)
    {
        $this->book = $book;
        $this->section=$section;

    }
    public function index(){
        return view('backend.pages.dashboard.dashboard');
    }

    public function banner(){
        $banner=banner::all();
        $i=0;
        return view('backend.pages.dashboard.banner',compact('banner','i'));
    }
    public function createbanner(Request $request){

    $validatedData = $request->validate([
        'image' =>'image|required',
        'image.*' =>'mimes:jpeg,png,bmp,gif,svg',
    ]);

    if($request->hasFile('image')  ){
        $filename = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('public/image',$filename);
        $validatedData['image'] = $filename;
    }

    banner::create($validatedData);
    return redirect()->back()->with('success','Banner added');

}
    public function dropbanner($id){

        $banner=banner::find($id);
        $banner->destroy($id);
        return redirect()->back()->with('success','Banner Destroyed');

    }
    public  function homesection()
    {
        $books = $this->book->all();
        return view('backend.pages.dashboard.homesection',compact('books'));

    }
    public  function showsection()
    {
        $sections=$this->book->getsection();
        $books = $this->book->all();
        $i=0;
        return view('backend.pages.dashboard.showsection',compact('sections','books','i'));

    }
    public  function createsection(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:100',
            'position' => 'required|unique:homesections,position',
            'book_id' =>'required'
            ]);
       $this->section->create($validatedData);
        return redirect()->back()->with('success','Section created');

    }
    public  function editsection($id)
{
    $section=$this->section->sectionget($id);
    $books = $this->book->all();
//        dd($section);
    return view('backend.pages.dashboard.sectionedit',compact('section','books'));

}
    public  function updatesection(Request $request,$id)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:100',
            'position' => 'required',
            'book_id' =>'required'
        ]);
        $section=$this->section->update($validatedData,$id);
        return redirect()->back()->with('success','Section Updated');

    }

    public  function dropsection($id)
    {

        $section=$this->section->delete($id);
        return redirect()->back()->with('success','Section Deleted');

    }


}
