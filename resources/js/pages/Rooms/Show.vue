<template>
    <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">

        <!-- listing slider start -->
        <div class="">
            <div class="">
                <VueSlickCarousel
                    :arrows="true"
                    :dots="true"
                    :infinite="true"
                    :speed="300"
                    :slidesToShow="1"
                    :centerMode="true"
                    :centerPadding="'0'"
                    :autoplay="true"
                    :responsive="[{
                            // 'breakpoint':1000,
                            'settings': {
                                'variableWidth': true,
                                'adaptiveHeight': false,
                                'centerMode': true
                            }
                    }]"
                >
                    <div class="item"><img src="../../../images/listing-slider-img-1.jpg" alt=""></div>
                    <div class="item"><img src="../../../images/listing-slider-img-2.jpg" alt=""></div>
                </VueSlickCarousel>

            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <!-- listing badges start -->
                        <div class="listing-badges">
                            <div class="badge badge-pill"
                                 :class="`badge-${room.is_published ? 'published' : 'unpublished'}`"
                            >
                                {{room.is_published ? 'Published' : 'Unpublished' }}
                            </div>
                        </div>
                        <!-- listing badges close -->
                    </div>
                </div>
            </div>
        </div>
        <!-- listing slider close -->

        <div class="listing-detail-header" id="overview">
            <!-- listing detail head start -->
            <div class="listing-detail-head">
                <h2 class="listing-detail-head-title">{{ room.name }}</h2>
                <p class="listing-detail-head-text">
                    <span class="map-icon"><i class="fas fa-calendar-day"></i></span>
                    {{ `Available from ${room.available_from} to ${room.available_to}` }}
                </p>
            </div>
            <div class="listing-detail-body">
                <div class="row no-gutters">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                        <div class="listing-detail-body-meta">
                            <div class="meta-icon"> <i class="fas fa-location-arrow"></i></div>
                            <h4 class="meta-lable">{{ room.location }}</h4>
                            <span class="meta-value">Location</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                        <div class="listing-detail-body-meta">
                            <div class="meta-icon"> <i class="fas fa-vector-square"></i></div>
                            <h4 class="meta-lable">{{ room.interior_size }} SqM</h4>
                            <span class="meta-value">Size</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 border-right">
                        <div class="listing-detail-body-meta">
                            <div class="meta-icon"> <i class="fas fa-users"></i></div>
                            <h4 class="meta-lable">{{ `${room.min_occupancy} - ${room.max_occupancy}`}}</h4>
                            <span class="meta-value">People</span>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="listing-detail-body-meta">
                            <div class="meta-icon"> <i class="fas fa-building"></i></div>
                            <h4 class="meta-lable">{{ roomType.name }}</h4>
                            <span class="meta-value">Room Type</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- listing detail head close -->
        </div>
        <!-- listing detail start -->
        <div class="listing-detail-card" id="about">
            <h4 class="listing-detail-card-title">Description</h4>
            <p>{{ room.description }}</p>
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
import VueSlickCarousel from "vue-slick-carousel";
import roomMixin from "../../mixins/roomMixin";

export default {
    name: "Show",
    components: {VueSlickCarousel},
    mixins: [roomMixin],

    mounted() {
        this.getRoom(this.$route.params.roomId);
    }
}
</script>
