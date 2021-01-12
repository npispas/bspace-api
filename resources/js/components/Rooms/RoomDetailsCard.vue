<template>
    <v-container fluid>
        <v-card
            :loading="loading"
            rounded
            elevation="10"
        >
            <v-card-title>
                <span>Room <strong>{{ room.unique_id }}</strong> Details</span>
                <v-spacer></v-spacer>
                <v-btn
                    fab
                    dark
                    x-small
                    :retain-focus-on-click="false"
                    class="indigo accent-4"
                    v-on:click.native="$router.push('/rooms')"
                >
                    <v-icon>mdi-arrow-left</v-icon>
                </v-btn>
            </v-card-title>
            <v-card-text class="pa-0">
                <v-row no-gutters>
                    <v-col sm="6" md="3" lg="3" xl="3" class="border pa-3">
                        <v-icon class="pb-4">mdi-google-maps</v-icon>
                        <br>
                        <span><strong>{{ room.location }}</strong></span>
                        <br>
                        <span class="text-md-subtitle-2 text-muted">Location</span>
                    </v-col>
                    <v-col sm="6" md="3" lg="3" xl="3" class="border pa-3">
                        <v-icon class="pb-4">mdi-vector-square</v-icon>
                        <br>
                        <span><strong>{{ `${room.interior_size} Sq.M` }}</strong></span>
                        <br>
                        <span class="text-md-subtitle-2 text-muted">Interior</span>

                    </v-col>
                    <v-col sm="6" md="3" lg="3" xl="3" class="border pa-3">
                        <v-icon class="pb-4">mdi-account-supervisor-outline</v-icon>
                        <br>
                        <span><strong>{{ `${room.min_occupancy} - ${room.max_occupancy}` }}</strong></span>
                        <br>
                        <span class="text-md-subtitle-2 text-muted">Occupancy</span>

                    </v-col>
                    <v-col sm="6" md="3" lg="3" xl="3" class="border pa-3">
                        <v-icon class="pb-4">mdi-office-building-outline</v-icon>
                        <br>
                        <span><strong>{{ roomType.name }}</strong></span>
                        <br>
                        <span class="text-md-subtitle-2 text-muted">Room Type</span>

                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "RoomDetailsCard",
    props: ['room', 'roomType'],

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
