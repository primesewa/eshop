<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/14/2019
 * Time: 1:49 PM
 */
namespace App\Repositories;
use App\maincategory;
use DB;
class MaincategoryRepo extends Repository implements MaincategoryInterface
{
    protected $model;
    public function __construct(maincategory $model)
    {
        $this->model = $model;
    }
    public  function takefour()
    {
       return $this->model->take(4)->where('confirmed', '=',1)->get();
    }
    public  function all()
    {
        return $this->model->where('confirmed', '=',1)->orderBy('id','desc')->get();
    }
    public  function getmaincategory()
    {
        return $this->model->select('*') ->orderBy('id', 'desc')->get();
    }

    public  function categorybycount()
    {
        return DB::select('SELECT m.main_category,m.id, count(b.main_id) as c FROM maincategories as m JOIN books as b on b.main_id = m.id where(confirmed = 1)group by(b.main_id)  LIMIT 15');

    }
    public  function bookbycategory($id)
    {
        return DB::select('SELECT  b.* FROM maincategories as m JOIN books as b where(confirmed = 1 and m.id = ? and b.main_id = ?)',[$id,$id]);

    }

    public  function delete($id)
    {
        try {
            $main = $this->model->find($id);
            if($main->confirmed == 1)
            {
                return redirect()->back()->with('error','Main-Category Is Being Used');
            }
            else{
                $main->delete($id);
                return redirect()->back()->with('success','Main-Category Is Deleted');
            }

        }

        catch(Exception $e) {
            return redirect()->back()->with('success',$e->getMessage());
        }


    }
    public  function allcategory()
    {
        dd(DB::select('select  mi.mini_category from maincategories as m join subcategories as s   join minicategories as mi '));
    }
    public  function conformed($id)
    {
        try {
            $main = $this->model->find($id);
            if($main->confirmed == 0)
            {
                return $main->update([
                    'confirmed' => 1,
                ]);

            }
            else
            {

                return  $main->update([
                    'confirmed'=> 0,
                ]);
            }

        }

        catch(Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }



        }

}
