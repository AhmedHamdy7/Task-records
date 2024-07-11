<?php

namespace App\Http\Controllers;
use exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ExchangeManageController extends Controller
{
    public function create(Request $request)
    {
        $currency = $request->input('currency');
        $rate = $request->input('rate');
        $exchangeRates = config('exchange');
        if (!array_key_exists($currency, $exchangeRates)) {
            $exchangeRates[$currency] = $rate;
            File::put(config_path('exchange_rates.json'), json_encode($exchangeRates, JSON_PRETTY_PRINT));
        }

        return redirect()->route('exchange.index')->with('success', 'Exchange rate added successfully.');
    }
    public function index()
        {
        $exchangeRates = config('exchange');
        return view('exchange.index', compact('exchangeRates'));
        }

        public function update(Request $request, $currency)
        {
            $newRate = $request->input('rate');
            $exchangeRates = config('exchange');

            if (array_key_exists($currency, $exchangeRates)) {
                $exchangeRates[$currency] = $newRate;
                File::put(config_path('exchange_rates.json'), json_encode($exchangeRates, JSON_PRETTY_PRINT));
            }

            return redirect()->route('exchange.index')->with('success', 'Exchange rate updated successfully.');
        }

        public function delete($currency)
    {
        $exchangeRates = config('exchange');

        if (array_key_exists($currency, $exchangeRates)) {
            unset($exchangeRates[$currency]);
            File::put(config_path('exchange_rates.json'), json_encode($exchangeRates, JSON_PRETTY_PRINT));
        }

        return redirect()->route('exchange.index')->with('success', 'Exchange rate deleted successfully.');
    }
}
