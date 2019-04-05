<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/13/2019
 * Time: 1:40 PM
 */
namespace App\Repositories;
use App\Book;
use App\homesection;
use DB;
use App\Tag;
use Illuminate\Support\Facades\File;

class BookRepository extends Repository implements BookInterface
{
    protected $model,$tag;
    public function __construct(Book $model,Tag $tag)
    {
        $this->model = $model;
        $this->tag=$tag;
    }
    public  function delete($id)
    {

        try {

            $result= $this->model->find($id);
            $file = public_path("storage/file/{$result->file}");

            if (File::exists($file))
            {
                File::delete($file);
            }
            return $result::destroy($id);
        }


        catch(Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }
    public function findbycategory($id)
    {
        return $this->model->where('main_id','=',$id)->get();
    }
    public function search($s)
    {
        return $this->model->Where('Title','like','%' .$s. '%')->orwhere('tag','like','%' .$s. '%')
            ->get();
    }
    public  function getsection()
    {

        $sections = DB::table('homesections')
            ->join('book_homesections', 'book_homesections.homesection_id', '=', 'homesections.id')
            ->get();
        $sections->transform(function ($section, $key) {
            $section->book_id = json_decode($section->book_id);
            return $section;
        });
        return $sections;

    }
    public  function related($id)
    {
        $book=$this->model->find($id);
        $s_id=$book->subcategory->id;
        $mi_id=$book->minicategory->id;
       return DB::select('SELECT * FROM books WHERE (sub_id = ? or mini_id = ?) and NOT (id = ?)',[$s_id,$mi_id,$id]);



    }

}
