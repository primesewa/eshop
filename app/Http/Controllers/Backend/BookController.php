<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Repositories\BookInterface;
use App\Repositories\MaincategoryInterface;
use App\Repositories\subcategoryInterface;
use App\Repositories\minicategoryInterface;


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
    }

    public function index()
    {
        $books = $this->book->paginate();
        $i=0;
        return view('backend.pages.dashboard.products.showbook',compact('books','i'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maincategory=$this->maincategory->all();
        return view('backend.pages.dashboard.products.addbooks',compact('maincategory'));

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
            'main_id' => '',
            'sub_id' => '',
            'mini_id' => '',
            'Main_price' => 'required|min:2|max:7|alpha_num',
            'Discount_price' => 'required|min:2|max:7|alpha_num',
            'Image' =>'image|required',
            'Image.*' =>'mimes:jpeg,png,bmp,gif,svg',
            'file' => 'file|required',
            'file.*' =>'mimes:doc,pdf,docx,zip',
        ]);
        /**
         * @param $validatedData
         */
        if($request->hasFile('Image') and $request->hasFile('file') ){
            $filenameWithExt = $request->file('Image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('Image')->getClientOriginalExtension();
            // Filename to store
            $validatedData['Image']= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('Image')->storeAs('public/image',$validatedData['Image']);

            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $validatedData['file']= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/file',$validatedData['file']);


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
        $maincategory=$this->maincategory->all();
        $subcategory=$this->subcategory->all();
        $minicategory=$this->minicategory->all();


        return view('backend.pages.dashboard.products.editbooks',compact('book','maincategory','subcategory','minicategory'));

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
        ]);

        /**
         * @param $validatedData
         */
        if($request->hasFile('Image') and $request->hasFile('file') ){
            $filenameWithExt = $request->file('Image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('Image')->getClientOriginalExtension();
            // Filename to store
            $validatedData['Image']= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('Image')->storeAs('public/image',$validatedData['Image']);

            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $validatedData['file']= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/file',$validatedData['file']);


        }
        // dd($validatedData);
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
