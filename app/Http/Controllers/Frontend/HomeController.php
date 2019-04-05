<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use  App\Repositories\BookInterface;
use  App\Repositories\MaincategoryInterface;
use  App\Repositories\MinicategoryInterface;
use  App\banner;
use Session;
use App\Library;
use App\Icon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $book,$maincategory,$minicategory;
    public function __construct(BookInterface $book,MaincategoryInterface $maincategory)
    {
        $this->middleware('auth');
        $this->book = $book;
        $this->maincategory = $maincategory;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categorys = $this->maincategory->takefour();
        $banner = banner::all();
        $sections=$this->book->getsection();
        $icon=Icon::all()->take(1);
        $books =$this->book->all();
        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count=$library->totalQty;
        $this->data('title',$this->make_title('Home'));
        return view('frontend.home',$this->data,compact('categorys','banner','sections','count','books','icon'));
    }

}
