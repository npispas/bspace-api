<template>
    <v-container fluid>
        <v-card
            elevation="10"
            class="mb-2"
            :loading="loading"
        >
            <v-row no-gutters>
                <v-col md="4" lg="4">
                    <v-carousel
                        cycle
                        :show-arrows="true"
                        hide-delimiter-background
                        hide-delimiters
                        height="auto"
                    >
                        <v-carousel-item v-for="image in room.images" :key="image.id" :src="image.url"></v-carousel-item>
                    </v-carousel>
                    <v-carousel
                        cycle
                        :show-arrows="true"
                        hide-delimiter-background
                        hide-delimiters
                        height="auto"
                    >
                        <v-carousel-item :src="'/images/room-listing-img.jpg'"></v-carousel-item>
                    </v-carousel>
                </v-col>
                <v-col md="8" lg="8">
                    <v-row no-gutters>
                        <v-col cols="12">
                            <v-card-title
                                class="pb-0"
                            >
                                {{ room.name }}
                            </v-card-title>
                        </v-col>
                    </v-row>
                    <v-row no-gutters>
                        <v-col cols="12">
                            <v-card-text class="pb-0">
                                <span class="text-md-subtitle-2">{{ room.description }}</span>
                            </v-card-text>
                        </v-col>
                    </v-row>
                    <v-row no-gutters>
                        <v-col>
                            <v-card-text class="pb-0">
                                <v-icon small>mdi-calendar</v-icon>
                                <span class="text-md-subtitle-2">{{ `${roomStays.start_date} ➙ ${roomStays.end_date}` }}</span>
                            </v-card-text>
                        </v-col>
                        <v-col>
                            <v-card-text class="pb-0">
                                <v-icon small>mdi-account</v-icon>
                                <span class="text-md-subtitle-2">{{ `${room.min_occupancy} - ${room.max_occupancy}` }}</span>
                            </v-card-text>
                        </v-col>
                    </v-row>
                    <v-row no-gutters>
                        <v-col>
                            <v-card-text class="pb-0">
                                <v-icon small>mdi-vector-square</v-icon>
                                <span class="text-md-subtitle-2">{{ `${room.interior_size} Sq.M` }}</span>
                            </v-card-text>
                        </v-col>
                        <v-col>
                            <v-card-text class="pb-0">
                                <v-icon small>mdi-google-maps</v-icon>
                                <span class="text-md-subtitle-2">{{ room.location }}</span>
                            </v-card-text>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "RoomCard",
    props: ['roomStays', 'room'],

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
