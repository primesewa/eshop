<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Icon;
use App\User;
use  App\Repositories\BookInterface;

class CustomerController extends Controller
{
    private $book;
    public function __construct(BookInterface $book)
    {
        $this->book=$book;
    }
    public function customer()
    {
        $icons = Icon::all()->take(1);
        $this->data('title',$this->make_title('Customer'));
        $users = User::all();
        return view('backend.pages.dashboard.customer.customer',$this->data,compact('icons','users'));

    }
    public function getcustomer($id)
    {
        $icons = Icon::all()->take(1);
        $user = User::find($id);
        $orders = $user->orders;
        $orders->transform(function($order, $key) {
            $order->library = unserialize($order->library);
            return $order;
        });
        $this->data('title',$this->make_title('Customer History'));
        return view('backend.pages.dashboard.customer.history',$this->data,compact('icons','user','orders'));
    }


}
