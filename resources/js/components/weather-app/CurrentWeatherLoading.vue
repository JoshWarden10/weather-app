<template>
    <div class="bg-white rounded-md border border-gray-200">
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div class="w-full">
                    <div class="h-6 w-56 animate-pulse rounded-sm bg-gray-200"></div>
                    <div class="mt-1 h-8 w-96 animate-pulse rounded-sm bg-gray-200"></div>
                    <div class="flex items-center gap-8 mt-5">
                        <div class="flex flex-col gap-2">
                            <div class="flex items-start">
                                <div class="h-16 w-20 animate-pulse rounded-sm bg-gray-200"></div>
                            </div>
                            <div class="h-5 w-20 animate-pulse rounded-sm bg-gray-200"></div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="h-12 w-16 animate-pulse rounded-sm bg-gray-200"></div>
                            <div class="h-9 w-32 animate-pulse rounded-sm bg-gray-200"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full border-t border-gray-200"></div>
        <div class="p-6">
            <div class="grid grid-cols-3 gap-4">
                <div class="flex justify-center items-center flex-col gap-1">
                    <p class="text-sm font-medium text-gray-500">Humidity</p>
                    <div class="h-7 w-9 animate-pulse bg-gray-200 rounded-sm mt-1"></div>
                </div>

                <div class="flex justify-center items-center flex-col gap-1">
                    <p class="text-sm font-medium text-gray-500">Wind speed</p>
                    <div class="h-7 w-20 animate-pulse bg-gray-200 rounded-sm mt-1"></div>
                </div>

                <div class="flex justify-center items-center flex-col gap-1">
                    <p class="text-sm font-medium text-gray-500">Precipitation</p>
                    <div class="h-7 w-12 animate-pulse bg-gray-200 rounded-sm mt-1"></div>
                </div>
            </div>
        </div>
    </div>
</template>
