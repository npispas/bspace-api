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
import reservationMixin from "../../mixins/reservationMixin";
import ReservationDetailsCard from "../../components/Reservations/ReservationDetailsCard";
import GuestCard from "../../components/Reservations/GuestCard";
import RoomCard from "../../components/Reservations/RoomCard";

export default {
    name: "Show",
    components: {RoomCard, GuestCard, ReservationDetailsCard},
    mixins: [reservationMixin],

    mounted() {
        this.getReservation(this.$route.params.reservationId);
    },
}
</script>
