<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/13/2019
 * Time: 1:40 PM
 */
namespace App\Repositories;
use App\homesection;
use App\book_homesection;
use DB;
class HomesectionRepo extends Repository implements HomesectionInterface
{
    protected $model;
    public function __construct(homesection $model)
    {
        $this->model = $model;
    }
    public function create(array $data)
    {
        $section = $this->model->create($data);
        $book_id=json_encode($data['book_id']);

            book_homesection::create([
                'position' =>$section->position,
                'book_id' => $book_id,
                'homesection_id' => $section->id
            ]);

        return $section;
    }
    public  function sectionget($id)
    {


        $sections =DB::select('select * from homesections  join book_homesections as bh on bh.homesection_id = ? and homesections.id = ?',[$id,$id]);
        return $sections;

    }
    public function update(array $data,$id)
    {
        $section = $this->model->find($id);
        $section->update($data);
        $book_id=json_encode($data['book_id']);
        $bh =  book_homesection::where('homesection_id','=',$id);
        $bh->update([
            'position' =>$section->position,
            'book_id' => $book_id,
            'homesection_id' => $section->id
        ]);
        return $section;
    }
    public function delete($id)
    {
        DB::table('homesections')->where('id', '=',$id)->delete() && DB::table('book_homesections')->where('homesection_id','=',$id)->delete();
        return true;

    }
    }
