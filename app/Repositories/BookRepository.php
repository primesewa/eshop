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
class BookRepository extends Repository implements BookInterface
{
    protected $model;
    public function __construct(Book $model)
    {
        $this->model = $model;
    }
    public function findbycategory($id)
    {
        return $this->model->where('main_id','=',$id)->get();
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
//        $books= Book::all();
//      foreach ($sections as $section)
//      {  echo'title 1'.$section->title.'<br>';
//          foreach ($section->book_id as $id) {
//              foreach ($books as $book)
//              {
//                  if($book->id==$id){
//                      echo$book->Title.'<br>';
//                  }
//              }
//
//          }
//      }
//    }
    }

}
