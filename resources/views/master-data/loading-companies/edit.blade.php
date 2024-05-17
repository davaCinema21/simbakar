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
                        Edit Perusahaan Bongkar Muat
                    </div>
                    <div class="mb-4 text-[16px] text-[#6C757D] font-normal no-select">
                        <a href="{{ route('administration.dashboard') }}">Home</a> / <a href="{{ route('master-data.load-companies.index') }}" class="cursor-pointer">Perusahaan Bongkar Muat</a>  / <span class="text-[#2E46BA] cursor-pointer">Update</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-6">
                <form onsubmit="return confirmSubmit(this, 'Update Perusahaan Bongkar Muat?')" action="{{ route('master-data.load-companies.update', ['uuid' => $load_company->uuid]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-4 bg-white rounded-lg w-full">
                        <div class="lg:flex items-center justify-between">
                            <div class="w-full">
                                <label for="name" class="font-bold text-[#232D42] text-[16px]">Nama Perusahaan Bongkar Muat</label>
                                <div class="relative">
                                    <input type="text" name="name" value="{{ old('name') ? old('name') : $load_company->name }}" class="w-full lg:w-[300px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                    @error('name')
                                    <div class="absolute -bottom-1 left-1 text-red-500">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="lg:flex items-center justify-between">
                            <div class="w-full">
                                <label for="phone" class="font-bold text-[#232D42] text-[16px]">Telp</label>
                                <div class="relative">
                                    <input type="text" name="phone" value="{{ old('phone') ? old('phone') : $load_company->phone }}" class="w-full lg:w-[300px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                    @error('phone')
                                    <div class="absolute -bottom-1 left-1 text-red-500">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="w-full">
                                <label for="fax" class="font-bold text-[#232D42] text-[16px]">Fax</label>
                                <div class="relative">
                                    <input type="text" name="fax" value="{{ old('fax') ? old('fax') : $load_company->fax }}" class="w-full lg:w-[300px] border rounded-md mt-3 mb-5 h-[40px] px-3">
                                    @error('fax')
                                    <div class="absolute -bottom-1 left-1 text-red-500">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="lg:flex items-center justify-between">
                            <div class="w-full">
                                <label for="address" class="font-bold text-[#232D42] text-[16px]">Alamat</label>
                                <div class="relative">
                                    <textarea name="address" value="{{ old('address') }}" style="height:150px" class="w-full lg:w-[300px] border rounded-md mt-3 mb-5 h-[40px] px-3">{{ old('address') ? old('address') : $load_company->address }}</textarea>
                                    @error('address')
                                    <div class="absolute -bottom-1 left-1 text-red-500">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <a href="{{route('master-data.load-companies.index')}}" class="bg-[#C03221] w-full lg:w-[300px] py-3 text-[white] text-[16px] font-semibold rounded-lg mt-3 px-3">Back</a>
                        <button class="bg-[#2E46BA] w-full lg:w-[300px] py-3 text-[white] text-[16px] font-semibold rounded-lg mt-3">Update Perusahaan Bongkar Muat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
