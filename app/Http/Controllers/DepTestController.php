<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabDepartment;
use App\Models\ParentLabTest;

class DepTestController extends Controller
{
    public function testindex () {
        $departments = LabDepartment::get();
        return view ('frontend.dep',compact('departments'));
    }
    public function storeDep (Request $request) {
        LabDepartment::create([
                'dep_name' => $request->name,
        ]);
        return redirect()->back()->with('success','Data Added Successfully');
    }
    
    public function deleteDep(Request $request)  
       { 
        $id = $request->id;
          $user = LabDepartment::find($id)->delete();  
          return response()->json([
            'success'=>200,
          ]);
       } 
}
