<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/15/2019
 * Time: 11:27 AM
 */
namespace App\Repositories;
use App\subcategory;

class SubcategoryRepo extends Repository implements SubcategoryInterface
{
    protected $model;
    public function __construct(subcategory $model)
    {
        $this->model = $model;
    }

    public function getsubcategory($id)
    {
        return $subcategory = $this->model->where('main_id','=',$id)->get();
        response()->json(['data'=>$subcategory]);
    }
    public  function search($s)
    {
        return $this->model->Where('sub_category','like','%' .$s. '%')->paginate(10);
    }

public function conformed($id)
{

    try {
        $sub = $this->model->find($id);
        if($sub->confirmed == 0)
        {

            $sub->update([
                'confirmed' => 1,
            ]);
            return redirect()->back()->with('success','Status updated');

        }
        else
        {

            $sub->update([
                'confirmed'=> 0,
            ]);
            return redirect()->back()->with('success','Status updated');
        }

    }

    catch(Exception $e) {
        return redirect()->back()->with('error',$e->getMessage());
    }
}

    public  function delete($id)
    {
        try {
            $sub = $this->model->find($id);
            if($sub->confirmed == 1)
            {
                return redirect()->back()->with('error','sub-Category Is Being Used');
            }
            else{
                $sub->delete($id);
                return redirect()->back()->with('success','Sub-category Is Deleted');

            }

        }

        catch(Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }


    }

//    public function subcategory()//not used
//    {
//        return $this->model->select('*')->orderBy('id', 'desc')->get();
//    }

    public  function all()
    {
        return $this->model->where('confirmed', '=',1)->orderBy('id','desc')->get();
    }



}
