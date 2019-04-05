<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Icon;
use  App\Repositories\MaincategoryInterface;
use App\banner;
use Session;
use App\Library;
use App\Contactinfo;
use  App\Repositories\MinicategoryInterface;
use App\contact;
use App\About;
use  App\Repositories\BookInterface;
class HomepageController extends Controller
{
    private $maincategory,$minicategory,$book;
    public function __construct(BookInterface $book,MaincategoryInterface $maincategory,MinicategoryInterface $minicategory)
    {

        $this->maincategory = $maincategory;
        $this->minicategory = $minicategory;
        $this->book=$book;



    }
    public function search(Request $request)
    {
        $icon=Icon::all()->take(1);

        $categorys = $this->maincategory->takefour();

        $banner = banner::all();

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count=$library->totalQty;

        $this->data('title',$this->make_title('Book Searched'));
        $contact = Contactinfo::all();

        $s = $request->input('search');
        $books=$this->book->search($s);

        return view('frontend.searched',$this->data,compact('icon','banner','categorys','count','books','contact','s'));
    }
    public function contact()
    {
        $icon=Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        $banner = banner::all();

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count=$library->totalQty;

        $this->data('title',$this->make_title('Contacts'));

        $contact = Contactinfo::all();

        return view('frontend.contact',$this->data,compact('icon','banner','categorys','count','contact'));
    }
    public function aboutus()
    {
        $icon=Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        $banner = banner::all();

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count=$library->totalQty;

        $this->data('title',$this->make_title('About us'));
        $contact = Contactinfo::all();

         $abouts = About::all();

        return view('frontend.about',$this->data,compact('icon','banner','categorys','count','abouts','contact'));
    }
    public function Term()
    {
        $icon=Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        $banner = banner::all();

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count=$library->totalQty;

        $this->data('title',$this->make_title('Term&condition'));
        $contact = Contactinfo::all();

        $abouts = About::all();

        return view('frontend.termcondition',$this->data,compact('icon','banner','categorys','count','abouts','contact'));
    }

            public function Privacy()
        {
            $icon=Icon::all()->take(1);
            $categorys = $this->maincategory->takefour();
            $banner = banner::all();

            $oldlibrary =Session::has('library') ? Session::get('library') :'';
            $library = new Library($oldlibrary);
            $count=$library->totalQty;

            $this->data('title',$this->make_title('Privacy&policy'));
            $contact = Contactinfo::all();

            $abouts = About::all();

            return view('frontend.Privacy_policy',$this->data,compact('icon','banner','categorys','count','abouts','contact'));
        }

    public function Plan()
    {
        $icon=Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        $banner = banner::all();

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count=$library->totalQty;

        $this->data('title',$this->make_title('Plan&pricing'));
        $contact = Contactinfo::all();

        $abouts = About::all();

        return view('frontend.plan',$this->data,compact('icon','banner','categorys','count','abouts','contact'));
    }
    public function maincategory($id)
    {
        $icon=Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        $banner = banner::all();

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count=$library->totalQty;

        $this->data('title',$this->make_title('Category'));

        $contact = Contactinfo::all();

        $categorybybook = $this->maincategory->bookbycategory($id);
        $main = $this->maincategory->find($id);
        return view('frontend.category',$this->data,compact('icon','banner','categorys','count','contact','categorybybook','main'));

    }
    public function minicategory($id)
    {
        $icon=Icon::all()->take(1);
        $categorys = $this->maincategory->takefour();
        $banner = banner::all();

        $oldlibrary =Session::has('library') ? Session::get('library') :'';
        $library = new Library($oldlibrary);
        $count=$library->totalQty;

        $this->data('title',$this->make_title('Category'));

        $contact = Contactinfo::all();

        $categorybybook = $this->minicategory->bookbycategory($id);
        $mini = $this->minicategory->find($id);
        return view('frontend.minicategory',$this->data,compact('icon','banner','categorys','count','contact','categorybybook','mini'));

    }
    public function message(Request $request)
    {

        $validateData = $request->validate([
            'firstname'=>'required|min:3|max:15',
            'lastname'=>'required|min:3|max:15',
            'email'=>'required',
            'website'=>'required|url',
            'subject'=>'required|min:3|max:200',
            'message'=>'required|min:3|max:500'
        ]);
        contact::create($validateData);
        return redirect()->back()->with('success', 'Message sent');
    }
}
