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
use  App\Repositories\SubcategoryInterface;
use phpDocumentor\Reflection\Types\Null_;
use Session;
use App\Library;
use App\Userpic;
use Auth;
use App\Icon;
Use App\Contactinfo;
use App\Subcategoryorder;
use  App\Repositories\VendorsectionInterface;
use App\Vendor;
use Illuminate\Support\Facades\File;
use App\About;
class PageController extends Controller
{
    //
    private $book,$maincategory,$minicategory,$subcategory,$vsection;
    public function __construct(BookInterface $book,MaincategoryInterface $maincategory,MinicategoryInterface $minicategory,SubcategoryInterface $subcategory, VendorsectionInterface $vsection)
    {
        $this->book = $book;
        $this->maincategory = $maincategory;
        $this->subcategory = $subcategory;
        $this->minicategory =$minicategory;
        $this->vsection = $vsection;
        $this->middleware('auth')->except(['index','show']);

    }
    public function index(){
        $icon=Icon::all()->take(1);
        $vsections = $this->vsection->all();
        $vendors = Vendor::all();
        $categorys = $this->maincategory->takefour();
        $banner = banner::all();
        $sections=$this->book->getsection();
        $books =$this->book->all();

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count1=$library->totalQty;

        $oldvendor =Session::has('vendor') ? Session::get('vendor') :'';
        $newvendor = new Library($oldvendor);
        $count2=$newvendor->totalQty;
        $count = $count1+$count2;

        $this->data('title',$this->make_title('Home | e-library in Nepal'));

        $contact = Contactinfo::all();
        $abouts = About::all();
        return view('frontend.index',$this->data,compact('books','sections','banner','categorys','count','icon','contact','vsections','vendors','abouts'));
    }



public function show($id)
{
    $book =$this->book->find($id);
    if(isset($book)) {
        $demo = Demo::inRandomOrder()->take(1)->get();
        foreach ($demo as $d)
        {
           $x= $d->file;
        }

        $icon = Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        $relatedbooks = $this->book->related($id);
        $categorylist = $this->maincategory->categorybycount();

        $tags = Tag::where('book_id', '=', $id)->get();


        $this->data('title', $this->make_title('Book | e-library in Nepal'));

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count1=$library->totalQty;

        $oldvendor =Session::has('vendor') ? Session::get('vendor') :'';
        $newvendor = new Library($oldvendor);
        $count2=$newvendor->totalQty;
        $count = $count1+$count2;
        $abouts = About::all();


        $contact = Contactinfo::all();

        return view('frontend.single-product', $this->data, compact('book','abouts', 'tags', 'categorys', 'count', 'icon', 'categorylist', 'relatedbooks', 'contact', 'x'));
    }
    else
        {
            return redirect()->back();
        }
}
    public function getbookorderbycate($id)
    {
        $books=$this->book->findbycategory($id);

        return response()->json(['data' =>$books]);

    }
    public function pending()
    {
        $icon=Icon::all()->take(1);

        if(!Session::has('library') || Session::get('library')->totalprice == 0 and !Session::has('vendor') || Session::get('vendor')->totalprice == 0 ){
            Session::flash('error', 'No Book Found');
            return redirect()->route('home');
        }
        $this->data('title',$this->make_title('Pending Books'));

        $categorys = $this->maincategory->takefour();
        $banner = banner::all();
        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $librarys = new Library($oldlibrary);

        $oldvendor =Session::has('vendor') ? Session::get('vendor') :'';
        $newvendor = new Library($oldvendor);
//        dd($librarys);

       return view('frontend.pending',$this->data,['librarys'=>$librarys->items,'vendors' => $newvendor->items,'totalprice'=>$librarys->totalprice,'totalprice_vendor'=>$newvendor->totalprice,'totalqty'=>$librarys->totalQty,'totalqty_vendor'=>$newvendor->totalQty],compact('categorys'))->with('icon',$icon);
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
            $file = public_path("storage/image/".$image);
            if (File::exists($file))
            {
                return redirect()->back()->with('error', 'Image Exist,Please Rename The Image Or Add Another Image');
            }

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
        $pic = Userpic::find($id);
        $validatedData = $request->validate([
            'image' =>'required',
            'image.*' =>'image,mimes:jpeg,png,bmp,gif,svg',
        ]);
        if($request->hasFile('image') ){

            $image = $request->file('image')->getClientOriginalName();
            $ifile = public_path("storage/image/".$pic->image);
            if (File::exists($ifile))
            {
                File::delete($ifile);
            }
            $path = $request->file('image')->storeAs('public/image',$image);
            $validatedData['image'] = $image;
        }

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
        $vorders =Auth::user()->vorders;
        $vorders->transform(function($vorder, $key) {
            $vorder->vendor = unserialize($vorder->vendor);
            return $vorder;
        });
        $icon=Icon::all()->take(1);

        return view('frontend.mylibrary',$this->data,compact('books','orders','icon','vorders'));

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

        $vorders =Auth::user()->vorders;
        $vorders->transform(function($vorder, $key) {
            $vorder->vendor = unserialize($vorder->vendor);
            return $vorder;
        });

        return view('frontend.expire',$this->data,compact('icon','orders','books','vorders'));

    }
    public  function setting()
    {
        $icon=Icon::all()->take(1);
        $sewa_acc = Auth::user()->sewa;
//        dd($sewa_acc);
        $this->data('title',$this->make_title('Settings'));
        return view('frontend.setting',$this->data,compact('icon','sewa_acc'));

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
        $vorders =Auth::user()->vorders;
        $vorders->transform(function($vorder, $key) {
            $vorder->vendor = unserialize($vorder->vendor);
            return $vorder;
        });
//dd($vorders);
        return view('frontend.billing',$this->data,compact('orders','icon','vorders'));

    }
    public function openbook($id)
    {
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key) {
            $order->library = unserialize($order->library);
            return $order;
        });
//        dd($orders);
        foreach($orders as $order)
        {
            foreach($order->library->items as $item)
            {
                if($item['item']['id'] == $id and $item['expire_at']>= date("y/m/d"))
                {
                    $book=$this->book->find($id);
                }

            }
        }
        if(!isset($book))
        {
         return redirect()->route('home');
        }
        $this->data('title',$this->make_title(' My Book'));
        $icon=Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        return view('frontend.openbook',$this->data,compact('book','icon','categorys'));

    }
    public function archive()
    {

        $subcategorys = $this->subcategory->paginate(10);
        $minicategorys = $this->minicategory->paginate(10);
        $this->data('title',$this->make_title('Buy category'));
        $icon=Icon::all()->take(1);
        return view('frontend.archive',$this->data,compact('icon','subcategorys','minicategorys'));

    }
    public  function archive_subcategory($id)
    {
        $books=$this->book->all();
        $subcategory = $this->subcategory->find($id);
        $this->data('title',$this->make_title('Buy category'));
        $icon=Icon::all()->take(1);
        return view('frontend.subarchive',$this->data,compact('icon','books','subcategory'));

    }
    public function archive_mimicategory($id)
    {
        $books=$this->book->all();
        $minicategory = $this->minicategory->find($id);
        $this->data('title',$this->make_title('Buy category'));
        $icon=Icon::all()->take(1);
        return view('frontend.miniarchive',$this->data,compact('icon','books','minicategory'));

    }
    public function folder()
    {
       $suborders = Auth::user()->suborders()->paginate(1);
        $books=$this->book->all();
       $miniorder = Auth::user()->miniorders()->paginate(1);
        $subcategory = $this->subcategory->all();
        $minicategory = $this->minicategory->all();
        $this->data('title',$this->make_title('Sub-category'));
        $icon=Icon::all()->take(1);
        return view('frontend.folder',$this->data,compact('icon','books','suborders','subcategory','minicategory','miniorder'));

    }
    public function mini_folder()
    {

        $books=$this->book->all();
        $miniorder = Auth::user()->miniorders()->paginate(1);
        $minicategory = $this->minicategory->all();
        $this->data('title',$this->make_title('Mini-category'));
        $icon=Icon::all()->take(1);
        return view('frontend.mini_folder',$this->data,compact('icon','books','minicategory','miniorder'));
    }

    public function open_sub_book($id)
    {

            foreach (Auth::user()->suborders as $sub)
            {
                $subbook=$this->book->find($id);
                if(isset($subbook)) {
                    if ($subbook->sub_id == $sub->sub_id and $sub->expire_date >= date("y/m/d")) {
                        $book = $subbook;
                    }
                }
                else
                {
                    return redirect()->route('my.category');

                }



            }
        if(isset($book)) {
            return view('frontend.openbook',$this->data,compact('book'));

        }
        else{
            return redirect()->route('my.category');
        }



    }

    public function open_mini_book($id)
    {

            foreach (Auth::user()->miniorders as $mini)
            {
                $subbook=$this->book->find($id);
                if(isset($subbook)) {
                    if ($subbook->mini_id == $mini->mini_id and $mini->expire_date >= date("y/m/d")) {
                        $book = $subbook;
                    }
                    }
                    else
                    {
                        return redirect()->route('mini.category');

                    }


            }
        if(isset($book)) {
            return view('frontend.openbook',$this->data,compact('book'));


        }
        else{
            return redirect()->route('mini.category');
        }


    }
    public  function sell_book()
    {
        $icon=Icon::all()->take(1);
        $maincategory=$this->maincategory->all();
        $this->data('title',$this->make_title('Sell Books'));
        return view('frontend.sellbook',$this->data,compact('icon','maincategory'));

    }
    public function mybook()
    {
        $icon=Icon::all()->take(1);
        $this->data('title',$this->make_title('My books'));
        return view('frontend.user_book',$this->data,compact('icon'));

    }

    public function mybook_delete($id)
    {
        $vbook=Auth::user()->vendor()->find($id);

        $ifile = public_path("storage/image/$vbook->Image");

        if (File::exists($ifile))
        {
            File::delete($ifile);
        }
        $file = public_path("storage/file/$vbook->file");

        if (File::exists($file))
        {
            File::delete($file);
        }
        $vbook->delete($id);
        return redirect()->back()->with('success','Your Book is Beleted');
    }
    public function mybook_edit($id)
    {
        $book=Auth::user()->vendor()->find($id);
        $books = Vendor::all();
        $maincategory=$this->maincategory->all();
        $subcategory=$this->subcategory->all();
        $minicategory=$this->minicategory->all();
        $icon=Icon::all()->take(1);
        $this->data('title',$this->make_title('Edit User Book'));

        return view('frontend.userbook_edit',$this->data,compact('icon','maincategory','minicategory','subcategory','book','books'));



    }

    public function demo()
    {
        $demo = Demo::inRandomOrder()->take(1)->get();
        foreach ($demo as $d)
        {
            $x = $d->file;
        }
        return response()->json([
            'name' => $x
        ]);
    }

}
