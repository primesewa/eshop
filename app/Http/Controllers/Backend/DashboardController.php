<?php
namespace App\Http\Controllers\Backend;
use App\Book;
use  App\Repositories\BookInterface;
use  App\Repositories\HomesectionInterface;
use Illuminate\Validation\Rule;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\banner;
use App\Contactinfo;
use App\Icon;
use App\contact;
use App\About;
use App\Demo;
use Illuminate\Support\Facades\File;
use App\Vendor;
use App\Repositories\VendorsectionInterface;
use App\Order;
use App\Subcategoryorder;
use App\Minicategoryorder;
use App\User;
class DashboardController extends Controller
{
    //
    private $book,$section,$vsection;
    public function __construct(BookInterface $book,HomesectionInterface $section,VendorsectionInterface $vsection)
    {
        $this->book = $book;
        $this->section= $section;
        $this->vsection = $vsection;
//       $this->middleware('auth:admin');

    }
    public function index(){
        $icons = Icon::all()->take(1);
        $count_contact = count(contact::all());
        $count_books = count($this->book->all());
        $c1 = count(Order::all());
        $c2 = count(Subcategoryorder::all());
        $c3 = count(Minicategoryorder::all());
        $total_order = $c1+$c2+$c3;
        $count_user = count(User::all());
        $this->data('title',$this->make_title('Wellcome Dashboard'));
        return view('backend.pages.dashboard.dashboard',$this->data,compact('icons','count_contact','count_books','total_order','count_user'));
    }

        public function tag()
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add a Tag'));
        $books = $this->book->all();
        $tags = Tag::all();
        return view('backend.pages.dashboard.products.tag',$this->data,compact('icons','books','tags'));
    }
    public function tag_store(Request $request)
    {
        $validateData= $request->validate([
            'book_id' => 'required',
            'tag' => 'required'
        ]);
        $validateData['tag'] =implode(",",$request->input('tag'));
        Tag::create($validateData);
        return redirect()->back()->with('success','Tag Added');
    }
    public function tag_update(Request $request,$id)
    {
        $validateData= $request->validate([
            'book_id' => 'required',
            'tag' => 'required'
        ]);
        $validateData['tag'] =implode(",",$request->input('tag'));
        $tag=Tag::find($id);
        $tag->update($validateData);
        return redirect()->route('tag')->with('success','Tag updated');
    }
    public function tag_delete($id)
    {
        $tag = Tag::find($id);
        $tag->destroy($id);

        return redirect()->back()->with('success','Tag Deleted');

    }

    public function tag_edit($id)
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add a Tag'));
        $books = $this->book->all();
        $tag = Tag::find($id);
        return view('backend.pages.dashboard.products.tagedit',$this->data,compact('icons','books','tag'));

    }


    public function banner(){
        $banner=banner::all();
        $i=0;
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Banner'));
        return view('backend.pages.dashboard.banner',$this->data,compact('banner','i','icons'));
    }

    public function createbanner(Request $request){

    $validatedData = $request->validate([
        'image' =>'image|required',
        'image.*' =>'mimes:jpeg,png,bmp,gif,svg',
        'title' =>'required|min:3|max:100'
    ]);

    if($request->hasFile('image')  ){
        $filename = $request->file('image')->getClientOriginalName();
        $file = public_path("storage/image/".$filename);
        if (File::exists($file))
        {
            return redirect()->back()->with('error', 'Image Exist,Please Rename The Image Or Add Another Image');
        }
        $path = $request->file('image')->storeAs('public/image',$filename);
        $validatedData['image'] = $filename;
    }

    banner::create($validatedData);
    return redirect()->back()->with('success','Banner added');

}
    public function dropbanner($id){
        $banner=banner::find($id);
        $ifile = public_path("storage/image/".$banner->image);
        if (File::exists($ifile))
        {
            File::delete($ifile);
        }
        $banner=banner::find($id);
        $banner->destroy($id);
        return redirect()->back()->with('success','Banner Destroyed');

    }
    public  function homesection()
    {
        $books = $this->book->all();
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Section'));
        return view('backend.pages.dashboard.homesection',$this->data,compact('books','icons'));

    }
    public  function showsection()
    {
        $sections=$this->book->getsection();
        $books = $this->book->all();
        $i=0;
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Section'));
        return view('backend.pages.dashboard.showsection',$this->data,compact('sections','books','i','icons'));

    }
    public  function createsection(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:50',
            'description' => 'nullable|min:3|max:100',
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
      // dd($section);
    $icons = Icon::all()->take(1);
    $this->data('title',$this->make_title('Edit Section'));
    return view('backend.pages.dashboard.sectionedit',$this->data,compact('section','books','icons'));

}
    public  function updatesection(Request $request,$id)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:50',
            'description' => 'nullable|min:3|max:100',
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

    public  function Contactinfo()
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Contact-Info'));
        return view('backend.pages.dashboard.contactinfo',$this->data,compact('icons'));

    }
    public  function Contactedit()
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Edit Contact-Info'));
        return view('backend.pages.dashboard.editcontact',$this->data,compact('icons'));

    }
    public  function showcontact()
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('show Contact-Info'));
        $contacts = Contactinfo::all();
        $i=0;
        return view('backend.pages.dashboard.showcontact',$this->data,compact('icons','contacts','i'));

    }
    public  function Contact_store(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required|min:3|max:20',
             'phonenumber' => 'required|min:3|max:15',
            'email' => 'required|min:3|max:30',
            'name'  => 'required|min:3|max:30',
            'facebook' => 'required|min:3|max:50',
            'twitter' => 'required|min:3|max:50',
            'gmail' => 'required|min:3|max:50',
            'youtube' => 'required|min:3|max:50',
            'linkedin' => 'required|min:3|max:50',
            'about_us' => 'required|min:3|max:500',
            'office_info' => 'required|min:3|max:500',
            'introduction' =>'required|min:3|max:500'
        ]);
        Contactinfo::create($validatedData);
        return redirect()->back()->with('success','Contact Info Added');
    }

    public  function contact_message()
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Show Contact'));
        $messages = contact::all();
        return view('backend.pages.dashboard.messages',$this->data,compact('icons','messages'));

    }
    public function about()
    {
        $icons = Icon::all()->take(1);
        $about = About::all();
        $this->data('title',$this->make_title('About us pages'));
        return view('backend.pages.dashboard.footer.about',$this->data,compact('icons','about'));
    }
    public function about_edit($id)
    {
        $icons = Icon::all()->take(1);
        $about = About::find($id);
        $this->data('title',$this->make_title('About us pages'));
        return view('backend.pages.dashboard.footer.editabout',$this->data,compact('icons','about'));
    }
    public function about_store(Request $request)
    {
        $valadateDate = $request->validate([
           'title' => 'required|min:3|max:200',
           'description' =>'required|min:3|max:500',
            'status' =>'required|unique:abouts,status'
        ]);
        About::create($valadateDate);
        return redirect()->back()->with('success','Data added');

    }
    public function about_update(Request $request,$id)
    {
        $valadateDate = $request->validate([
            'title' => 'required|min:3|max:200',
            'description' =>'min:3|max:500',
            'status' =>['required',Rule::unique('abouts','status')->ignore($id)],

        ]);
        $about=About::find($id);
        $about->update($valadateDate);
        return redirect()->route('aboutus')->with('success','Data added');

    }
    public function about_delete($id)
    {
        $about = About::find($id);
        $about->delete($id);
        return redirect()->back()->with('success','Data Deleted');

    }

    public function demo()
    {
        $demos = Demo::all();
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add a Demo Book'));

        return view('backend.pages.dashboard.products.demo',$this->data,compact('icons','demos'));
    }
    public function demo_store(Request $request)
    {
        $valadateDate = $request->validate([
            'title' => 'required|min:3|max:200',
            'file' =>'required'
        ]);
        $file = public_path("storage/file/{$request->file}");

        if (File::exists($file))
        {
            return redirect()->back()->with('error','File Exist, Please Select Another Or Rename The File');
        }
        Demo::create($valadateDate);
        return redirect()->back()->with('success','Demo File Added');

    }
    public function demo_delete($id)
    {

        $demo = Demo::find($id);

        $file = public_path("storage/file/{$demo->file}");
      //  dd($file);
        if (File::exists($file))
        {
            File::delete($file);
        }
        $demo->delete($id);
        return redirect()->back()->with('success','Data Deleted');


    }
    public function vendorsection()
    {
        $vendors = Vendor::all();
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Vendor'));
        return view('backend.pages.dashboard.vendor',$this->data,compact('icons','vendors'));




    }
    public function vendorsection_store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|min:3|max:50',
            'description' => 'min:3|max:100|nullable',
            'vendor_id' =>'required'
        ]);

        $validatedData['vendor_id'] = implode(",",$request->input('vendor_id'));
        $this->vsection->create($validatedData);
        return redirect()->back()->with('success','Vendor Added');



    }

    public function vendorsection_show()
    {
        $vendors = Vendor::all();
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Vendor'));
        $sections = $this->vsection->all();
        $i =0;
        return view('backend.pages.dashboard.vendorshow',$this->data,compact('icons','vendors','sections','i'));

    }

    public function vendorsection_delete($id)
    {
        $sections = $this->vsection->delete($id);
        return redirect()->back()->with('success','Vendor Deleted');

    }

    public function vendorsection_edit($id)
    {
        $s= $this->vsection->find($id);
//        dd($section);
        $vendors = Vendor::all();
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Add Vendor'));
        return view('backend.pages.dashboard.editvendor',$this->data,compact('icons','vendors','s'));


    }

    public function vendorsection_update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:50',
            'description' => 'nullable|min:3|max:100',
            'vendor_id' =>'required'
        ]);

        $validatedData['vendor_id'] = implode(",",$request->input('vendor_id'));

        $this->vsection->update($validatedData,$id);
        return redirect()->route('vendor.section.show')->with('success','Vendor Added');


    }

    public  function book_search(Request $request)
    {
        $s =$request->input('search');
        $icons = Icon::all()->take(1);
        $books = $this->book->search($s);
        $this->data('title',$this->make_title('Book Searched'));
        $i=0;
        return view('backend.pages.dashboard.products.booksearch',$this->data,compact('icons','books','s','i'));


    }

    }
