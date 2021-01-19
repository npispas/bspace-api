<template>
    <v-container fluid>
        <v-card
            elevation="10"
            class="mb-2"
            :loading="loading"
        >
            <v-carousel
                v-if="roomImages.length"
                cycle
                :show-arrows="true"
                hide-delimiter-background
                hide-delimiters
                height="250"
            >
                <v-carousel-item v-for="image in roomImages" :key="image.id" :src="image.url"></v-carousel-item>
            </v-carousel>
            <v-carousel
                v-else
                cycle
                :show-arrows="true"
                hide-delimiter-background
                hide-delimiters
                height="250"
            >
                <v-carousel-item :src="'/images/room-listing-img.jpg'"></v-carousel-item>
            </v-carousel>
            <v-card-title>Room Details</v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols="12" sm="12" md="6" lg="6">
                        <span><strong>{{ room.name }}</strong></span>
                        <br>
                        <span class="text-subtitle-2 text-muted">Room Number</span>
                    </v-col>
                    <v-col cols="12" sm="12" md="6" lg="6">
                        <span><strong>{{ room.location }}</strong></span>
                        <br>
                        <span class="text-subtitle-2 text-muted">Location</span>
                    </v-col>
                    <v-col cols="12" sm="12" md="6" lg="6">
                        <span><strong>{{ `${roomStays.start_date} / ${roomStays.end_date}` }}</strong></span>
                        <br>
                        <span class="text-subtitle-2 text-muted">Arrival / Departure Date</span>
                    </v-col>
                    <v-col cols="12" sm="12" md="6" lg="6">
                        <span><strong>{{ `${roomStays.start_hour} / ${roomStays.end_hour}` }}</strong></span>
                        <br>
                        <span class="text-subtitle-2 text-muted">Arrival / Departure Time</span>
                    </v-col>
                    <v-col cols="12" sm="12" md="6" lg="6">
                        <span><strong>{{ `${room.min_occupancy} - ${room.max_occupancy}` }}</strong></span>
                        <br>
                        <span class="text-subtitle-2 text-muted">Occupancy</span>
                    </v-col>
                    <v-col cols="12" sm="12" md="6" lg="6">
                        <span><strong>{{ `${room.interior_size} Sq.M` }}</strong></span>
                        <br>
                        <span class="text-subtitle-2 text-muted">Interior Size</span>
                    </v-col>
                    <v-col cols="12" sm="12" md="12" lg="12">
                        <span><strong>{{ room.description }}</strong></span>
                        <br>
                        <span class="text-subtitle-2 text-muted">Description</span>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "RoomCard",
    props: ['roomStays', 'room', 'roomImages'],

    data() {
        return {
            loading: true
        }
    },

    watch: {
        roomStays: function () {
            this.loading = false
        }
    }
}
</script>
