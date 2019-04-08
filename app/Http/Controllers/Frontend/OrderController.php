<?php

namespace App\Http\Controllers\Frontend;

use App\Library;
use App\Repositories\MinicategoryInterface;
use App\Repositories\SubcategoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use  App\Repositories\OrderInterface;
class OrderController extends Controller
{
    protected $order,$subcategory,$minicategory;
    public function __construct(OrderInterface $order,SubcategoryInterface $subcategory,MinicategoryInterface $minicategory)
    {
        $this->minicategory = $minicategory;
        $this->subcategory=$subcategory;
        $this->order=$order;
        $this->middleware('auth');

    }
    public function payment(Request $request)
    {
        if(!Session::has('library') || Session::get('library')->totalprice == 0 and !Session::has('vendor') || Session::get('vendor')->totalprice == 0)
        {
            return redirect()->route('home');
        }
        $oldlibrary = Session::get('library');
        $library = new Library($oldlibrary);
//        dd($library);

//        payment code for admin

//        $order=$this->order->create(Auth::user()->id,serialize($library),99); //for admin order


        $oldvender = Session::get('vendor');
        $venders= new Library($oldvender);
    foreach ($venders as $vender)
    {


        foreach ($vender as $item)
        {

//            per $item is  send to data base table for particu;lar user for payment
         dd($item); //is serialized
//            $item['expire_at']
//            $item['price']
//                $x =$item['item']['user_id'];

        }
    }







//        Session::forget('library');
//        return redirect('/')->with('success','Book has been bought and add to your library');
    }

    public function payment_subcategory(Request $request,$id)
    {
        try {
            $subcategory = $this->subcategory->find($id);
            $expiredate = $this->date_convert($subcategory->expire_date);
            $order = Auth::user()->suborders()->create([
                'sub_id' => $subcategory->id,
                'payment_id' =>99,
                'expire_date' => $expiredate
            ]);
            return redirect()->route('home')->with('success','Category has been bought and add to your library');
        }

        catch(Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    public function payment_minicategory(Request $request,$id)
    {
        try {
            $minicategory = $this->minicategory->find($id);
            $expiredate = $this->date_convert($minicategory->expire_date);
            $order = Auth::user()->miniorders()->create([
                'mini_id' => $minicategory->id,
                'payment_id' =>99,
                'expire_date' => $expiredate
            ]);
            return redirect()->route('home')->with('success','Category has been bought and add to your library');
        }

        catch(Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    public function date_convert($days)
    {
        $today = date("Y/m/d");
        if($days==7)
        {
            $enddate=strtotime("+7 day". $today);
            $finaldate=date("Y/m/d",$enddate);
            return $finaldate;
        }
        else if($days==15)
        {
            $enddate=strtotime("+15 day". $today);
            $finaldate=date("Y/m/d",$enddate);
            return $finaldate;

        }
        else if($days==30)
        {
            $enddate=strtotime("+1 month". $today);
            $finaldate=date("Y/m/d",$enddate);
            return $finaldate;

        }
        else if($days==90)
        {
            $enddate=strtotime("+3 month". $today);
            $finaldate=date("Y/m/d",$enddate);
            return $finaldate;

        }
        else if($days== 180)
        {
            $enddate=strtotime("+6 month". $today);
            $finaldate=date("Y/m/d",$enddate);
            return $finaldate;

        }
        else if($days==240)
        {
            $enddate=strtotime("+8 month". $today);
            $finaldate=date("Y/m/d",$enddate);
            return $finaldate;

        }
        else
        {
            $enddate=strtotime("+1 year". $today);
            $finaldate=date("Y/m/d",$enddate);
            return $finaldate;
        }


    }

}
