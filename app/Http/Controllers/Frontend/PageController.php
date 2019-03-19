<?php

namespace App\Http\Controllers\Frontend;

use App\banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use  App\Repositories\BookInterface;
use  App\Repositories\MaincategoryInterface;


class PageController extends Controller
{
    //
    private $book,$maincategory;
    public function __construct(BookInterface $book,MaincategoryInterface $maincategory)
    {
        $this->book = $book;
        $this->maincategory = $maincategory;

    }
    public function index($slug = null){
        switch ($slug) {
            case '':

                $sections=$this->book->getsection();
                $books =$this->book->all();
                $banner = banner::all();
                return view('frontend.index',compact('books','sections','banner'));
                break;

            case 'single-product/{id}':
                return view('frontend.single-product');
                break;

            default:

                if (View::exists('frontend.'.$slug)) {
                    return view('frontend.'.$slug);
                }
        }
        return view('frontend.404');

    }

    public function getbookorderbycate($id)
    {
        $books=$this->book->findbycategory($id);

        return response()->json(['data' =>$books]);

    }


}
