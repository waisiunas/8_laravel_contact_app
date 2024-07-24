<?php

namespace App\Http\Controllers\user\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        return response()->json([
            'categories' => Category::where('user_id', '=', $id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'name' => $validator->messages(),
            ]);
        }

        $data = [
            'name' => $request->name,
            'user_id' => $request->id,
        ];

        if (Category::create($data)) {
            return response()->json([
                'success' => 'Magic has been spelled!'
            ]);
        } else {
            return response()->json([
                'failure' => 'Magic has failed to spell!'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json([
            'category' => Category::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'name' => $validator->messages(),
            ]);
        }

        $data = [
            'name' => $request->name,
        ];

        $category = Category::find($request->id);

        if ($category->update($data)) {
            return response()->json([
                'success' => 'Magic has been spelled!'
            ]);
        } else {
            return response()->json([
                'failure' => 'Magic has failed to spell!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Category::find($id)->delete()) {
            return response()->json([
                'success' => 'Magic has been spelled!'
            ]);
        } else {
            return response()->json([
                'failure' => 'Magic has failed to spell!'
            ]);
        }
    }
}
