<template>
    <div class="mb-5">
        <select id="select-location" ref="selectLocation" class="w-full">
            <option></option>
        </select>
    </div>
</template>
<script>
    export default {
        props: {
            modelValue: {
                type: Object,
                default: null
            }
        },

        emits: [
            'update:modelValue'
        ],

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
                    self.$emit('update:modelValue', e.params.data);
                });
            },

            addSelectedOption: function(location)
            {
                const select = $(this.$refs.selectLocation);
                const locationId = String(location.id);

                const existingOption = select.find(
                    'option[value="' + locationId + '"]'
                );

                if (existingOption.length) {
                    return;
                }

                const option = new Option(
                    location.text,
                    locationId,
                    true,
                    true
                );

                select.append(option);
            },

            setSelectedLocation: function(location)
            {
                const select = $(this.$refs.selectLocation);
                const locationId = String(location.id);

                this.addSelectedOption(location);

                select
                    .val(locationId)
                    .trigger('change.select2');
            }
        },

        watch: {
            modelValue: function(location)
            {
                if (location) {
                    this.setSelectedLocation(location);
                }
            }
        },

        beforeUnmount()
        {
            const select = $(this.$refs.selectLocation);

            select.off();

            if (select.hasClass('select2-hidden-accessible')) {
                select.select2('destroy');
            }
        },

        mounted() {
            if (this.modelValue) {
                this.addSelectedOption(this.modelValue);
            }

            this.initSelectDropdown();

            if (this.modelValue) {
                $(this.$refs.selectLocation)
                    .val(String(this.modelValue.id))
                    .trigger('change.select2');
            }
        },
    }
</script>