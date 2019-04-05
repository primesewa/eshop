<?php

namespace App\Repositories;

use App\Order;
class OrderRepo implements OrderInterface
{
    protected $model;
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function create($user_id,$library,$payment_id)
    {
       return Order::create([
            'user_id'=>$user_id,
            'library' => $library,
            'payment_id' => $payment_id
        ]);

    }

    public function delete($id)
    {
    }



}
