<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use  App\Repositories\BookInterface;
use  App\Repositories\MaincategoryInterface;
use  App\Repositories\MinicategoryInterface;
use  App\Repositories\VendorInterface;
use App\library;
class libraryController extends Controller
{
    private $book,$maincategory,$minicategory,$vendor;
    public function __construct(BookInterface $book,MaincategoryInterface $maincategory,MinicategoryInterface $minicategory,VendorInterface $vendor)
    {
        $this->vendor = $vendor;
        $this->book = $book;
        $this->maincategory = $maincategory;
        $this->middleware('auth')->except(['add_to_library','add_vendor_cart']);


    }
    public function add_to_library(Request $request,$id)
    {
        $book = $this->book->find($id);
        $oldlibrary =Session::has('library') ? Session::get('library'):null;
      // dd($oldlibrary);
        $library = new Library($oldlibrary);
        $library->add($id, $book);

        $request->session()->put('library',$library);

       return redirect()->back()->with('success','Book Added');

    }
    public function add_vendor_cart(Request $request,$id)
    {
        $vendor=$this->vendor->find($id);
        $oldv =Session::has('vendor') ? Session::get('vendor'):null;
        // dd($oldlibrary);
        $newvendor = new Library($oldv);
        $newvendor->add($id, $vendor);


        $request->session()->put('vendor',$newvendor);
        return redirect()->back()->with('success','Book Added');

    }
    public function delete_library(Request $request,$id)
    {
        $book = $this->book->find($id);
        $oldlibrary =Session::has('library') ? Session::get('library'):null;
        $library = new Library($oldlibrary);
        $library->delete($id, $book);
        $request->session()->put('library',$library);

        if(!Session::has('library') || Session::get('library')->totalprice == 0  and !Session::has('vendor') || Session::get('vendor')->totalprice == 0){

            return redirect(route('home'))->with('error','No Book Found');
        }
        return redirect()->back()->with('success','Book Removed');

    }
    public function delete_vendor(Request $request,$id)
    {
        $vendor=$this->vendor->find($id);
        $oldv =Session::has('vendor') ? Session::get('vendor'):null;

        $newvendor = new Library($oldv);
        $newvendor->delete($id, $vendor);
        $request->session()->put('vendor',$newvendor);

        if(!Session::has('library') || Session::get('library')->totalprice == 0 and !Session::has('vendor') || Session::get('vendor')->totalprice == 0){

            return redirect(route('home'))->with('error','No Book Found');
        }
        return redirect()->back()->with('success','Book Removed');

    }

    public function Productcount()
    {
        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        return response()->json(['data' =>$library]);
    }


}
