<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/15/2019
 * Time: 11:58 AM
 */
namespace App\Repositories;
use DB;
use App\minicategory;
class MinicategoryRepo extends Repository implements MinicategoryInterface
{
    protected $model;
    public function __construct(minicategory $model)
    {
        $this->model = $model;
    }
    public function bookbycategory($id)
    {
        return DB::select('SELECT  b.* FROM minicategories as m JOIN books as b where(confirmed = 1 and m.id = ? and b.mini_id = ?)',[$id,$id]);
    }
    public function getminicategory($id)
    {
        return $minicategory = $this->model->where('sub_id','=',$id)->get();
        response()->json(['data'=>$minicategory]);
    }
    public function minicategory()
    {
        return $this->model->select('*') ->orderBy('id', 'desc')->get();
    }

    public  function all()
    {
        return $this->model->where('confirmed', '=',1)->get();
    }

    public function conformed($id)
    {

        try {
            $mini = $this->model->find($id);
            if($mini->confirmed == 0)
            {

                $mini->update([
                    'confirmed' => 1,
                ]);
                return redirect()->back()->with('success','Status updated');

            }
            else
            {

                $mini->update([
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
            $mini = $this->model->find($id);
            if($mini->confirmed == 1)
            {
                return redirect()->back()->with('error','Mini-Category Is Being Used');
            }
            else{
                $mini->delete($id);
                return redirect()->back()->with('success','Mini-category Is Deleted');

            }

        }

        catch(Exception $e) {
            return redirect()->back()->with('errer',$e->getMessage());
        }


    }


}
