<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use  App\Repositories\BookInterface;
use  App\Repositories\MaincategoryInterface;
use  App\Repositories\MinicategoryInterface;
use App\library;
class libraryController extends Controller
{
    private $book,$maincategory,$minicategory;
    public function __construct(BookInterface $book,MaincategoryInterface $maincategory,MinicategoryInterface $minicategory)
    {
        $this->book = $book;
        $this->maincategory = $maincategory;
        $this->middleware('auth')->except(['add_to_library']);


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
    public function delete_library(Request $request,$id)
    {
        $book = $this->book->find($id);
        $oldlibrary =Session::has('library') ? Session::get('library'):null;
        $library = new Library($oldlibrary);
        $library->delete($id, $book);
        $request->session()->put('library',$library);

        if(!Session::has('library') || Session::get('library')->totalprice == 0){

            return redirect(route('books'))->with('error','No Book Found');
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
