<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Records;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $th30 = (new Carbon)->subDays(30)->startOfDay()->toDateString();
        $today =  (new Carbon)->addDays(1)->startOfDay()->toDateString();

        $record = Records::all();
        $closed = Records::where('closed', 'close')->get();
        $payment = Payment::all();
        $paymentLest30 = Payment::whereBetween('created_at', [$th30 . " 00:00:00", $today . " 00:00:00"])->get();

        return view('payment.index')->with(array('records' => $record, 'closed' => $closed, 'paymentLest30' => $paymentLest30, 'payments' => $payment));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $payment = Payment::create([
            'record_id' => $request->record,
            'amount' => $request->amount
        ]);
        return redirect()->back()->with(['success' => 'Payment Recorded Succesfully']);;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $record = Records::find($request->record);
        $record->amount = $request->amount;
        $record->save();
        return redirect()->back()->with(['success' => 'Payment Updated  Succesfully']);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $record = Records::find($id);
        $record->delete();
        return redirect('/records')->with(['success' => 'Record   Deleted']);;
    }

    public function search(Request $request)
    {
        $th30 = (new Carbon($request->start))->startOfDay()->toDateString();

        // $today =  (new Carbon())->now()->endOfDay()->toDateString();
        $today =  (new Carbon($request->to))->startOfDay()->toDateString();
        //
        $record = Records::all();
        $closed = Records::where('closed', 'closed')->get();
        $payment = Payment::all();
        $paymentLest30 = Payment::whereBetween('created_at', [$th30 . " 00:00:00", $today . " 00:00:00"])->get();
        $days = ['start' => $request->start, 'end' => $request->to];
        return view('payment.search')->with(array('records' => $record, 'closed' => $closed, 'paymentLest30' => $paymentLest30, 'payments' => $payment, 'days' => $days));
        //
    }
}
