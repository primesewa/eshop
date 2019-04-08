<?php

namespace App;
use Session;
class Library
{
    public $items = null;
    public $totalQty = 0;
    public $totalprice = 0;


    public function __construct($oldlibrary)
    {

        if($oldlibrary)
        {
            $this->items = $oldlibrary->items;
            $this->totalQty = $oldlibrary->totalQty;
            $this->totalprice = $oldlibrary->totalprice;
        }
    }

    public function add($id,$item)
    {
        $today = date("Y/m/d");
        $days = $item->expire_date;
        if($days==7)
        {
            $enddate=strtotime("+7 day". $today);
            $finaldate=date("Y/m/d",$enddate);
        }
        else if($days==15)
        {
            $enddate=strtotime("+15 day". $today);
            $finaldate=date("Y/m/d",$enddate);

        }
        else if($days==30)
        {
            $enddate=strtotime("+1 month". $today);
            $finaldate=date("Y/m/d",$enddate);

        }
        else if($days==90)
        {
            $enddate=strtotime("+3 month". $today);
            $finaldate=date("Y/m/d",$enddate);

        }
        else if($days== 180)
        {
            $enddate=strtotime("+6 month". $today);
            $finaldate=date("Y/m/d",$enddate);

        }
        else if($days==240)
        {
            $enddate=strtotime("+8 month". $today);
            $finaldate=date("Y/m/d",$enddate);

        }
        else
        {
            $enddate=strtotime("+1 year". $today);
            $finaldate=date("Y/m/d",$enddate);
        }



        $store = [ 'expire_at'=>$finaldate,'price' => $item->Discount_price,'item'=> $item];
            if($this->items)
            {
                 if (array_key_exists($id, $this->items)) {
                    $store = $this->items[$id];

                 }
                else{

                $this->items[$id] = $store;
                 $this->totalQty++;
                 $this->totalprice += $item->Discount_price;

                    }
                 }
            else {

                $this->items[$id] = $store;
                $this->totalQty++;
                $this->totalprice += $item->Discount_price;
            }



    }
    public function delete($id,$item)
    {
            if(array_key_exists($id,$this->items))
            {
                $x = $this->items[$id];

            }
            $this->totalQty--;
            $this->totalprice -= $x['price'];
            unset( $this->items[$id]);


    }

}
