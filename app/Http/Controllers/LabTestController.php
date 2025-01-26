<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LabDepartment;
use App\Models\ParentLabTest;

class LabTestController extends Controller
{
    public function index () {
        $datas = ParentLabTest::with('department')->get();
        $departments = LabDepartment::get();
        return view ('frontend.index',compact('departments','datas'));
    }
    public function filterTest (Request $request) {
        $id = $request->depId;
        $data = ParentLabTest::where('dep_id',$id)->get();
        return response()->json([
            'success'=>200,
            'data'=>$data

        ]);
    }
    public function storeTest (Request $request) {
        ParentLabTest::create([
                'name' => $request->name,
                'short' => $request->short,
                'dep_id'=>$request->depId,
        ]);
        return redirect()->back()->with('success','Data Added Successfully');
    }
    public function editTest (Request $request) {
        $id = $request->id;
        $data = ParentLabTest::where('id',$id)->first();
        return response()->json([
            'success'=>200,
            'data'=>$data

        ]);
    }
    public function updateTest (Request $request) {
        $data = ParentLabTest::find($request->id); 
        $data->update([
            'name' => $request->name,
            'short' => $request->short,
            'dep_id'=>$request->depId,
    ]);
    return redirect()->back()->with('success','Data Added Successfully');  
    } 
}
