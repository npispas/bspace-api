<template>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Spinner",

        methods: {
            preload: function (milliseconds) {
                let preloaderElement = $('.preloader');
                /* preloader js **/
                preloaderElement.css('display', 'inline-block');
                preloaderElement.delay(milliseconds).fadeOut('slow');
            }
        }
    }
</script>
