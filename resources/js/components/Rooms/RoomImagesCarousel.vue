<template>
    <v-container fluid>
        <v-card
            :loading="loading"
            rounded
            elevation="10"
        >
            <v-carousel
                v-if="roomImages.length"
                hide-delimiters
                hide-delimiter-background
            >
                <v-carousel-item v-for="image in roomImages" :key="image.id" :src="image.url"></v-carousel-item>
            </v-carousel>
            <v-carousel
                v-else
                hide-delimiters
                hide-delimiter-background
            >
                <v-carousel-item :src="'/images/room-carousel-img.jpg'"></v-carousel-item>
            </v-carousel>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "RoomImagesCarousel",
    props: ['roomImages'],

    data() {
        return {
            loading: true,
        }
    },

    watch: {
        roomImages: function () {
            this.loading = false
        }
    }
}
</script>
