<template>
    <!-- listing block start -->
    <div class="listing-block grid-listing">
        <div class="listing-img">
            <a href="#"> <img src="../../../images/listing-img-1.jpg" alt="" class="img-fluid"></a>
            <a href="#" class="listing-category-badge badge-light-brose">
                {{ room.room_type.name }}
            </a>
        </div>
        <div class="listing-content">
            <div class="listing-content-head">
                <h3 class="listing-content-head-title"> <a href="#">{{ room.name }}</a></h3>
                <p class="listing-content-head-text">{{ room.description }}</p>
            </div>

            <div class="listing-content-meta">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                        <span class="lable">Location</span> <br> <span class="value">{{ room.location }}</span>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                        <span class="lable">People</span> <br> <span class="value">{{ `${room.min_occupancy} - ${room.max_occupancy}`}}</span>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                        <span class="lable">Sq.M</span> <br> <span class="value">{{ room.interior_size }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- listing block close -->
</template>

<script>
export default {
    name: "RoomCard",
    props: ['room']
}
</script>
