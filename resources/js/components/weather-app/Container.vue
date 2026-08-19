<template>
    <div class="min-h-screen px-5 py-10 bg-gray-100">
        <div class="mx-auto max-w-6xl">
            <h1 class="text-3xl font-bold mb-5"><i class="fas fa-cloud bg-clip-text bg-gradient-to-r text-transparent from-blue-200 to-gray-400"></i> JoshWeather</h1>
            <SelectLocation></SelectLocation>
            <div class="bg-white rounded-md border border-gray-200">
                <div class="p-5">
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import SelectLocation from './SelectLocation.vue';

    export default {
        components: {
            SelectLocation
        },

        props: {
        },
        data: function() {
            return {
            }
        },
        mounted() {
        },
        methods: {

        }
    }
</script>