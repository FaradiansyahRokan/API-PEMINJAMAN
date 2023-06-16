<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('show', 'store', 'update', 'delete');
    }

    public function index()
    {
        $book = Books::all();

        return BookResource::collection($book);
    }

    public function show($id)
    {
        $book = Books::findOrFail($id);
        return new BookResource($book);
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'owner' => 'required'
        ]);

        if ($request->file) {
            $validated = $request->validate([
                'image' => 'mimes:jpg,jpeg,png|max:100000'
            ]);

            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();

            Storage::putFileAs('image', $request->file, $fileName . '.' . $extension);

            $request['image'] = $fileName . '.' . $extension;
            $request['owner'] = Auth::user()->id;

            $book =  Books::create($request->all());
        }

        $request['owner'] = Auth::user()->id;
        $book =  Books::create($request->all());

        return new BookResource($book->loadMissing('owner'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'owner' => 'required'
        ]);

        $book = Books::findOrFail($id);
        $book->update($request->all());

        return new BookResource($book);
    }

    public function delete($id)
    {
        $book = Books::findOrFail($id);
        $book->delete();

        return response()->json([
            'message' => 'book deleted successfully'
        ]);
    }
}
