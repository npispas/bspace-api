<template>
    <v-container fluid>
        <v-card
            :loading="loading"
            rounded
            elevation="10"
        >
            <v-carousel
                hide-delimiters
                hide-delimiter-background
            >
                <v-carousel-item src="../../../images/listing-slider-img-1.jpg"></v-carousel-item>
                <v-carousel-item src="../../../images/listing-slider-img-2.jpg"></v-carousel-item>
            </v-carousel>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "RoomImagesCarousel",
    props: ['room'],

    data() {
        return {
            loading: true
        }
    },

    watch: {
        room: function () {
            this.loading = false;
        }
    },
}
</script>
