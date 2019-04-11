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
    protected $order,$subcategory,$minicategory,$vorder;
    public function __construct(OrderInterface $order,SubcategoryInterface $subcategory,MinicategoryInterface $minicategory)
    {
        $this->minicategory = $minicategory;
        $this->subcategory=$subcategory;
        $this->order=$order;
//        $this->vorder = $vorder;
        $this->middleware('auth');

    }
    public function payment(Request $request)
    {

        if(!Session::has('library') || Session::get('library')->totalprice == 0 and !Session::has('vendor') || Session::get('vendor')->totalprice == 0)
        {
            return redirect()->route('home');
        }
        if(Session::has('library')) {
            $oldlibrary = Session::get('library');
            $library = new Library($oldlibrary);
            $this->pay_with_sewa( $library->totalprice);

//

            $order = $this->order->create(Auth::user()->id, serialize($library), 99); //for admin order
        }


//        if(Session::has('vendor')) {
//            $oldvender = Session::get('vendor');
//            $venders = new Library($oldvender);
//            foreach ($venders as $vender) {
//                if (is_array($vender)) {
//                    foreach ($vender as $item) {
//
////            per $item is  send to data base table for particu;lar user for payment
////         dd($item); //is serialized
////            $item['expire_at']
////            $item['price']
////                $x =$item['item']['user_id'];
//
//
////payment code for per vendor
//
//                        Auth::user()->vorders()->create(
//                            [
//                                'vendor' => serialize($item),
//                                'payment_id' => 99,
//                                'vendor_id' => $item['item']['user_id'],
//                                'expire_date' => $item['expire_at']
//                            ]
//                        );
//
//                    }
//                }
//            }
//
//        }



        Session::forget('library');
//        Session::forget('vendor');
       // return redirect('/')->with('success','Book has been bought and add to your library');
    }

    public function pay_with_sewa($amt)
    {
      //  payment code for admin
                         $url = "https://uat.esewa.com.np/epay/main";
                         $data = [
                             'amt' =>$amt,
                             'pdc' => 0,
                             'psc' => 0,
                             'txAmt' => 0,
                             'tAmt' => $amt,
                             'pid' => 'ee2c3ca1-696b-4cc5-a6be-2c40d929d453',
                             'scd' => 'testmerchant',
                             'su' => "http://merchant.com.np/page/esewa_payment_success",
                             'fu' => "http://merchant.com.np/page/esewa_payment_failed"
                         ];
//                         $data = serialize($data);
                        $curl = curl_init($url);
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        $response = curl_exec($curl);
                        curl_close($curl);
        dd(json_decode($response));

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
