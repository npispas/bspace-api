<template>
    <v-container
        fluid
        class="mt-5"
    >
        <reservation-details-card
            :reservation="reservation"
            :room-stays="roomStays"
        />
        <v-row no-gutters justify="center">
            <v-col cols="12" sm="12" md="6" lg="6" align-self="stretch">
                <guest-card
                    :guests="roomStays.guests"
                />
            </v-col>
            <v-col cols="12" sm="12" md="6" lg="6" align-self="stretch">
                <room-card
                    :room-stays="roomStays"
                    :room="room"
                    :room-images="roomImages"
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import ReservationDetailsCard from "../../components/Reservations/ReservationDetailsCard"
import GuestCard from "../../components/Reservations/GuestCard"
import RoomCard from "../../components/Reservations/RoomCard"
import spinnerMixin from "../../mixins/spinnerMixin"

import ReservationService from "../../services/reservationService"

export default {
    name: "Show",
    components: {RoomCard, GuestCard, ReservationDetailsCard},
    mixins: [spinnerMixin],

    beforeRouteEnter(to, from, next) {
        ReservationService.fetchReservation(to.params.reservationId).then((response) => {
            next(vm => {
                vm.reservation = response
                vm.roomStays = response.room_stays[0]
                vm.room = vm.roomStays.rooms[0]
                vm.roomImages = vm.roomStays.rooms[0].images
            })
        })
    },

    data() {
        return {
            reservation: {},
            roomStays: [],
            room: {},
            roomImages: []
        }
    },
}
</script>
