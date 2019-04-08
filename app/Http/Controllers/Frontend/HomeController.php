<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use  App\Repositories\BookInterface;
use  App\Repositories\MaincategoryInterface;
use  App\Repositories\MinicategoryInterface;
use  App\banner;
use Session;
use App\Library;
use App\Icon;
use Auth;
use  App\Repositories\UserInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $book,$maincategory,$minicategory,$user;
    public function __construct(BookInterface $book,MaincategoryInterface $maincategory,UserInterface $user)
    {
        $this->middleware('auth');
        $this->book = $book;
        $this->maincategory = $maincategory;
        $this->user=$user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Auth::user()->orders()->latest('created_at')->take(2)->get();
        $orders->transform(function($order, $key) {
            $order->library = unserialize($order->library);
            return $order;
        });
        $suborders = Auth::user()->suborders()->latest('created_at')->take(1)->get();
        $miniorders = Auth::user()->miniorders()->latest('created_at')->take(1)->get();
//        dd($miniorders);
        $books = $this->book->all();
        $icon=Icon::all()->take(1);
        $this->data('title',$this->make_title('Home'));
        return view('frontend.home',$this->data,compact('icon','orders','suborders','books','miniorders'));
    }
    public function update(Request $request,$id)
    {

        $validatedData = $request->validate([
            'password' => 'required|min:4',
            'username' => 'required|min:4',
            'name' =>'required|min:4',
            'email' =>'required'
        ]);
        if( $this->user->update($validatedData,$id))
        {
            return redirect()->route('user.profile')->with('success','Profile Updated');

        }



    }

    public function vendor_book(Request $request)
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
            'tag' =>'required'
        ]);
        $validatedData['tag'] =implode(",",$request->input('tag'));

        /**
         * @param $validatedData
         */
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
            //for morethan one images

        }

       Auth::user()->vendor()->create($validatedData);
        return redirect()->back()->with('success', 'Book Added');

    }

}
