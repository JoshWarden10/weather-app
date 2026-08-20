<template>
    <div class="bg-white rounded-md border border-gray-200">
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div class="w-full">
                    <p class="text-sm lg:text-base font-medium text-blue-400">Showing the current weather for:</p>
                    <h2 class="mt-1 text-lg sm:text-xl lg:text-2xl font-semibold text-gray-900 line-clamp-1"><i class="fas fa-location-dot text-blue-400"></i> {{ location.text }}</h2>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-8 mt-5">
                        <div class="flex flex-col gap-2">
                            <div class="flex items-start">
                                <span class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tight text-gray-900">{{ Math.round(weather.current.temperature_2m) }}°</span>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-500">Feels like {{ Math.round(weather.current.apparent_temperature) }}°</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <i :class="['fas', currentCondition.icon, currentCondition.colour]" class="text-3xl sm:text-4xl lg:text-5xl"></i>
                            <span class="text-xl sm:text-2xl lg:text-3xl font-medium text-gray-700">{{ currentCondition.label }}</span>
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
                    <p class="text-base sm:text-lg mt-1 font-semibold text-gray-800">{{ weather.current.relative_humidity_2m }}%</p>
                </div>

                <div class="flex justify-center items-center flex-col gap-1">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Wind speed</p>
                    <p class="text-base sm:text-lg mt-1 font-semibold text-gray-800">{{ weather.current.wind_speed_10m }} {{ weather.current_units.wind_speed_10m }}</p>
                </div>

                <div class="flex justify-center items-center flex-col gap-1">
                    <p class="text-xs sm:text-sm font-medium text-gray-500">Precipitation</p>
                    <p class="text-base sm:text-lg mt-1 font-semibold text-gray-800">{{ weather.current.precipitation }} {{ weather.current_units.precipitation }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { getWeatherCondition } from '../../utils/weather';

    export default {
        props: {
            weather: {
                type: Object,
                required: true
            },

            location: {
                type: Object,
                required: true
            }
        },

        computed: {
            currentCondition: function()
            {
                return getWeatherCondition(
                    this.weather.current.weather_code
                );
            }
        }
    }
</script>
