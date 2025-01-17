@extends('layouts.app')

@section('content')
<div x-data="{sidebar:true}" class="w-screen h-screen flex bg-[#E9ECEF] overflow-auto hide-scrollbar">
    @include('components.sidebar')
    <div :class="sidebar?'w-10/12' : 'w-full'">
        @include('components.header')
        <div class="w-full py-10 px-8">
            <div class="flex items-end justify-between mb-2">
                <div>
                    <div class="text-[#135F9C] text-[40px] font-bold">
                        Ubah Loading
                    </div>
                    <div class="mb-4 text-[16px] text-[#6C757D] font-normal no-select">
                         <a href="{{ route('administration.dashboard') }}">Home</a> / <a href="{{ route('inputs.analysis.loadings.index') }}">Analisa</a> / <a href="{{ route('inputs.analysis.loadings.index') }}" class="cursor-pointer">Loading</a>  / <span class="text-[#2E46BA] cursor-pointer">Update</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-6">
                <form onsubmit="return confirmSubmit(this, 'Edit Loading?')" action="{{ route('inputs.analysis.loadings.update', ['id' => $loading->id]) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="p-4 bg-white rounded-lg w-full">
                        <div class="w-full">
                            <div class="w-full">
                                <label for="contract_uuid" class="font-bold text-[#232D42] text-[16px]">No Kontrak</label>
                                <div class="relative">
                                    <select name="contract_uuid" id="contract_uuid" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        <option value="">Pilih</option>
                                        @foreach ($contracts as $item)
                                            <option value="{{ $item->uuid }}" {{ old('contract_uuid', $loading->contract_uuid ?? '') == $item->uuid ? 'selected' : '' }}>{{ $item->contract_number }}</option>
                                        @endforeach
                                    </select>
                                    @error('contract_uuid')
                                    <div class="absolute -bottom-1 left-1 text-red-500">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="start_loading" class="font-bold text-[#232D42] text-[16px]">Tanggal Mulai Loading</label>
                                    <div class="relative">
                                        <input type="datetime-local" name="start_loading" value="{{ old('start_loading', $loading->start_loading ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('start_loading')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="end_loading" class="font-bold text-[#232D42] text-[16px]">Tanggal Selesai Loading</label>
                                    <div class="relative">
                                        <input type="datetime-local" name="end_loading" value="{{ old('end_loading', $loading->end_loading ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('end_loading')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="analysis_number" class="font-bold text-[#232D42] text-[16px]">No Analisa</label>
                                    <div class="relative">
                                        <input type="text" name="analysis_number" value="{{ old('analysis_number', $loading->analysis_number ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('analysis_number')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="analysis_date" class="font-bold text-[#232D42] text-[16px]">Tanggal Analisa</label>
                                    <div class="relative">
                                        <input type="date" name="analysis_date" value="{{ old('analysis_date', $loading->analysis_date ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('analysis_date')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="bill_of_ladding" class="font-bold text-[#232D42] text-[16px]">Bill of Ladding (BL) ( Kg )</label>
                                    <div class="relative">
                                        <input type="text" name="bill_of_ladding" value="{{ old('bill_of_ladding', $loading->bill_of_ladding ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('bill_of_ladding')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="surveyor_uuid" class="font-bold text-[#232D42] text-[16px]">Surveyor</label>
                                    <div class="relative">
                                        <select name="surveyor_uuid" id="surveyor_uuid" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                            <option value="">Pilih</option>
                                            @foreach ($surveyors as $item)
                                            <option value="{{ $item->uuid }}" {{ old('surveyor_uuid', $loading->surveyor_uuid ?? '') == $item->uuid ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('surveyor_uuid')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="origin_of_goods" class="font-bold text-[#232D42] text-[16px]">Asal Barang</label>
                                    <div class="relative">
                                        <input type="text" name="origin_of_goods" value="{{ old('origin_of_goods', $loading->origin_of_goods ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('origin_of_goods')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="ship_uuid" class="font-bold text-[#232D42] text-[16px]">Kapal</label>
                                    <div class="relative">
                                        <select name="ship_uuid" id="ship_uuid" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                            <option value="">Pilih</option>
                                            @foreach ($ships as $item)
                                            <option value="{{ $item->uuid }}" {{ old('ship_uuid', $loading->ship_uuid ?? '') == $item->uuid ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('ship_uuid')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-4">
                            <div class="w-full py-2 text-center text-white bg-[#2E46BA] mb-4">
                                Proximate Analysis (ASTM D-3172)
                            </div>
                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="moisture_total" class="font-bold text-[#232D42] text-[16px]">Total Moisture</label>
                                    <div class="relative">
                                        <input type="text" name="moisture_total" value="{{ old('moisture_total', $loading->moisture_total ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('moisture_total')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="air_dried_moisture" class="font-bold text-[#232D42] text-[16px]">Air Dried Moisture</label>
                                    <div class="relative">
                                        <input type="text" name="air_dried_moisture" value="{{ old('air_dried_moisture', $loading->air_dried_moisture ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('air_dried_moisture')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="ash" class="font-bold text-[#232D42] text-[16px]">Ash</label>
                                    <div class="relative">
                                        <input type="text" name="ash" value="{{ old('ash', $loading->ash ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('ash')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="volatile_matter" class="font-bold text-[#232D42] text-[16px]">Volatile Matter</label>
                                    <div class="relative">
                                        <input type="text" name="volatile_matter" value="{{ old('volatile_matter', $loading->volatile_matter ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('volatile_matter')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="fixed_carbon" class="font-bold text-[#232D42] text-[16px]">Fixed Carbon</label>
                                    <div class="relative">
                                        <input type="text" name="fixed_carbon" value="{{ old('fixed_carbon', $loading->fixed_carbon ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('fixed_carbon')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="total_sulfur" class="font-bold text-[#232D42] text-[16px]">Total Sulfur</label>
                                    <div class="relative">
                                        <input type="text" name="total_sulfur" value="{{ old('total_sulfur', $loading->total_sulfur ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('total_sulfur')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="calorivic_value" class="font-bold text-[#232D42] text-[16px]">Calorivic Value</label>
                                    <div class="relative">
                                        <input type="text" name="calorivic_value" value="{{ old('calorivic_value', $loading->calorivic_value ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('calorivic_value')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-4">
                            <div class="w-full py-2 text-center text-white bg-[#2E46BA] mb-4">
                                Ultimate Analysis (ASTM D-3176)
                            </div>
                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="carbon" class="font-bold text-[#232D42] text-[16px]">Carbon</label>
                                    <div class="relative">
                                        <input type="text" name="carbon" value="{{ old('carbon', $loading->carbon ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('carbon')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="hydrogen" class="font-bold text-[#232D42] text-[16px]">Hydrogen</label>
                                    <div class="relative">
                                        <input type="text" name="hydrogen" value="{{ old('hydrogen', $loading->hydrogen ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('hydrogen')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="nitrogen" class="font-bold text-[#232D42] text-[16px]">Nitrogen</label>
                                    <div class="relative">
                                        <input type="text" name="nitrogen" value="{{ old('nitrogen', $loading->nitrogen ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('nitrogen')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="oxygen" class="font-bold text-[#232D42] text-[16px]">Oxygen</label>
                                    <div class="relative">
                                        <input type="text" name="oxygen" value="{{ old('oxygen', $loading->oxygen ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('oxygen')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-4">
                            <div class="w-full py-2 text-center text-white bg-[#2E46BA] mb-4">
                                Ash Fussion Temperature (ASTM D-1857)
                            </div>
                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="initial_deformation" class="font-bold text-[#232D42] text-[16px]">Initial Deformation</label>
                                    <div class="relative">
                                        <input type="text" name="initial_deformation" value="{{ old('initial_deformation', $loading->initial_deformation ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('initial_deformation')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="softening" class="font-bold text-[#232D42] text-[16px]">Softening</label>
                                    <div class="relative">
                                        <input type="text" name="softening" value="{{ old('softening', $loading->softening ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('softening')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="hemispherical" class="font-bold text-[#232D42] text-[16px]">Hemispherical</label>
                                    <div class="relative">
                                        <input type="text" name="hemispherical" value="{{ old('hemispherical', $loading->hemispherical ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('hemispherical')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="fluid" class="font-bold text-[#232D42] text-[16px]">Fluid</label>
                                    <div class="relative">
                                        <input type="text" name="fluid" value="{{ old('fluid', $loading->fluid ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('fluid')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-4">
                            <div class="w-full py-2 text-center text-white bg-[#2E46BA] mb-4">
                                Ash Analysis (ASTM D-3682)
                            </div>
                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="sio2" class="font-bold text-[#232D42] text-[16px]">SiO2</label>
                                    <div class="relative">
                                        <input type="text" name="sio2" value="{{ old('sio2', $loading->sio2 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('sio2')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="al2o3" class="font-bold text-[#232D42] text-[16px]">Al2O3</label>
                                    <div class="relative">
                                        <input type="text" name="al2o3" value="{{ old('al2o3', $loading->al2o3 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('al2o3')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="fe2o3" class="font-bold text-[#232D42] text-[16px]">Fe2O3</label>
                                    <div class="relative">
                                        <input type="text" name="fe2o3" value="{{ old('fe2o3', $loading->fe2o3 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('fe2o3')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="cao" class="font-bold text-[#232D42] text-[16px]">CaO</label>
                                    <div class="relative">
                                        <input type="text" name="cao" value="{{ old('cao', $loading->cao ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('cao')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="mgo" class="font-bold text-[#232D42] text-[16px]">MgO</label>
                                    <div class="relative">
                                        <input type="text" name="mgo" value="{{ old('mgo', $loading->mgo ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('mgo')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="na2o" class="font-bold text-[#232D42] text-[16px]">Na2O</label>
                                    <div class="relative">
                                        <input type="text" name="na2o" value="{{ old('na2o', $loading->na2o ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('na2o')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="k2o" class="font-bold text-[#232D42] text-[16px]">K2O</label>
                                    <div class="relative">
                                        <input type="text" name="k2o" value="{{ old('k2o', $loading->k2o ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('k2o')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="tlo2" class="font-bold text-[#232D42] text-[16px]">TlO2</label>
                                    <div class="relative">
                                        <input type="text" name="tlo2" value="{{ old('tlo2', $loading->tlo2 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('tlo2')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="so3" class="font-bold text-[#232D42] text-[16px]">SO3</label>
                                    <div class="relative">
                                        <input type="text" name="so3" value="{{ old('so3', $loading->so3 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('so3')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="p2o5" class="font-bold text-[#232D42] text-[16px]">P2O5</label>
                                    <div class="relative">
                                        <input type="text" name="p2o5" value="{{ old('p2o5', $loading->p2o5 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('p2o5')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="mn3o4" class="font-bold text-[#232D42] text-[16px]">Mn3O4</label>
                                    <div class="relative">
                                        <input type="text" name="mn3o4" value="{{ old('mn3o4', $loading->mn3o4 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('mn3o4')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full mt-4">
                            <div class="w-full py-2 text-center text-white bg-[#2E46BA] mb-4">
                                Ukuran Butiran Batubara (ASTM D-197)
                            </div>
                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="butiran_70" class="font-bold text-[#232D42] text-[16px]">Butiran > 70 mm</label>
                                    <div class="relative">
                                        <input type="text" name="butiran_70" value="{{ old('butiran_70', $loading->butiran_70 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('butiran_70')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="butiran_50" class="font-bold text-[#232D42] text-[16px]">Butiran > 50 mm</label>
                                    <div class="relative">
                                        <input type="text" name="butiran_50" value="{{ old('butiran_50', $loading->butiran_50 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('butiran_50')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="butiran_32_50" class="font-bold text-[#232D42] text-[16px]">Butiran 32 - 50 mm</label>
                                    <div class="relative">
                                        <input type="text" name="butiran_32_50" value="{{ old('butiran_32_50', $loading->butiran_32_50 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('butiran_32_50')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="butiran_32" class="font-bold text-[#232D42] text-[16px]">Butiran < 32 mm</label>
                                    <div class="relative">
                                        <input type="text" name="butiran_32" value="{{ old('butiran_32', $loading->butiran_32 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('butiran_32')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="butiran_238" class="font-bold text-[#232D42] text-[16px]">Butiran < 2,38 mm</label>
                                    <div class="relative">
                                        <input type="text" name="butiran_238" value="{{ old('butiran_238', $loading->butiran_238 ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('butiran_238')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="w-full py-2 text-center text-white bg-[#2E46BA] mb-4">
                                Lain-Lain
                            </div>
                            <div class="w-full flex gap-4">
                                <div class="w-full">
                                    <label for="hgi" class="font-bold text-[#232D42] text-[16px]">HGI</label>
                                    <div class="relative">
                                        <input type="text" name="hgi" value="{{ old('hgi', $loading->hgi ?? '') }}" class="w-full border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('hgi')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('inputs.analysis.loadings.index') }}" class="bg-[#C03221] w-full lg:w-[300px] py-3 text-[white] text-[16px] font-semibold rounded-lg mt-3 px-3">Back</a>
                        <button class="bg-[#2E46BA] w-full lg:w-[300px] py-3 text-[white] text-[16px] font-semibold rounded-lg mt-3">Edit Loading</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
