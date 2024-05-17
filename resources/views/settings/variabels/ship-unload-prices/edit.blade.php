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
                        Ubah Tarif Ship Unloader 
                    </div>
                    <div class="mb-4 text-[16px] text-[#6C757D] font-normal no-select">
                        <a href="{{ route('administration.dashboard') }}">Home</a> / <a href="{{ route('settings.ship-unload-prices.index') }}" class="cursor-pointer">Tarif Ship Unloader </a>  / <span class="text-[#2E46BA] cursor-pointer">Edit</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-6">
                <form onsubmit="return confirmSubmit(this, 'Ubah Tarif Ship Unloader ?')" action="{{ route('settings.ship-unload-prices.update',['uuid'=>$ship->uuid]) }}" method="POST">
                    @csrf
                    @method ('PUT')
                    <div class="p-4 bg-white rounded-lg w-full">
                        <div class="lg:flex items-center justify-between">
                            <div class="w-full">
                                <label for="name" class="font-bold text-[#232D42] text-[16px]">Tanggal Mulai</label>
                                <div class="relative">
                                    <input type="date" name="start_date" value="{{ $ship->start_date }}" class="w-full lg:w-[300px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                    @error('start_date')
                                    <div class="absolute -bottom-1 left-1 text-red-500">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="price" class="font-bold text-[#232D42] text-[16px]">Harga</label>
                                <div class="relative">
                                    <input type="number" name="price" value="{{ $ship->price }}" class="w-full lg:w-[300px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                    @error('price')
                                    <div class="absolute -bottom-1 left-1 text-red-500">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('settings.ship-unload-prices.index') }}" class="bg-[#C03221] w-full lg:w-[300px] py-3 text-[white] text-[16px] font-semibold rounded-lg mt-3 px-3">Back</a>
                        <button class="bg-[#2E46BA] w-full lg:w-[300px] py-3 text-[white] text-[16px] font-semibold rounded-lg mt-3">Ubah Tarif Ship Unloader </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
