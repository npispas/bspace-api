<template>
    <v-container
        fluid
        class="mt-5"
    >

        <reservation-details-card
            :reservation="reservation"
            :room-stays="roomStays"
        />

        <guest-card
            :guests="roomStays.guests"
        />

        <room-card
            :roomStays="roomStays"
            :room="room"
        />
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

    data() {
        return {
            reservation: {},
            roomStays: [],
            room: {}
        }
    },

    beforeRouteEnter (to, from, next) {
        ReservationService.fetchReservation(to.params.reservationId).then((response) => {
            next(vm => {
                vm.reservation = response
                vm.roomStays = vm.reservation.room_stays[0]
                vm.room = vm.roomStays.rooms[0]
            })
        })
    }
}
</script>
