<template>
    <div class="mb-5">
        <select id="select-location" class="w-full">
            <option></option>
        </select>
    </div>
</template>
<script>
    export default {
        props: {
        },
        data: function() {
            return {
            }
        },
        mounted() {
            this.initSelectDropdown();
        },
        methods: {

            initSelectDropdown: function()
            {
                const self = this;

                 $('#select-location').select2({
                    placeholder: 'Enter a city or postcode...',
                    minimumInputLength: 2,
                    width: '100%',

                    language:
                    {
                        inputTooShort: function()
                        {
                            return '';
                        }
                    },


                    ajax:
                    {
                        url: '/weather/locations',
                        dataType: 'json',
                        delay: 300,

                        data: function(params)
                        {
                            return {
                                search: params.term
                            };
                        },

                        processResults: function(data)
                        {
                            return {
                                results: data.map(function(location)
                                {
                                    return {
                                        id: String(location.id),
                                        text: [
                                            location.name,
                                            location.admin1,
                                            location.country
                                        ]
                                            .filter(Boolean)
                                            .join(', '),

                                        latitude: location.latitude,
                                        longitude: location.longitude,
                                        timezone: location.timezone
                                    };
                                })
                            };
                        },

                        error: function(xhr, status, error)
                        {
                            console.log('SELECT2 AJAX ERROR');
                            console.log('status:', status);
                            console.log('error:', error);
                            console.log('response:', xhr.responseText);
                        }
                    }
                });

                $('#select-location').on('select2:open', function()
                {
                    $('.select2-container--open .select2-search__field').attr('placeholder', 'Enter a city or postcode...');
                });
                $('#select-location').on('select2:select', function(e)
                {
                    self.$emit('locationSelected', e.params.data);
                });
            }
        }
    }
</script>