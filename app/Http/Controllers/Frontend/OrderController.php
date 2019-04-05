<?php

namespace App\Http\Controllers\Frontend;

use App\Library;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use  App\Repositories\OrderInterface;
class OrderController extends Controller
{
    protected $order;
    public function __construct(OrderInterface $order)
    {
        $this->order=$order;
        $this->middleware('auth');

    }
    public function payment(Request $request)
    {
        if(!Session::has('library') || Session::get('library')->totalprice == 0)
        {
            return redirect('/');
        }
        $oldlibrary = Session::get('library');
        $library = new Library($oldlibrary);

        $order=$this->order->create(Auth::user()->id,serialize($library),99);
        Session::forget('library');
        return redirect('/')->with('success','Book has been bought and add to your library');
    }
}
