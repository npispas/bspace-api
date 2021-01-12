<template>
    <v-container
        fluid
        class="mt-5"
    >
        <v-row>
            <v-col>
                <v-card
                    elevation="10"
                >
                    <v-card-title>Overview</v-card-title>
                    <v-card-text>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias beatae blanditiis facilis magnam maiores odit quia. Adipisci aliquam ea error in itaque molestiae, nisi omnis, quae qui quibusdam, sunt ut.</p>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col sm="12" md="3" lg="3">
                <v-card
                    elevation="10"
                    class="pa-5"
                >
                    <v-card-text>
                        <v-row no-gutters>
                            <v-col>
                                <v-icon class="pb-4">mdi-format-list-bulleted</v-icon>
                                <br>
                                <span><strong>{{ reservationsCount }}</strong></span>
                                <br>
                                <span class="text-md-subtitle-2 text-muted">Reservations</span>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col sm="12" md="3" lg="3">
                <v-card
                    elevation="10"
                    class="pa-5"
                >
                    <v-card-text>
                        <v-row no-gutters>
                            <v-col>
                                <v-icon class="pb-4">mdi-account</v-icon>
                                <br>
                                <span><strong>{{ guestCount }}</strong></span>
                                <br>
                                <span class="text-md-subtitle-2 text-muted">Guests</span>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col sm="12" md="3" lg="3">
                <v-card
                    elevation="10"
                    class="pa-5"
                >
                    <v-card-text>
                        <v-row no-gutters>
                            <v-col>
                                <v-icon class="pb-4">mdi-currency-eur</v-icon>
                                <br>
                                <span><strong>{{ `${parseFloat(revenue).toFixed(2)} EUR` }}</strong></span>
                                <br>
                                <span class="text-md-subtitle-2 text-muted">Revenue</span>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col sm="12" md="3" lg="3">
                <v-card
                    elevation="10"
                    class="pa-5"
                >
                    <v-card-text>
                        <v-row no-gutters>
                            <v-col>
                                <v-icon class="pb-4">mdi-percent</v-icon>
                                <br>
                                <span><strong>{{ 12 }}</strong></span>
                                <br>
                                <span class="text-md-subtitle-2 text-muted">Occupancy</span>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-card
                    elevation="10"
                >
                    <v-card-title>Current Week's Reservations</v-card-title>
                    <v-sparkline
                        :padding="16"
                        :smooth="false"
                        color="indigo accent-4"
                        line-width="0.5"
                        :value="values"
                        :labels="labels"
                    ></v-sparkline>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import StatisticService from "../services/statisticService"
    import spinnerMixin from "../mixins/spinnerMixin"

    export default {
        name: "Dashboard",
        mixins: [spinnerMixin],

        beforeRouteEnter (to, from, next) {
            StatisticService.fetchStatistics().then((response) => {
                next(vm => {
                    vm.reservationsCount = response.reservation_count
                    vm.guestCount = response.guest_count
                    vm.revenue = response.revenue
                    vm.occupancy = response.occupancy
                    vm.labels = response.days
                    vm.values = response.reservations_per_day
                })
            })
        },

        data() {
            return {
                reservationsCount: null,
                guestCount: null,
                revenue: null,
                occupancy: null,
                labels: [],
                values: []
            }
        }
    }
</script>
