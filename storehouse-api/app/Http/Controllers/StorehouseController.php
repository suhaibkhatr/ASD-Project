<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStorehouseRequest;
use App\Http\Requests\UpdateStorehouseRequest;
use App\Models\Storehouse;
use App\RolesEnum;
use Exception;
use Illuminate\Support\Facades\Auth;

class StorehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            $storehouses = Storehouse::get();
        } else {
            $storehouses = Auth::user()->storehouses()->get();
        }
        return response()->json($storehouses, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStorehouseRequest $request)
    {
        try {
            $storehouse = Storehouse::create([
                "title" => $request->title,
                "address" => $request->address,
                "city" => $request->city,
                "state" => $request->state,
                "storehouse_type_id" => $request->storehouse_type_id,
            ]);
        } catch (Exception $e) {
            return response($e, 300);
        }

        $storehouse->users()->attach(Auth::getUser());
        return response()->json($storehouse, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Storehouse $storehouse)
    {
        return response()->json($storehouse);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateStorehouseRequest $request,
        Storehouse $storehouse
    ) {
        $user = Auth::user();
        if (
            $user->role_id == 1 ||
            $user->storehouses()->find($storehouse->id)
        ) {
            $storehouse->update([
                "title" => $request->title ?? $storehouse->title,
                "address" => $request->address ?? $storehouse->address,
                "city" => $request->city ?? $storehouse->city,
                "state" => $request->state ?? $storehouse->state,
                "storehouse_type_id" =>
                    $request->storehouse_type_id ??
                    $storehouse->storehouse_type_id,
            ]);
            return response()->json($storehouse, 202);
        }
        return response("Unauthrized", 401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Storehouse $storehouse)
    {
        $storehouse->delete();
        return response()->json(["success" => 1], 200);
    }
}
