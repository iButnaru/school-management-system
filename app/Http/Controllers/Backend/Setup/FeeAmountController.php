<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    public function viewFeeAmount()
    {
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }


    public function getAddFeeAmount()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }

    public function storeFeeAmount(Request $request)
    {

        $countClass = count($request->class_id);
        if ($countClass) {
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->save();
            }
            $notification = array(
                'message' => 'Fee Amounts have been added.',
                'alert-type' => 'success'
            );
            return redirect()->route('fee.amount.view')->with($notification);
        }
    }

    public function editFeeAmount($feeCategoryId)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $feeCategoryId)->orderBy('class_id', 'asc')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        // dd($data['fee_category_id']->toArray());
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }

    public function updateFeeAmount(Request $request,  $feeCategoryId)
    {
        if (!$request->class_id) {

            $notification = array(
                'message' => 'You must select at least one class amount.',
                'alert-type' => 'error'
            );
            return redirect()->route('fee.amount.view')->with($notification);
        } else {
            $count = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id', $feeCategoryId)->delete();
            if ($count) {
                for ($i = 0; $i < $count; $i++) {
                    $feeAmount = new FeeCategoryAmount();
                    $feeAmount->fee_category_id = $request->fee_category_id;
                    $feeAmount->class_id = $request->class_id[$i];
                    $feeAmount->amount = $request->amount[$i];
                    $feeAmount->save();
                }
                $notification = array(
                    'message' => 'The fee amount has been updated.',
                    'alert-type' => 'success'
                );
                return redirect()->route('fee.amount.view')->with($notification);
            }
        }
    }

    function detailsFeeAmount($feeCategoryId)
    {
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id', $feeCategoryId)->orderBy('class_id', 'asc')->get();
        return view('backend.setup.fee_amount.details_fee_amount', $data);
    }
}
