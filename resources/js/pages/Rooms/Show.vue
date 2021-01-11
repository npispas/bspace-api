<template>
    <v-container
        fluid
        class="mt-5"
    >
        <room-details-card
            :room="room"
            :roomType="roomType"
        />

        <room-images-carousel
            :room="room"
        />

        <room-description-card
            :room="room"
        />

        <room-amenities-card
            :room="room"
        />

    </v-container>
</template>

<script>
import RoomService from "../../services/roomService";
import RoomDetailsCard from "../../components/Rooms/RoomDetailsCard";
import RoomDescriptionCard from "../../components/Rooms/RoomDescriptionCard";
import RoomImagesCarousel from "../../components/Rooms/RoomImagesCarousel";
import RoomAmenitiesCard from "../../components/Rooms/RoomAmenitiesCard";
import spinnerMixin from "../../mixins/spinnerMixin";

export default {
    name: "Show",
    components: {RoomAmenitiesCard, RoomImagesCarousel, RoomDescriptionCard, RoomDetailsCard},
    mixins: [spinnerMixin],

    beforeRouteEnter (to, from, next) {
        RoomService.fetchRoom(to.params.roomId).then((response) => {
            next(vm => {
                vm.room = response
                vm.roomType = vm.room.room_type
            })
        })
    },

    data() {
        return {
            room: {},
            roomType: {}
        }
    }
}
</script>
