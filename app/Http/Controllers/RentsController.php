<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentResource;
use App\Models\Rents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
        $this->middleware(['rent-owner'])->only('show', 'update', 'delete');
    }

    public function index()
    {
        $rents = Rents::all();
       
        return RentResource::collection($rents);
    }

    public function show($id)
    {
        $rent = Rents::with('penyewa:id,username')->findOrFail($id);
        return new RentResource($rent);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' =>  'required',
        ]);

        $user = Auth::user()->id;

        $rent = Rents::create([
            'user_id' => $user,
            'book_id' => $request->book_id,
        ]);

        return new RentResource($rent);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required'
        ]);

        $rent = Rents::findOrFail($id);
        $rent->update($request->all());

        return new RentResource($rent);
    }

    public function delete($id)
    {
        $rent = Rents::findOrFail($id);
        $rent->delete();

        return response()->json([
            'message' => 'rent has been deleted'
        ]);
    }
}
