@extends('layouts.app')

@section('content')
{{-- @if(old() != null)
@dd($errors->all())
@endif --}}
<div x-data="{sidebar:true}" class="w-screen h-screen flex bg-[#E9ECEF] overflow-auto hide-scrollbar">
    @include('components.sidebar')
    <div :class="sidebar?'w-10/12' : 'w-full'">
        @include('components.header')
        <div class="w-full py-10 px-8">
            <div class="flex items-end justify-between mb-2">
                <div>
                    <div class="text-[#135F9C] text-[40px] font-bold">
                        Tambah Pemakaian BBM
                    </div>
                    <div class="mb-4 text-[16px] text-[#6C757D] font-normal no-select">
                        <a href="{{ route('administration.dashboard') }}">Home</a> / <a href="{{ route('inputs.bbm_usage.index') }}">Pemakaian BBM</a> / <span class="text-[#2E46BA] cursor-pointer">Create</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-6">
                <form onsubmit="return confirmSubmit(this, 'Tambahkan Pemakaian BBM?')" action="{{ route('inputs.bbm_usage.store') }}" method="POST">
                    @csrf
                    <div class="p-4 bg-white rounded-lg w-full">
                        <div class="w-full">
                            <div class="w-full">
                                <label for="bbm_use_for" class="font-bold text-[#232D42] text-[16px]">Peruntukkan BBM</label>
                                <div class="relative">
                                    <select name="bbm_use_for" id="bbm_use_for" onchange="toggleBbmUseFor()" class="w-full lg:w-[600px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        <option value="">Pilih</option>
                                        <option value="unit" {{ old('bbm_use_for') == "unit" ? 'selected' : '' }}>Unit</option>
                                        <option value="heavy_equipment" {{ old('bbm_use_for') == 'heavy_equipment' ? 'selected' : '' }}>Alat Berat</option>
                                        <option value="other" {{ old('bbm_use_for') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('bbm_use_for')
                                    <div class="absolute -bottom-1 left-1 text-red-500">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="w-full">
                            <div class="w-full py-2 text-center text-white bg-[#2E46BA] mb-4">
                                Detail TUG9
                            </div>
                            <div class="w-full flex">
                                <div class="w-full">
                                    <label for="tug9_number" class="font-bold text-[#232D42] text-[16px]">No TUG9</label>
                                    <div class="relative">
                                        <input type="text" name="tug9_number" value="{{ old('tug9_number') }}" class="w-full lg:w-[600px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('tug9_number')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full">
                                    <label for="use_date" class="font-bold text-[#232D42] text-[16px]">Tanggal Pakai</label>
                                    <div class="relative">
                                        <input type="date" name="use_date" value="{{ old('use_date') }}" class="w-full lg:w-[600px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('use_date')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="w-full">
                                    <label for="amount" class="font-bold text-[#232D42] text-[16px]">Jumlah Pakai</label>
                                    <div class="relative">
                                        <input type="text" name="amount" value="{{ old('amount') }}" class="w-full lg:w-[600px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('amount')
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
                                Pemakaian BBM
                            </div>
                            <div class="w-full flex">
                                <div class="w-full">
                                    <label for="bbm_type" class="font-bold text-[#232D42] text-[16px]">Jenis BBM</label>
                                    <div class="relative">
                                        <select name="bbm_type" id="bbm_type" class="w-full lg:w-[600px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                            <option value="">Pilih</option>
                                            <option value="solar" {{ old('bbm_type') == "solar" ? 'selected' : '' }}>Solar/HSD</option>
                                            <option value="residu" {{ old('bbm_type') == 'residu' ? 'selected' : '' }}>Residu</option>
                                        </select>
                                        @error('bbm_type')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                               <div class="w-full">
                                    <label for="bunker_uuid" class="font-bold text-[#232D42] text-[16px]">Diambil dari Bunker</label>
                                    <div class="relative">
                                        <select name="bunker_uuid" id="bunker_uuid" class="w-full lg:w-[600px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                            <option value="">Pilih</option>
                                            @foreach ($bunkers as $item)
                                                <option value="{{ $item->uuid }}" {{ old('bunker_uuid') == $item->uuid ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('bunker_uuid')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="w-full only-unit">
                                    <label for="unit_uuid" class="font-bold text-[#232D42] text-[16px]">Unit</label>
                                    <div class="relative">
                                        <select name="unit_uuid" id="unit_uuid" class="w-full lg:w-[600px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                            <option value="">Pilih</option>
                                            @foreach ($units as $item)
                                                <option value="{{ $item->uuid }}" {{ old('unit_uuid') == $item->uuid ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit_uuid')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-full only-heavy-equipment">
                                    <label for="heavy_equipment_uuid" class="font-bold text-[#232D42] text-[16px]">Albes</label>
                                    <div class="relative">
                                        <select name="heavy_equipment_uuid" id="heavy_equipment_uuid" class="w-full lg:w-[600px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                            <option value="">Pilih</option>
                                            @foreach ($heavy_equipments as $item)
                                                <option value="{{ $item->uuid }}" {{ old('heavy_equipment_uuid') == $item->uuid ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('heavy_equipment_uuid')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="w-full only-other">
                                    <label for="description" class="font-bold text-[#232D42] text-[16px]">Keterangan</label>
                                    <div class="relative">
                                        <input type="text" name="description" value="{{ old('description') }}" class="w-full lg:w-[600px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                        @error('description')
                                        <div class="absolute -bottom-1 left-1 text-red-500">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('inputs.bbm_usage.index') }}" class="bg-[#C03221] w-full lg:w-[300px] py-3 text-[white] text-[16px] font-semibold rounded-lg mt-3 px-3">Back</a>
                        <button class="bg-[#2E46BA] w-full lg:w-[300px] py-3 text-[white] text-[16px] font-semibold rounded-lg mt-3">Tambah Pemakaian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function toggleBbmUseFor() {
    var bbm_use_for = document.getElementById('bbm_use_for').value;
    var unitElements = document.querySelectorAll('.only-unit');
    var heavyEquipmentElements = document.querySelectorAll('.only-heavy-equipment');
    var otherElements = document.querySelectorAll('.only-other');

    if (bbm_use_for === 'unit') {
        unitElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        heavyEquipmentElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        otherElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    } else if (bbm_use_for === 'heavy_equipment') {
        heavyEquipmentElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
        unitElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        otherElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    }else if (bbm_use_for === 'other') {
        heavyEquipmentElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        unitElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        otherElements.forEach(function(element) {
            element.classList.remove('hidden');
        });
    } else {
        unitElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        heavyEquipmentElements.forEach(function(element) {
            element.classList.add('hidden');
        });
        otherElements.forEach(function(element) {
            element.classList.add('hidden');
        });
    }

}

// Panggil fungsi ini saat halaman dimuat untuk memastikan elemen disembunyikan/ditampilkan dengan benar berdasarkan nilai yang disimpan
document.addEventListener('DOMContentLoaded', function() {
    toggleBbmUseFor();
});
</script>

@endsection