<template>
    <div class="min-h-screen px-5 py-10 bg-gray-100">
        <div class="mx-auto max-w-6xl">
            <h1 class="text-3xl font-bold mb-5"><i class="fas fa-cloud bg-clip-text bg-gradient-to-r text-transparent from-blue-200 to-gray-400 mr-2"></i>JoshCorp Weather</h1>
            <SelectLocation
                @location-selected="locationSelected"></SelectLocation>

            <div class="mt-6">
                <CurrentWeatherLoading v-if="loading"></CurrentWeatherLoading>
                <div v-else-if="error" class="rounded-md border border-red-200 bg-red-50 p-5">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-circle-exclamation text-red-400"></i>
                        <p class="font-medium text-red-700">{{ error }}</p>
                    </div>
                </div>
            </div>
            
            <CurrentWeather v-if="weather && selectedLocation"
                :weather="weather"
                :location="selectedLocation"></CurrentWeather>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import SelectLocation from './SelectLocation.vue';
    import CurrentWeather from './CurrentWeather.vue';
    import CurrentWeatherLoading from './CurrentWeatherLoading.vue';

    export default {
        components: {
            SelectLocation,
            CurrentWeather,
            CurrentWeatherLoading
        },

        data: function() {
            return {
                selectedLocation: null,
                weather: null,
                loading: false,
                error: null
            }
        },
        mounted() {
        },
        methods: {
            locationSelected: function(location)
            {
                this.selectedLocation = location;

                this.fetchWeather();
            },

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
                .then((response) => {
                    this.weather = response.data;
                })
                .catch((error) => {
                    console.error('Unable to fetch weather:', error);

                    this.error = 'Unable to load the weather for this location. Please try again.';
                })
                .finally(() => {
                    this.loading = false;
                });
            }
        }
    }
</script>