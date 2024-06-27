<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\GstBill;
use Illuminate\Support\Facades\DB;

class GstBillController extends Controller
{
    public function index(){
        $bills = GstBill::with('party')->where('is_deleted',0)->get();
        return view("gst-bill.index",compact('bills'));
    }
    public function addGstBill(){
        $data['parties'] = Party::orderBy('full_name')->get();
        return view("gst-bill.add",$data);
    }
    public function createGstBill(Request $request){
        $request->validate([
            'party_id' => 'required|exists:parties,id',
            'invoice_date' => 'required|date',
            'invoice_no' => 'required|string|max:255',
            'item_description' => 'required|max:250',
            'total_amount' => 'required|numeric',
            'cgst_rate' => 'nullable|min:0|max:100',
            'cgst_amount' => 'numeric|min:0',
            'sgst_rate' => 'nullable|min:0|max:100',
            'sgst_amount' => 'numeric|min:0',
            'igst_rate' => 'nullable|min:0|max:100',
            'igst_amount' => 'numeric|min:0',
            'tax_amount' => 'numeric|min:0',
            'net_amount' => 'required|numeric|min:0',
        ]);

        $param = $request->all();

        // Remove token from post data before inserting
        unset($param['_token']);
        GstBill::create($param);

        // Redirect to manage bills
        return redirect()->route('manage-gst-bill')->withStatus("Bill created successfully");
    }
    public function print($id){
        $data['bill'] = GstBill::where('id', $id)->with('party')->first();
        return view("gst-bill.print", $data);
    }
}
