<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function viewDesignation()
    {
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation', $data);
    }

    public function getAddDesignation()
    {
        return view('backend.setup.designation.add_designation');
    }

    public function storeDesignation(Request $request)
    {
        $validateData =  $request->validate([
            'name' => 'required|unique:designations'
        ]);

        $designation = new Designation();
        $designation->name = $request->name;
        $designation->save();

        $notification = array(
            'message' => 'Designation has been added.',
            'alert-type' => 'success'
        );
        return redirect()->route('designation.view')->with($notification);
    }

    public function editDesignation(Designation $designation)
    {
        return view('backend.setup.designation.edit_designation', compact('designation'));
    }

    public function updateDesignation(Request $request, Designation $designation)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:designations'
        ]);
        $designation->name  = $request->name;
        $designation->update();

        $notification = array(
            'message' => 'Designation has been updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('designation.view')->with($notification);
    }

    public function deleteDesignation(Designation $designation)
    {
        $designation->delete();
        $notification = array(
            'message' => 'Designation has been deleted.',
            'alert-type' => 'error'
        );
        return redirect()->route('designation.view')->with($notification);
    }
}
