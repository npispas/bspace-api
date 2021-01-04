<template>
    <v-container fluid>
        <v-card
            :loading="loading"
            rounded
            elevation="10"
        >
            <v-card-title>
                <span>Reservation <strong>{{ reservation.unique_id }}</strong> Details</span>
                <v-spacer></v-spacer>
                <v-btn
                    fab
                    dark
                    x-small
                    :retain-focus-on-click="false"
                    class="indigo accent-4"
                    v-on:click.native="$router.push('/reservations')"
                >
                    <v-icon>mdi-arrow-left</v-icon>
                </v-btn>
            </v-card-title>

            <v-card-text class="pa-0">
                <v-row no-gutters>
                    <v-col sm="6" md="3" lg="3" xl="3" class="border pa-3">
                        <v-icon class="pb-4">mdi-list-status</v-icon>
                        <br>
                        <span :class="getColor(reservation.status)"><strong>{{ reservation.status }}</strong></span>
                        <br>
                        <span class="text-md-subtitle-2 text-muted">Status</span>
                    </v-col>

                    <v-col sm="6" md="3" lg="3" xl="3" class="border pa-3">
                        <v-icon class="pb-4">mdi-account-cash-outline</v-icon>
                        <br>
                        <span><strong>{{ `${reservation.total_amount} ${reservation.currency}` }}</strong></span>
                        <br>
                        <span class="text-md-subtitle-2 text-muted">Total</span>

                    </v-col>

                    <v-col sm="6" md="3" lg="3" xl="3" class="border pa-3">
                        <v-icon class="pb-4">mdi-account-supervisor-outline</v-icon>
                        <br>
                        <span><strong>{{ reservation.guest_count }}</strong></span>
                        <br>
                        <span class="text-md-subtitle-2 text-muted">Guests</span>

                    </v-col>

                    <v-col sm="6" md="3" lg="3" xl="3" class="border pa-3">
                        <v-icon class="pb-4">mdi-office-building-outline</v-icon>
                        <br>
                        <span><strong>{{ reservation.room_count }}</strong></span>
                        <br>
                        <span class="text-md-subtitle-2 text-muted">Rooms</span>

                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "ReservationDetailsCard",

    props: ['reservation', 'roomStays'],

    data() {
        return {
            loading: true
        }
    },

    watch: {
        reservation: function () {
            this.loading = false;
        }
    },

    methods: {
        getColor: function (status) {
            switch (status) {
                case 'checked-in': return 'green--text';
                case 'checked-out': return 'gray--text';
                case 'confirmed': return 'blue--text';
                case 'unconfirmed': return 'orange--text';
                case 'canceled': return 'red--text';
            }
        },
    }
}
</script>
