<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //To get all books
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validdation for the book
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre' => 'nullable'
        ]);
        //To store the book
        $book = Book::create([
            'user_id' => Auth::user()->id,
            'title' => $data['title'],
            'author' => $data['author'],
            'genre' => $data['genre']
        ]);

        $response = [
            'book' => $book,
            'message' => 'You have added the book successfully ✅',
        ];
        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //To show a particular book
        return Book::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //To update the book
        $book = Book::find($id)->update($request->all());
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //To delete the post
        $del =  Book::destroy($id);
        if($del) {
            $response = [
                'status' => $del,
                'message' => 'Book deleted successfully'
            ];
            return response($response, 201);
        }
        else {
            $response =[
                'status' => $del,
                'message' => 'Book id does not exist'
            ];
            return response($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        //To search for a post
        return Book::where('name', 'like', '%'.$name.'%')->get();
    }
}
