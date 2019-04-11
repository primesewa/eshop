<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Repositories\BookInterface;
use App\Repositories\MaincategoryInterface;
use App\Repositories\subcategoryInterface;
use App\Repositories\minicategoryInterface;
use Illuminate\Support\Facades\Storage;
use App\Icon;
use Illuminate\Support\Facades\File;
use App\Fakevendor;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $book,$maincategory,$subcategory,$minicategory;
    public function __construct(BookInterface $book,MaincategoryInterface $maincategory,SubcategoryInterface $subcategory,MinicategoryInterface $minicategory)
    {
        $this->book = $book;
        $this->maincategory = $maincategory;
        $this->subcategory = $subcategory;
        $this->minicategory =$minicategory;
//        $this->middleware('auth:admin');

    }

    public function index()
    {
        $books = $this->book->paginate();
        $i=0;
        $icons = Icon::all()->take(1);
        $icon = Icon::all();
        $this->data('title',$this->make_title('Show Books'));
        return view('backend.pages.dashboard.products.showbook',$this->data,compact('books','i','icons','icon'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $icons = Icon::all()->take(1);
        $maincategory=$this->maincategory->all();
        $this->data('title',$this->make_title('Add Books'));
        $vendors = Fakevendor::all();
        return view('backend.pages.dashboard.products.addbooks',$this->data,compact('maincategory','icons','vendors'));

    }
    public function getsubcategory($id)
{

    $subcategory =$this->subcategory->getsubcategory($id);
    return $subcategory;
}
    public function getminicategory($id)
    {

        $minicategory = $this->minicategory->getminicategory($id);
        return $minicategory;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'Title' => 'required|min:3|max:50',
            'Author' => 'required|min:3|max:50',
            'Description' => 'required|min:3|max:200',
            'main_id' => 'required',
            'sub_id' => 'required',
            'mini_id' => 'required',
            'Main_price' => 'required|min:2|max:7|alpha_num',
            'Discount_price' => 'required|min:2|max:7|alpha_num',
            'Image' =>'image|required',
            'Image.*' =>'mimes:jpeg,png,bmp,gif,svg',
            'file' => 'file|required',
            'file.*' =>'mimes:doc,pdf,docx,zip',
            'currency' =>'required',
            'feature' =>'required',
            'expire_date' =>'required',
            'tag' =>'required',
            'name' => 'required|min:3|max:50',
        ]);
        $validatedData['tag'] =implode(",",$request->input('tag'));
        if($request->hasFile('Image') and $request->hasFile('file')){
           //for one image
            $image = $request->file('Image')->getClientOriginalName();
            $file = public_path("storage/image/".$image);

            if (File::exists($file))
            {
                return redirect()->back()->with('error', 'Image Exist,Please Rename The Image Or Add Another Image');
            }
            $path = $request->file('Image')->storeAs('public/image',$image);
            $validatedData['Image'] = $image;
            //for one file
            $file = $request->file('file')->getClientOriginalName();
            $file1 = public_path("storage/file/". $file);

            if (File::exists($file1))
            {
                return redirect()->back()->with('error', 'File Exist,Please Rename The File Or Add Another File');
            }
            $path = $request->file('file')->storeAs('public/file',$file);
            $validatedData['file'] = $file;

        }


        $this->book->create($validatedData);
        return redirect()->back()->with('success', 'Book Added');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book=$this->book->find($id);
        $books=$this->book->all();

        $maincategory=$this->maincategory->all();
        $subcategory=$this->subcategory->all();
        $minicategory=$this->minicategory->all();
        $icons = Icon::all()->take(1);
        $vendors = Fakevendor::all();

        $this->data('title',$this->make_title('Add Books'));

        return view('backend.pages.dashboard.products.editbooks',$this->data,compact('book','maincategory','subcategory','minicategory','icons','books','vendors'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Title' => 'required|min:3|max:50',
            'Author' => 'required|min:3|max:50',
            'Description' => 'min:3|max:200',
            'main_id' => 'required|min:1|max:50',
            'sub_id' => 'required|min:1|max:50',
            'mini_id' => 'required|min:1|max:50',
            'Main_price' => 'required|min:2|max:7|alpha_num',
            'Discount_price' => 'required|min:2|max:7|alpha_num',
            'Image' =>'image',
            'Image.*' =>'mimes:jpeg,png,bmp,gif,svg',

            'file' => 'file',
            'file.*' =>'mimes:doc,pdf,docx,zip',
            'currency' =>'',
            'feature' =>'',
            'expire_date' =>'',
            'tag' =>'required',
            'name' => 'required|min:3|max:50',


        ]);
        $book=$this->book->find($id);

        /**
         * @param $validatedData
         */
        $validatedData['tag'] =implode(",",$request->input('tag'));
        if($request->hasFile('Image')){
            $ifile = public_path("storage/image/".$book->Image);
            if (File::exists($ifile))
            {
                File::delete($ifile);
            }

            $image = $request->file('Image')->getClientOriginalName();

            $path = $request->file('Image')->storeAs('public/image',$image);
            $validatedData['Image']=$image;
        }

        if($request->hasFile('file')){
            $file1 = public_path("storage/file/".$book->file);
            if (File::exists($file1))
            {
                File::delete($file1);
            }
            $file = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('public/file',$file);
            $validatedData['file']=$file;
        }

        $this->book->update($validatedData,$id);
        return redirect()->route('books.index')->with('success', 'Book Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->book->delete($id);
        return redirect()->back()->with('success', 'Book Destroyed');
    }
}
