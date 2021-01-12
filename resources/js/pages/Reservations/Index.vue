<template>
    <v-container
        fluid
        class="mt-5"
    >
        <v-card
            elevation="10"
        >
            <v-data-table
                :headers="headers"
                :items="reservations"
                :loading="loading"
                loading-text="Fetching reservations... Please wait"
            >
                <template v-slot:top>
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Manage Reservations</v-toolbar-title>

                        <v-spacer></v-spacer>

                        <v-btn
                            v-if="$can('create', 'Reservation')"
                            fab
                            dark
                            x-small
                            :retain-focus-on-click="false"
                            class="indigo accent-4 mb-2"
                            v-on:click.native="reservationsGenerate"
                        >
                            <v-icon>mdi-plus</v-icon>
                        </v-btn>

                        <v-dialog v-model="dialogDelete" max-width="500px">
                            <v-card>
                                <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                                    <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                                    <v-spacer></v-spacer>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                </template>

                <template v-slot:item.actions="{ item }">
                    <v-icon
                        v-if="$can('edit', 'Reservation')"
                        small
                        @click="$router.push(`/reservations/${item.id}/edit`)"
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        v-if="$can('view', 'Reservation')"
                        :class="{'mx-2': $vuetify.breakpoint.mdAndUp}"
                        small
                        @click="$router.push(`/reservations/${item.id}`)"
                    >
                        mdi-eye
                    </v-icon>
                    <v-icon
                        v-if="$can('delete', 'Reservation')"
                        small
                        @click="deleteItem(item.id)"
                    >
                        mdi-delete
                    </v-icon>
                </template>

                <template v-slot:item.status="{ item }">
                    <v-chip
                        :color="getColor(item.status)"
                        dark
                    >
                        {{ item.status }}
                    </v-chip>
                </template>

                <template v-slot:item.total="{ item }">
                    <span>{{ `${item.total_amount} ${item.currency}` }}</span>
                </template>

            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
    import ReservationService from "../../services/reservationService"
    import spinnerMixin from "../../mixins/spinnerMixin"

    export default {
        name: "Index",
        mixins: [spinnerMixin],

        beforeRouteEnter (to, from, next) {
            ReservationService.fetchReservations().then((response) => {
                next(vm => {
                    vm.reservations = response
                })
            })
        },

        data() {
            return {
                reservations: [],
                dialog: false,
                dialogDelete: false,
                headers: [
                    { text: 'Reservation ID', align: 'start', value: 'unique_id' },
                    { text: 'Comments', value: 'comments', sortable: false },
                    { text: 'Status', value: 'status' },
                    { text: 'Owner', value: 'owner_name' },
                    { text: 'Guests', value: 'guest_count' },
                    { text: 'Total', value: 'total' },
                    { text: 'Actions', value: 'actions', sortable: false }
                ],
                loading: true
            }
        },

        watch: {
            reservations: function() {
                this.loading = false
            },
            dialog (val) {
                val || this.close()
            },
            dialogDelete (val) {
                val || this.closeDelete()
            },
        },

        methods: {
            getColor: function (status) {
                switch (status) {
                    case 'checked-in': return 'green'
                    case 'checked-out': return 'gray'
                    case 'confirmed': return 'blue'
                    case 'unconfirmed': return 'orange'
                    case 'canceled': return 'red'
                }
            },

            closeDelete () {
                this.dialogDelete = false
            },

            deleteItem (item) {
                this.editedIndex = item
                this.dialogDelete = true
            },

            deleteItemConfirm () {
                ReservationService.deleteReservation(this.editedIndex).then(() => {
                    this.reservations.splice(this.reservations.indexOf(this.editedIndex), 1)
                })
                this.closeDelete()
            },

            reservationsGenerate () {
                ReservationService.reservationsGenerate().then(() => {
                    ReservationService.fetchReservations().then(response => {
                        this.reservations = response
                    })
                })
            }
        }
    }
</script>
