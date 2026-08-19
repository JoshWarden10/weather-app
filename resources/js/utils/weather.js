export function getWeatherCondition(code)
{
    const conditions = {
        0: {
            label: 'Clear sky',
            icon: 'fa-sun',
            colour: 'text-yellow-400'
        },
        1: {
            label: 'Mainly clear',
            icon: 'fa-cloud-sun',
            colour: 'text-yellow-400'
        },
        2: {
            label: 'Partly cloudy',
            icon: 'fa-cloud-sun',
            colour: 'text-gray-400'
        },
        3: {
            label: 'Overcast',
            icon: 'fa-cloud',
            colour: 'text-gray-500'
        },
        45: {
            label: 'Fog',
            icon: 'fa-smog',
            colour: 'text-gray-400'
        },
        48: {
            label: 'Fog',
            icon: 'fa-smog',
            colour: 'text-gray-400'
        },
        51: {
            label: 'Light drizzle',
            icon: 'fa-cloud-rain',
            colour: 'text-blue-300'
        },
        53: {
            label: 'Drizzle',
            icon: 'fa-cloud-rain',
            colour: 'text-blue-400'
        },
        55: {
            label: 'Heavy drizzle',
            icon: 'fa-cloud-rain',
            colour: 'text-blue-500'
        },
        56: {
            label: 'Freezing drizzle',
            icon: 'fa-cloud-rain',
            colour: 'text-cyan-400'
        },
        57: {
            label: 'Heavy freezing drizzle',
            icon: 'fa-cloud-rain',
            colour: 'text-cyan-500'
        },
        61: {
            label: 'Light rain',
            icon: 'fa-cloud-rain',
            colour: 'text-blue-400'
        },
        63: {
            label: 'Rain',
            icon: 'fa-cloud-rain',
            colour: 'text-blue-500'
        },
        65: {
            label: 'Heavy rain',
            icon: 'fa-cloud-showers-heavy',
            colour: 'text-blue-600'
        },
        66: {
            label: 'Freezing rain',
            icon: 'fa-cloud-rain',
            colour: 'text-cyan-500'
        },
        67: {
            label: 'Heavy freezing rain',
            icon: 'fa-cloud-showers-heavy',
            colour: 'text-cyan-600'
        },
        71: {
            label: 'Light snow',
            icon: 'fa-snowflake',
            colour: 'text-sky-300'
        },
        73: {
            label: 'Snow',
            icon: 'fa-snowflake',
            colour: 'text-sky-400'
        },
        75: {
            label: 'Heavy snow',
            icon: 'fa-snowflake',
            colour: 'text-sky-500'
        },
        77: {
            label: 'Snow grains',
            icon: 'fa-snowflake',
            colour: 'text-sky-400'
        },
        80: {
            label: 'Light showers',
            icon: 'fa-cloud-rain',
            colour: 'text-blue-400'
        },
        81: {
            label: 'Showers',
            icon: 'fa-cloud-showers-heavy',
            colour: 'text-blue-500'
        },
        82: {
            label: 'Heavy showers',
            icon: 'fa-cloud-showers-heavy',
            colour: 'text-blue-600'
        },
        85: {
            label: 'Snow showers',
            icon: 'fa-snowflake',
            colour: 'text-sky-400'
        },
        86: {
            label: 'Heavy snow showers',
            icon: 'fa-snowflake',
            colour: 'text-sky-500'
        },
        95: {
            label: 'Thunderstorm',
            icon: 'fa-cloud-bolt',
            colour: 'text-purple-500'
        },
        96: {
            label: 'Thunderstorm with hail',
            icon: 'fa-cloud-bolt',
            colour: 'text-purple-600'
        },
        99: {
            label: 'Thunderstorm with hail',
            icon: 'fa-cloud-bolt',
            colour: 'text-purple-600'
        }
    };

    return conditions[code] || {
        label: 'Unknown',
        icon: 'fa-cloud',
        colour: 'text-gray-400'
    };
}