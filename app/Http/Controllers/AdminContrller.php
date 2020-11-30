<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminContrller extends Controller
{
    public function uploadEditorImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);
        $picName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $picName);
        return response()->json([
            'success' => 1,
            'file' => [
                'url' => "http://127.0.0.1:8000/uploads/$picName",
            ],
        ]);
        return $picName;
    }
}
