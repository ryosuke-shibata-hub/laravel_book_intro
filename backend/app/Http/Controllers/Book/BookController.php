<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    //
    public function __construct()
    {
        # code...
        $this->middleware('auth');
    }

    public function index(Request $request) {

        $books = Book::where('user_id',Auth::user()->id)
        ->orderBy('created_at','desc')
        ->paginate(3);


        return view('Books.books')
        ->with('books',$books);
    }

    public function store(Request $request)
    {
        # code...
        $validator = Validator::make($request->all(),[
            'item_name' => 'required|max:255|min:3',
            'item_number' => 'required|min:1|max:99|numeric',
            'item_amount' => 'required|max:99999|numeric',
            'published' => 'required|date',
            'item_img' => 'required',
        ]);

        if($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }

        $file = $request->file('item_img');
        if(!empty($file)) {
            $fileName = $file->getClientOriginalName();
            $move = $file->move('./upload/',$fileName);
        }else {
            $fileName ="";
        }

        $books = new Book();
        $books->user_id = Auth::user()->id;
        $books->item_name = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->item_img = $fileName;
        $books->save();

        return redirect('/')
        ->with('message','本の登録が完了しました。');
    }

    public function edit($book_id)
    {
        # code...
        $book = Book::where('user_id',Auth::user()->id)
        ->find($book_id);

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
            'item_img' => 'required',
        ]);

         if($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }

         $file = $request->file('item_img');
        if(!empty($file)) {
            $fileName = $file->getClientOriginalName();
            $move = $file->move('./upload/',$fileName);
        }else {
            $fileName ="";
        }

        // $books = Book::where('user_id',Auth::User()->id)find($request->id));
        // $books->item_name = $request->item_name;
        // $books->item_number = $request->item_number;
        // $books->item_amount = $request->item_amount;
        // $books->published = $request->published;
        // $books->save();
        // return redirect('/');

        $item = [
            'user_id' => Auth::user()->id,
            'item_name' => $request->item_name,
            'item_number' => $request->item_number,
            'item_amount' => $request->item_amount,
            'published' => $request->published,
            'item_img' => $fileName,
        ];

        DB::table('books')
        ->where('id',$request->id)
        ->update($item);

        return redirect('/');
    }

    public function destroy(Book $book)
    {
        # code...
        $book->delete();
        return redirect('/');
    }
}