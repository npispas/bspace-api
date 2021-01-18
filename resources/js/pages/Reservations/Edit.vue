<template>
    <v-container
        fluid
        class="mt-5"
    >
        <reservation-details-card
            :reservation="reservation"
            :room-stays="roomStays"
        />

        <v-container
            fluid
        >
            <v-card
                :loading="loading"
                elevation="10"
            >
                <v-card-title>
                    <span>Room Stay Details</span>
                </v-card-title>
                <v-form>
                    <v-container>
                        <v-row>
                            <v-col sm="12" md="6" lg="6">
                                <v-text-field
                                    v-model="formData.startDate"
                                    :counter="10"
                                    type="date"
                                    label="Start Date"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col sm="12" md="6" lg="6">
                                <v-text-field
                                    v-model="formData.startHour"
                                    :counter="10"
                                    type="time"
                                    label="Start Hour"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col sm="12" md="6" lg="6">
                                <v-text-field
                                    v-model="formData.endDate"
                                    :counter="10"
                                    type="date"
                                    label="Start Date"
                                    required
                                ></v-text-field>
                            </v-col>
                            <v-col sm="12" md="6" lg="6">
                                <v-text-field
                                    v-model="formData.endHour"
                                    :counter="10"
                                    type="time"
                                    label="Start Hour"
                                    required
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col sm="12" md="6" lg="6">
                                <v-select
                                    v-model="formData.room"
                                    :items="rooms"
                                    color="indigo accent-4"
                                    label="Room"
                                    item-text="name"
                                    item-value="id"
                                    required
                                >
                                </v-select>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        text
                        dark
                        rounded
                        class="indigo accent-4 pa-4"
                        @click="updateReservation"
                    >
                        Update Now
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-container>
    </v-container>
</template>

<script>
import spinnerMixin from "../../mixins/spinnerMixin"
import ReservationService from "../../services/reservationService"
import RoomService from "../../services/roomService"

import ReservationDetailsCard from "../../components/Reservations/ReservationDetailsCard"

export default {
    name: "Edit",
    components: {ReservationDetailsCard},
    mixins: [spinnerMixin],

    beforeRouteEnter(to, from, next) {
        ReservationService.fetchReservation(to.params.reservationId).then((reservationResponse) => {
            RoomService.fetchRooms().then(roomResponse => {
                next(vm => {
                    vm.rooms = roomResponse
                    vm.reservation = reservationResponse
                    vm.roomStays = reservationResponse.room_stays
                    vm.roomStay = reservationResponse.room_stays[0]
                    vm.formData.startDate = vm.roomStay.start_date
                    vm.formData.startHour = vm.roomStay.start_hour
                    vm.formData.endDate = vm.roomStay.end_date
                    vm.formData.endHour = vm.roomStay.end_hour
                    vm.formData.room = vm.roomStay.rooms[0].id
                })
            })
        })
    },

    data() {
        return {
            rooms: [],
            reservation: {},
            roomStays: [],
            roomStay: {},
            loading: true,
            formData: {
                startDate: '',
                startHour: '',
                endDate: '',
                endHour: '',
                room: ''
            }
        }
    },

    watch: {
        reservation() {
            this.loading = false
        }
    },

    methods: {
        updateReservation() {
            ReservationService.updateReservation(this.$route.params.reservationId, this.formData).then(() => {
                this.$router.push('/reservations')
            })
        }
    }
}
</script>
