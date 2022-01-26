<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function viewFeeCategory()
    {
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee.view_category', $data);
    }

    public function getAddFee()
    {
        return view('backend.setup.fee.add_fee');
    }

    public function storeFeeCategory(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories'
        ]);

        $feeCategory = new FeeCategory([
            'name' => $request->name,
        ]);
        $feeCategory->save();

        $notification = array(
            'message' => 'Fee Category has been added.',
            'alert-type' => 'success'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }

    public function editFeeCategory(FeeCategory $feeCategory)
    {
        return view('backend.setup.fee.edit_fee', compact('feeCategory'));
    }

    public function updateFeeCategory(FeeCategory $feeCategory, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories'
        ]);

        $feeCategory->name = $request->name;
        $feeCategory->update();
        $notification = array(
            'message' => 'Fee Category has been updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }

    public function deleteFeeCategory(FeeCategory $feeCategory)
    {
        $feeCategory->delete();
        $notification = array(
            'message' => 'Fee Category has been deleted.',
            'alert-type' => 'error'
        );
        return redirect()->route('fee.category.view')->with($notification);
    }
}
