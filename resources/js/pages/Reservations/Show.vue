<template>
    <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="listing-detail-header" id="overview">
            <!-- listing detail head start -->
            <div class="listing-detail-head">
                <h2 class="listing-detail-head-title">{{ reservation.unique_id }}</h2>
                <p class="listing-detail-head-text">
                    <span class="map-icon"><i class="fas fa-user-circle"></i></span>{{ reservation.owner_name}}
                </p>
            </div>
            <div class="listing-detail-body">
                <div class="row no-gutters">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                        <div class="listing-detail-body-meta">
                            <div class="meta-icon"> <i class="fas fa-clipboard-check"></i></div>
                            <h4 class="meta-lable" :class="`text-${reservation.status}`">{{ reservation.status }}</h4>
                            <span class="meta-value">Reservation status</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                        <div class="listing-detail-body-meta">
                            <div class="meta-icon"> <i class="fas fa-dollar-sign"></i></div>
                            <h4 class="meta-lable">{{ `${reservation.total_amount} ${reservation.currency}` }}</h4>
                            <span class="meta-value">Total amount</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                        <div class="listing-detail-body-meta">
                            <div class="meta-icon"> <i class="fas fa-users"></i></div>
                            <h4 class="meta-lable">{{ reservation.guest_count }}</h4>
                            <span class="meta-value">Arriving guests</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="listing-detail-body-meta">
                            <div class="meta-icon"> <i class="fas fa-building"></i></div>
                            <h4 class="meta-lable">{{ reservation.room_count }}</h4>
                            <span class="meta-value">Reserved rooms</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- listing detail head close -->
        </div>
        <!-- listing detail start -->
        <div class="listing-detail-card" id="guests">
            <h4 class="listing-detail-card-title">Guests</h4>
            <div class="card-group">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-8 col-8"
                     v-for="guest in roomStays.guests"
                >
                    <guest-card
                        :guest="guest"
                    />
                </div>
            </div>
        </div>
        <!-- listing detail close -->
        <!-- listing detail start -->
        <div class="listing-detail-card" id="rooms">
            <h4 class="listing-detail-card-title">Room</h4>
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8"
                     v-for="room in roomStays.rooms"
                >
                    <room-card
                        :room="room"
                    />
                </div>

            </div>
        </div>
        <!-- listing detail close -->
        <!-- listing detail start -->
        <div class="listing-detail-card amenities" id="amenities">
            <h4 class="listing-detail-card-title">Amenities</h4>
            <ul class="list-inline">
                <li class="list-inline-item">WiFi</li>
                <li class="list-inline-item">Parking</li>
                <li class="list-inline-item">24/7 access</li>
                <li class="list-inline-item">Kitchen</li>
                <li class="list-inline-item">Phone</li>
                <li class="list-inline-item">Receptionist</li>
                <li class="list-inline-item">Scan</li>
                <li class="list-inline-item">Tea & coffee</li>
            </ul>
        </div>
        <!-- listing detail close -->
    </div>
</template>

<script>
import reservationMixin from "../../mixins/reservationMixin";
import GuestCard from "../../components/Reservations/GuestCard";
import RoomCard from "../../components/Reservations/RoomCard";

export default {
    name: "Show",
    components: {GuestCard, RoomCard},
    mixins: [reservationMixin],

    mounted() {
        this.getReservation(this.$route.params.reservationId);
    }
}
</script>
