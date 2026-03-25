<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{

    public function index()
    {
        // Database se saare subjects fetch karein
        $subjects = Subject::all();

        // View return karein (json ki jagah)
        return view('subjects.index', compact('subjects'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);

        Subject::create([
            'name' => $request->name
        ]);

        return response()->json(['message' => 'Subject added']);

    }

    public function searchAjax(Request $request)
{
    $query = $request->get('query', '');
    // Database se match hone wale subjects uthayein
    $subjects = Subject::where('name', 'LIKE', "%{$query}%")->get();
    
    return response()->json($subjects);
}

}