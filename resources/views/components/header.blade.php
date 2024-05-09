<div>
    <div class="py-4 px-6 flex justify-end items-center bg-white">
        <div class="flex items-center gap-2">
            <div class="w-[45px] h-[45px] rounded-full">
                <svg width="45" height="46" viewBox="0 0 45 46" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <rect y="0.5" width="45" height="45" rx="22.5" fill="url(#pattern0_4537_738)"/>
                    <defs>
                    <pattern id="pattern0_4537_738" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_4537_738" transform="scale(0.0005)"/>
                    </pattern>
                    </defs>
                </svg>
            </div>
            <div class="flex flex-col max-w-[120px]">
                <div class="text-[16px] font-normal text-[#232D42] truncate">
                    {{ optional(auth()->user())->name ?? 'User' }}
                </div>
                <div class="text-[13px] text-[#8A92A6] font-normal truncate">
                    {{$user->role->name ?? ''}}
                </div>
            </div>
        </div>
    </div>
</div>