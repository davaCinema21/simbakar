<?php

namespace App\Http\Controllers\Settings\Variabels;

use Illuminate\Http\Request;
use App\Models\ElectricKwhPrice;
use App\Http\Controllers\Controller;

class ElectricKwhPriceController extends Controller
{
    public function index(Request $request)
    {
        $electrics = ElectricKwhPrice::query();

        $electrics->when($request->year, function ($query) use ($request) {
            $query->whereYear('start_date', $request->year);
        });
      
        $data['electrics'] = $electrics->paginate(10)->appends(request()->query());
        return view('settings.variabels.electric-kwh-prices.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.variabels.electric-kwh-prices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'price' => 'required',
        ], [
            'start_date.required' => 'Tanggal Mulai wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
        ]);

        ElectricKwhPrice::create([
            'start_date' => $request->start_date,
            'price' => $request->price
        ]);

        return redirect(route('settings.electric-kwh-prices.index'))->with('success', 'Tarif Listrik KWH Meter baru berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ElectricKwhPrice  $ElectricKwhPrice
     * @return \Illuminate\Http\Response
     */
    public function show(ElectricKwhPrice $ElectricKwhPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ElectricKwhPrice  $ElectricKwhPrice
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $data['electric'] = ElectricKwhPrice::where('uuid', $uuid)->first();
        return view('settings.variabels.electric-kwh-prices.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ElectricKwhPrice  $ElectricKwhPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'start_date' => 'required',
            'price' => 'required',
        ], [
            'start_date.required' => 'Tanggal Mulai wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
        ]);

        ElectricKwhPrice::where('uuid',$uuid)->update([
            'start_date' => $request->start_date,
            'price' => $request->price
        ]);

        return redirect(route('settings.electric-kwh-prices.index'))->with('success', 'Tarif Listrik KWH Meter baru berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ElectricKwhPrice  $ElectricKwhPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        ElectricKwhPrice::where('uuid',$uuid)->first()->delete();

        return redirect(route('settings.electric-kwh-prices.index'))->with('success', 'Tarif Listrik KWH Meter baru berhasil di hapus.');
    }
}
