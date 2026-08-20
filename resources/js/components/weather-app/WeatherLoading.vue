<template>
    <div class="bg-white rounded-md border border-gray-200">
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div class="w-full">
                    <div class="h-5 lg:h-6 w-40 sm:w-56 animate-pulse rounded-sm bg-gray-200"></div>
                    <div class="mt-1 h-7 sm:h-8 lg:h-9 w-3/4 sm:w-80 lg:w-96 max-w-full animate-pulse rounded-sm bg-gray-200"></div>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-8 mt-5">
                        <div class="flex flex-col gap-2">
                            <div class="flex items-start">
                                <div class="h-10 w-14 sm:h-12 sm:w-16 lg:h-16 lg:w-20 animate-pulse rounded-sm bg-gray-200"></div>
                            </div>
                            <div class="h-4 sm:h-5 w-16 sm:w-20 animate-pulse rounded-sm bg-gray-200"></div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="h-8 w-10 sm:h-10 sm:w-12 lg:h-12 lg:w-16 animate-pulse rounded-sm bg-gray-200"></div>
                            <div class="h-6 w-24 sm:h-7 sm:w-28 lg:h-9 lg:w-32 animate-pulse rounded-sm bg-gray-200"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full border-t border-gray-200"></div>
        <div class="p-6">
            <div class="grid grid-cols-3 gap-4">
                <div class="flex justify-center items-center flex-col gap-1">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Humidity</p>
                    <div class="h-6 sm:h-7 w-8 sm:w-9 animate-pulse bg-gray-200 rounded-sm mt-1"></div>
                </div>

                <div class="flex justify-center items-center flex-col gap-1">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Wind speed</p>
                    <div class="h-6 sm:h-7 w-16 sm:w-20 animate-pulse bg-gray-200 rounded-sm mt-1"></div>
                </div>

                <div class="flex justify-center items-center flex-col gap-1">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Precipitation</p>
                    <div class="h-6 sm:h-7 w-10 sm:w-12 animate-pulse bg-gray-200 rounded-sm mt-1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white rounded-md border border-gray-200">
        <div class="p-6">
            <h2 class="text-base sm:text-lg lg:text-xl font-semibold text-gray-900">Next 24 hours</h2>
            <p class="mt-1 text-xs sm:text-sm text-gray-500">Temperature forecast</p>

            <div class="mt-4 sm:mt-6 flex flex-col h-75">
                <div class="flex-1 animate-pulse rounded-sm bg-gray-200"></div>

                <div class="mt-3 flex items-center justify-between">
                    <div v-for="label in 6" :key="label" class="h-3 w-8 animate-pulse rounded-sm bg-gray-200"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white rounded-md border border-gray-200">
        <div class="pt-6">
            <h2 class="text-base sm:text-lg lg:text-xl font-semibold text-gray-900 px-6">Upcoming 5-day forecast</h2>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-5 border-t border-t-gray-200">
                <div v-for="day in 5" :key="day" class="flex flex-col items-center text-center px-4 py-5" :class="{'border-t sm:border-t-0 sm:border-l border-gray-200': day > 1}">
                    <div class="h-5 w-12 animate-pulse rounded-sm bg-gray-200"></div>
                    <div class="mt-1 h-4 w-16 animate-pulse rounded-sm bg-gray-200"></div>
                    <div class="mt-5 h-10 w-10 animate-pulse rounded-sm bg-gray-200"></div>
                    <div class="mt-3 h-4 w-20 animate-pulse rounded-sm bg-gray-200"></div>

                    <div class="mt-4 flex items-center gap-2">
                        <div class="h-6 w-8 animate-pulse rounded-sm bg-gray-200"></div>
                        <div class="h-6 w-8 animate-pulse rounded-sm bg-gray-200"></div>
                    </div>

                    <div class="mt-3 h-4 w-12 animate-pulse rounded-sm bg-gray-200"></div>
                </div>
            </div>
        </div>
    </div>
</template>
