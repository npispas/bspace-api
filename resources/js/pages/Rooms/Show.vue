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
import roomMixin from "../../mixins/roomMixin";
import RoomDetailsCard from "../../components/Rooms/RoomDetailsCard";
import RoomDescriptionCard from "../../components/Rooms/RoomDescriptionCard";
import RoomImagesCarousel from "../../components/Rooms/RoomImagesCarousel";
import RoomAmenitiesCard from "../../components/Rooms/RoomAmenitiesCard";

export default {
    name: "Show",
    components: {RoomAmenitiesCard, RoomImagesCarousel, RoomDescriptionCard, RoomDetailsCard},
    mixins: [roomMixin],

    mounted() {
        this.getRoom(this.$route.params.roomId);
    }
}
</script>
