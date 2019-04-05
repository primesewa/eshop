<?php

namespace App\Http\Controllers\Frontend;

use App\banner;
use App\Demo;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  App\Repositories\BookInterface;
use  App\Repositories\MaincategoryInterface;
use  App\Repositories\MinicategoryInterface;
use phpDocumentor\Reflection\Types\Null_;
use Session;
use App\Library;
use App\Userpic;
use Auth;
use App\Icon;
Use App\Contactinfo;

class PageController extends Controller
{
    //
    private $book,$maincategory,$minicategory;
    public function __construct(BookInterface $book,MaincategoryInterface $maincategory,MinicategoryInterface $minicategory)
    {
        $this->book = $book;
        $this->maincategory = $maincategory;

        $this->middleware('auth')->except(['index','show']);

    }
    public function index(){
        $icon=Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        $banner = banner::all();
        $sections=$this->book->getsection();
        $books =$this->book->all();

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count=$library->totalQty;
        $this->data('title',$this->make_title('Home | e-library in Nepal'));

        $contact = Contactinfo::all();
        return view('frontend.index',$this->data,compact('books','sections','banner','categorys','count','icon','contact'));
    }



public function show($id)
{
    $demo = Demo::all()->take(1);

    $icon=Icon::all()->take(1);
    $categorys = $this->maincategory->takefour();
    $relatedbooks =$this->book->related($id);
    $categorylist = $this->maincategory->categorybycount();
    $book =$this->book->find($id);
    $tags = Tag::where('book_id','=',$id)->get();


    $this->data('title',$this->make_title('Book | e-library in Nepal'));

    $oldlibrary =Session::has('library') ? Session::get('library') :'';
    $library = new Library($oldlibrary);
    $count=$library->totalQty;

    $contact = Contactinfo::all();
    return view('frontend.single-product',$this->data,compact('book','tags','categorys','count','icon','categorylist','relatedbooks','contact','demo'));
}
    public function getbookorderbycate($id)
    {
        $books=$this->book->findbycategory($id);

        return response()->json(['data' =>$books]);

    }
    public function pending()
    {
        $icon=Icon::all()->take(1);

        if(!Session::has('library') || Session::get('library')->totalprice == 0){

            return redirect('/')->with('error','No Book Found');
        }
        $this->data('title',$this->make_title('Pending Books'));

        $categorys = $this->maincategory->takefour();
        $banner = banner::all();
        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $librarys = new Library($oldlibrary);
//        dd($librarys);
        $count=$librarys->totalQty;
        return view('frontend.pending',$this->data,['librarys'=>$librarys->items,'totalprice'=>$librarys->totalprice,'totalqty'=>$librarys->totalQty],compact('categorys','count'))->with('icon',$icon);
    }
    public  function userpic(Request $request)
    {
       // dd($request->input('image'));
        $validatedData = $request->validate([
            'image' =>'required',
            'image.*' =>'image,mimes:jpeg,png,bmp,gif,svg',
        ]);
        if($request->hasFile('image') ){
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/image',$image);
            $validatedData['image'] = $image;
        }
        Userpic::create([
            'user_id'=>Auth::user()->id,
            'image'=> $validatedData['image']
    ]);
        return redirect()->back()->with('success', 'Pic Uploaded');

    }
    public  function updatepic(Request $request,$id)
    {
        // dd($request->input('image'));
        $validatedData = $request->validate([
            'image' =>'required',
            'image.*' =>'image,mimes:jpeg,png,bmp,gif,svg',
        ]);
        if($request->hasFile('image') ){

            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('public/image',$image);
            $validatedData['image'] = $image;
        }

        $pic = Userpic::find($id);
         $pic->update($validatedData);
        return redirect()->back()->with('success', 'Pic Updated');

    }
    public  function profile()
    {
        $icon=Icon::all()->take(1);
        $this->data('title',$this->make_title('Profile'));
        return view('frontend.profile',$this->data,compact('icon'));
    }

    public  function mylibrary ()
    {
        $books =$this->book->all();
        $orders = Auth::user()->orders;
        $this->data('title',$this->make_title('My Library'));
        $orders->transform(function($order, $key) {
            $order->library = unserialize($order->library);
            return $order;
        });
//        foreach ($orders as $order)
//        {
//            dd($order->library);
//        }
        $icon=Icon::all()->take(1);

        return view('frontend.mylibrary',$this->data,compact('books','orders','icon'));

    }
    public  function expire()
    {
        $books =$this->book->all();
        $icon=Icon::all()->take(1);
        $books =$this->book->all();
        $orders = Auth::user()->orders;
        $this->data('title',$this->make_title('My Library'));
        $orders->transform(function($order, $key) {
            $order->library = unserialize($order->library);
            return $order;
        });
        $this->data('title',$this->make_title('Expire'));
        return view('frontend.expire',$this->data,compact('icon','orders','books'));

    }
    public  function setting()
    {
        $icon=Icon::all()->take(1);
        $this->data('title',$this->make_title('Settings'));
        return view('frontend.setting',$this->data,compact('icon'));

    }
    public  function billing()
    {

        $orders = Auth::user()->orders;
        $icon=Icon::all()->take(1);
        $this->data('title',$this->make_title('My Billing'));
        $orders->transform(function($order, $key) {
            $order->library = unserialize($order->library);
            return $order;
        });

        return view('frontend.billing',$this->data,compact('orders','icon'));

    }
    public function openbook($id)
    {
        $this->data('title',$this->make_title(' My Book'));
        $book=$this->book->find($id);
        $icon=Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        return view('frontend.openbook',$this->data,compact('book','icon','categorys'));

    }
    public function archive()
    {
        $this->data('title',$this->make_title('Buy category'));
        $icon=Icon::all()->take(1);
        return view('frontend.archive',$this->data,compact('icon'));

    }
    public function folder()
    {
        $subcategorys = $this->subcategory->all();
        $minicategorys = $this->minicategory->all();

        $this->data('title',$this->make_title('Buy category'));
        $icon=Icon::all()->take(1);
        return view('frontend.folder',$this->data,compact('icon'));

    }




}
