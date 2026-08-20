<template>
    <div class="mt-6 bg-white rounded-md border border-gray-200">
        <div class="pt-6">
            <h2 class="text-xl font-semibold text-gray-900 px-6">Upcoming 5-day forecast</h2>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-5 border-t border-t-gray-200">
                <div v-for="(day, index) in forecastDays" :key="day.date" class="flex flex-col items-center text-center px-4 py-5" :class="{'border-t sm:border-t-0 sm:border-l border-gray-200': index > 0}" >
                    <p class="font-semibold text-gray-800">{{ index === 0 ? 'Today' : day.day }}</p>
                    <p class="mt-1 text-sm text-gray-400">{{ day.formattedDate }}</p>
                    <i :class="['fas', day.condition.icon, day.condition.colour]" class="mt-5 text-4xl"></i>
                    <p class="mt-3 text-sm font-medium text-gray-600">{{ day.condition.label }}</p>

                    <div class="mt-4 flex items-center gap-2">
                        <span class="text-lg font-semibold text-gray-900">{{ Math.round(day.maxTemperature) }}°</span>
                        <span class="text-lg text-gray-400">{{ Math.round(day.minTemperature) }}°</span>
                    </div>

                    <div class="mt-3 flex items-center gap-1.5 text-sm text-blue-400">
                        <i class="fas fa-droplet"></i>
                        <span>{{ day.precipitationProbability }}%</span>
                    </div>
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
        }
    },

    computed: {
        forecastDays: function()
        {
            return this.weather.daily.time.map((date, index) => {
                return {
                    date: date,

                    day: this.formatDate(date, {
                        weekday: 'short'
                    }),

                    formattedDate: this.formatDate(date, {
                        day: 'numeric',
                        month: 'short'
                    }),

                    condition: getWeatherCondition(
                        this.weather.daily.weather_code[index]
                    ),

                    maxTemperature:
                        this.weather.daily.temperature_2m_max[index],

                    minTemperature:
                        this.weather.daily.temperature_2m_min[index],

                    precipitationProbability:
                        this.weather.daily.precipitation_probability_max[index]
                };
            });
        }
    },

    methods: {
        formatDate: function(date, options)
        {
            const [year, month, day] = date.split('-');

            const parsedDate = new Date(
                Date.UTC(year, month - 1, day)
            );

            return parsedDate.toLocaleDateString(
                'en-GB',
                {
                    ...options,
                    timeZone: 'UTC'
                }
            );
        }
    }
}
</script>