<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisation;

class OrganisationController extends Controller
{
    //
    public function create(Request $request)
    {
        $organisation = new Organisation();
        $organisation->name = $request->name;
        $organisation->description = $request->description;
        $organisation->user_id = $request->user_id;
        $organisation->save();
        return response()->json([
            "status" => 1,
            "message" => "Organisation created successfully"
        ]);
    }
}
