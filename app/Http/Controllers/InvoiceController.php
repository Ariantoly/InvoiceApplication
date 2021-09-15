<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function getInvoice(Request $request){
        $no = $request->no;
        $rawInvoice = DB::table('trInvoice')->where('InvoiceNo', $no)->first();
        $salesName = DB::table('msSales')->where('SalesID', $rawInvoice->SalesID)->value('SalesName');
        $courierName = DB::table('msCourier')->where('CourierID', $rawInvoice->CourierID)->value('CourierName');
        $paymentType = DB::table('msPayment')->where('PaymentID', $rawInvoice->PaymentType)->value('PaymentName');
        $sales = DB::table('msSales')->get();
        $courier = DB::table('msCourier')->get();
        $payment = DB::table('msPayment')->get();
        $product = DB::table('trInvoiceDetail')
                    ->join('msProduct', 'trInvoiceDetail.ProductID', '=', 'msProduct.ProductID')
                    ->select('trInvoiceDetail.*', 'msProduct.ProductName')
                    ->where('InvoiceNo', $no)
                    ->get();

        $invoice = [
            'InvoiceNo' => $rawInvoice->InvoiceNo,
            'InvoiceDate' => $rawInvoice->InvoiceDate,
            'InvoiceTo' => $rawInvoice->InvoiceTo,
            'SalesName' => $salesName,
            'CourierName' => $courierName,
            'ShipTo' => $rawInvoice->ShipTo,
            'PaymentType' => $paymentType,
            'CourierFee' => $rawInvoice->CourierFee,
            'Data' => [
                'Sales' => $sales,
                'Courier' => $courier,
                'Payment' => $payment
            ],
            'Product' => $product
        ];

        return view('search', ['invoice' => $invoice]);
    }

    public function update(Request $request){
        $invoiceNo = $request->no;
        $invoiceDate = $request->date;
        $to = $request->to;
        $salesName = $request->sales;
        $courierName = $request->courier;
        $shipTo = $request->shipTo;
        $paymentType = $request->payment;
        $salesID = DB::table('msSales')->where('SalesName', $salesName)->value('SalesID');
        $courierID = DB::table('msCourier')->where('CourierName', $courierName)->value('CourierID');
        $paymentID = DB::table('msPayment')->where('PaymentName', $paymentType)->value('PaymentID');
        $sales = DB::table('msSales')->get();
        $courier = DB::table('msCourier')->get();
        $payment = DB::table('msPayment')->get();
        $product = DB::table('trInvoiceDetail')
                    ->join('msProduct', 'trInvoiceDetail.ProductID', '=', 'msProduct.ProductID')
                    ->select('trInvoiceDetail.*', 'msProduct.ProductName')
                    ->where('InvoiceNo', $invoiceNo)
                    ->get();

        DB::table('trInvoice')->where('InvoiceNo', $invoiceNo)->update([
            'InvoiceNo' => $invoiceNo,
            'InvoiceDate' => $invoiceDate,
            'InvoiceTo' => $to,
            'SalesID' => $salesID,
            'CourierID' => $courierID,
            'ShipTo' => $shipTo,
            'PaymentType' => $paymentID
        ]);

        $rawInvoice = DB::table('trInvoice')->where('InvoiceNo', $invoiceNo)->first();
        
        if($rawInvoice != null){
            $invoice = [
                'InvoiceNo' => $invoiceNo,
                'InvoiceDate' => $rawInvoice->InvoiceDate,
                'InvoiceTo' => $rawInvoice->InvoiceTo,
                'SalesName' => $salesName,
                'CourierName' => $courier,
                'ShipTo' => $rawInvoice->ShipTo,
                'PaymentType' => $paymentType,
                'CourierFee' => $rawInvoice->CourierFee,
                'Data' => [
                    'Sales' => $sales,
                    'Courier' => $courier,
                    'Payment' => $payment
                ],
                'Product' => $product
            ];
            
            return view('search', ['invoice' => $invoice]);
        }
        
        return view('index');
    }
}