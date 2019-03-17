<?php
/**
 * Created by PhpStorm.
 * User: Prime IT Sewa
 * Date: 3/13/2019
 * Time: 1:40 PM
 */
namespace App\Repositories;
use App\Book;
class BookRepository extends Repository implements BookInterface
{
    protected $model;
    public function __construct(Book $model)
    {
        $this->model = $model;
    }
}
