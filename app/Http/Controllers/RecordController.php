<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index()
    {
        $exchangeRates = config('exchange');
        $records = Record::all();

        foreach ($records as $record) {
            $record->exchange_value = $record->amount * $exchangeRates[$record->currency];
        }

        return view('records.index', compact('records', 'exchangeRates'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'currency' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        Record::create([
            'user_id' => auth()->user()->id,
            'currency' => $request->currency,
            'amount' => $request->amount,
        ]);

        return redirect()->route('records.index')->with('success', 'Record added successfully.');
    }

    public function edit($id)
    {
        $exchangeRates = config('exchange');
        $record = Record::find($id);

        if (!$record) {
            return redirect()->route('records.index')->with('error', 'Record not found.');
        }

        return view('records.edit', compact('record', 'exchangeRates'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'currency' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $record = Record::find($id);

        if (!$record) {
            return redirect()->route('records.index')->with('error', 'Record not found.');
        }

        $record->currency = $request->currency;
        $record->amount = $request->amount;
        $record->user_id = auth()->user()->id;
        $record->save();

        return redirect()->route('records.index')->with('success', 'Record updated successfully.');
    }


    public function destroy($id)
    {
        $record = Record::find($id);
        if (!$record) {
            return redirect()->route('records.index')->with('error', 'Record not found.');
        }

        $record->delete();

        return redirect()->route('records.index')->with('success', 'Record deleted successfully.');
    }
}
