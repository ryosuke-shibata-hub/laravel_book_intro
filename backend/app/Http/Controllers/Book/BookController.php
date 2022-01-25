<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


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
            'item_name' => 'required|max:255|min:3',
            'item_number' => 'required|min:1|max:99|numeric',
            'item_amount' => 'required|max:99999|numeric',
            'published' => 'required|date',
        ]);

        if($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }

        $books = new Book();
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();

        return redirect('/');
    }

    public function edit($id)
    {
        # code...
        $book = Book::find($id);

        return view('Books.edit')
        ->with('book',$book);
    }

    public function update(Request $request)
    {
        # code...
        $validator = validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|max:255|min:3',
            'item_number' => 'required|min:1|max:99|numeric',
            'item_amount' => 'required|max:99999|numeric',
            'published' => 'required|date',
        ]);

         if($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }

        $item = [
            'item_name' => $request->item_name,
            'item_number' => $request->item_number,
            'item_amount' => $request->item_amount,
            'published' => $request->published,
        ];

        DB::table('books')
        ->where('id',$request->id)
        ->update($item);

        return redirect('/');
    }

    public function delete(Book $book)
    {
        # code...
        $book->delete();
        return redirect('/');
    }
}