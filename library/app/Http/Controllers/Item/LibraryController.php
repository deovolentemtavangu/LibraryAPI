<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class LibraryController extends Controller
{
    public function registerBook(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published' => 'boolean',
        ]);
    

        $book = Book::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Book created.',
            'data' => $book
        ]);

       
    }

    public function getBooks(Request $request){
        $book = Book::all(); 
        return response()->json([
            'status' => true,
            'message' => 'Books retrieved',
            'data' => $book
        ]);


    }
    public function getBookById(Request $request, $id){
        $book = Book::find($id); 
        return response()->json([
            'status' => true,
            'message' => 'Book found',
            'data' => $book
        ]);


    }

    public function updateBookById(Request $request, $id){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published' => 'boolean',
        ]);

        
        $book = Book::find($id); 
        if($book){
            $book->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Record updated',
                'data' => $book
            ],200);
        }
        else 
        {
            return response()->json([
                'status' => false,
                'message' => 'Book not found , failed to Update',
                'data' => null
            ],400);
        }
        


    }

    public function deleteBookById(Request $request, $id){
        $book = Book::find($id); 
        if($book){
            $book->delete();

            return response()->json([
                'status' => true,
                'message' => 'Record deleted',
                'data' => null
            ],200);
        }
        else 
        {
            return response()->json([
                'status' => false,
                'message' => 'Book not found , failed to delete',
                'data' => null
            ],400);
        }
        


    }

}
