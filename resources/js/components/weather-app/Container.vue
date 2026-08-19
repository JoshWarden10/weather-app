<template>
    <div class="min-h-screen px-5 py-10 bg-gray-100">
        <div class="mx-auto max-w-6xl">
            <h1 class="text-3xl font-bold mb-5"><i class="fas fa-cloud bg-clip-text bg-gradient-to-r text-transparent from-blue-200 to-gray-400"></i> JoshWeather</h1>
            <SelectLocation
                @location-selected="locationSelected"></SelectLocation>
            
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

    export default {
        components: {
            SelectLocation,
            CurrentWeather
        },

        data: function() {
            return {
                selectedLocation: null,
                weather: null,
                loading: false
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

                axios.get('/weather/forecast', {
                    params: {
                        latitude: this.selectedLocation.latitude,
                        longitude: this.selectedLocation.longitude
                    }
                })
                .then((response) => {
                    this.weather = response.data;

                    console.log('Weather:', this.weather);
                })
                .finally(() => {
                    this.loading = false;
                });
            }
        }
    }
</script>