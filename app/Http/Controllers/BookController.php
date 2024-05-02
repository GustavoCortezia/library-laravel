<?php

namespace App\Http\Controllers;

use App\Models\Book;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $book = Book::all();

        return response()->json(['success' => 'true', 'books' => $book]);
    }

    public function store(Request $request)
    {
    try {
            $request->validate([
                'title' => 'required',
                'author' => 'required'
            ],
            [
                'title.required' => 'title is required',
                'author.required' => 'author is required'
            ]);

                $book = Book::create($request->all());

        }catch(\Exception $error){
            return response()->json(['success' => 'false','msg' => $error->getMessage()],400);
        }
        return response()->json(['success' => 'true','msg' => 'Book created succesfuly' ,'book' => $book]);

    }



    public function update(Request $request , int $id)
    {
        try{

            $book = Book::findOrFail($id);

            $book->title = $request->title;
            $book->author = $request->author;
            $book->description = $request->description;

            $book->save();

        }catch(\Exception $error){
            return response()->json(['success' => 'false','msg' => $error->getMessage()]);
        }
        return response()->json(['success' => 'true','msg' => 'Book updated succesfuly' ,'book' => $book]);

    }


    public function show(int $id)
    {
        try{
            $book = Book::findOrFail($id);
        }catch(\Exception $error){
            return response()->json(['success' => 'false','msg' => $error->getMessage()]);
        }

    return response()->json(['success' => 'true','book' => $book]);

    }

    public function destroy(int $id)
    {
        try{

            $book = Book::findOrFail($id);

            $book->delete();

        }catch(\Exception $error){
            return response()->json(['success' => 'false','msg' => $error->getMessage()]);
        }

    return response()->json(['success' => 'true','msg' => 'Book deleted succesfuly' ,'book' => $book]);


    }
}
