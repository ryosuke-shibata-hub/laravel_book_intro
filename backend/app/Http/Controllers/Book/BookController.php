<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Book;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    //
    public function book(Request $request) {

         $books = Book::orderBy('created_at','asc')
         ->get();

        return view('Books.books')
        ->with('books',$books);
    }

    public function post(Request $request)
    {
        # code...
        $validator = Validator::make($request->all(),[
            'item_name'=>'required|max:255',
        ]);

        if($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }

        $books = new Book();
        $books->item_name = $request->item_name;
        $books->item_number = '1';
        $books->item_amount = '1000';
        $books->published = '2022-01-22';
        $books->save();

        return redirect('/');
    }

    public function delete(Book $book)
    {
        # code...
        $book->delete();
        return redirect('/');
    }
}