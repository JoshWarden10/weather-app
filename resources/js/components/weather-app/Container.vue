<template>
    <div class="min-h-screen px-5 py-10 bg-gray-100">
        <div class="mx-auto max-w-6xl">
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold mb-5"><i class="fas fa-cloud bg-clip-text bg-gradient-to-r text-transparent from-blue-200 to-gray-400 mr-2"></i>JoshCorp Weather</h1>

            <SelectLocation
                v-model="selectedLocation"></SelectLocation>

            <div class="mt-6">
                <WeatherLoading v-if="loading"></WeatherLoading>

                <div v-else-if="error" class="rounded-md border border-red-200 bg-red-50 p-5">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-circle-exclamation text-red-400"></i>
                        <p class="font-medium text-red-700">{{ error }}</p>
                    </div>
                </div>
            </div>

            <template v-if="weather && selectedLocation">
                <CurrentWeather
                    :weather="weather"
                    :location="selectedLocation"></CurrentWeather>

                <HourlyForecast
                    :weather="weather"></HourlyForecast>

                <Forecast
                    :weather="weather"></Forecast>
            </template>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    import SelectLocation from './SelectLocation.vue';
    import CurrentWeather from './CurrentWeather.vue';
    import WeatherLoading from './WeatherLoading.vue';
    import Forecast from './Forecast.vue';
    import HourlyForecast from './HourlyForecast.vue';

    export default {
        components: {
            SelectLocation,
            CurrentWeather,
            WeatherLoading,
            Forecast,
            HourlyForecast
        },

        data: function()
        {
            return {
                selectedLocation: null,
                weather: null,
                loading: false,
                error: null
            };
        },

        watch: {
            selectedLocation: function(location)
            {
                if (!location)
                {
                    return;
                }

                localStorage.setItem(
                    'weatherLocation',
                    JSON.stringify(location)
                );

                this.fetchWeather();
            }
        },

        created()
        {
            const savedLocation = localStorage.getItem('weatherLocation');

            if (!savedLocation)
            {
                return;
            }

            try
            {
                this.selectedLocation = JSON.parse(savedLocation);
            }
            catch (error)
            {
                localStorage.removeItem('weatherLocation');
            }
        },

        methods: {
            fetchWeather: function()
            {
                this.loading = true;
                this.error = null;
                this.weather = null;

                axios.get('/weather/forecast', {
                    params: {
                        latitude: this.selectedLocation.latitude,
                        longitude: this.selectedLocation.longitude
                    }
                })
                    .then((response) =>
                    {
                        this.weather = response.data;
                    })
                    .catch(() =>
                    {
                        this.error = 'Unable to load the weather for this location. Please try again.';
                    })
                    .finally(() =>
                    {
                        this.loading = false;
                    });
            }
        }
    }
</script>
