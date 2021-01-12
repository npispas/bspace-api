<template>
    <v-container fluid>
        <v-card
            :loading="loading"
            rounded
            elevation="10"
        >
            <v-card-title>Amenities</v-card-title>
            <v-card-text>
                <v-row>
                    <v-col>
                        <v-row>
                            <v-col>
                                <v-icon small>mdi-wifi</v-icon>
                                <span class="text-md-subtitle-2">WiFi</span>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-icon small>mdi-parking</v-icon>
                                <span class="text-md-subtitle-2">Parking</span>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col>
                        <v-row>
                            <v-col>
                                <v-icon small>mdi-hours-24</v-icon>
                                <span class="text-md-subtitle-2">24/7 access</span>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-icon small>mdi-phone</v-icon>
                                <span class="text-md-subtitle-2">Kitchen</span>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col>
                        <v-row>
                            <v-col>
                                <v-icon small>mdi-pot-steam</v-icon>
                                <span class="text-md-subtitle-2">Phone</span>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-icon small>mdi-room-service</v-icon>
                                <span class="text-md-subtitle-2">Receptionist</span>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col>
                        <v-row>
                            <v-col>
                                <v-icon small>mdi-magnify-scan</v-icon>
                                <span class="text-md-subtitle-2">Scan</span>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-icon small>mdi-coffee</v-icon>
                                <span class="text-md-subtitle-2">Tea & coffee</span>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "RoomAmenitiesCard",
    props: ['room'],

    data() {
        return {
            loading: true
        }
    },

    watch: {
        room: function () {
            this.loading = false
        }
    }
}
</script>
