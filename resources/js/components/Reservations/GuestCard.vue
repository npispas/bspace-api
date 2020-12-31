<template>
    <!-- listing block start -->
    <div class="listing-block">
        <div class="listing-img">
            <a href="#"> <img src="../../../images/guest-img-1.jpg" alt="" class="img-fluid"></a>
        </div>
        <div class="listing-content">
            <div class="listing-content-head">
                <h3 class="listing-content-head-title"> {{ guest.full_name }}</h3>
                <p class="listing-content-head-text">Not Arrived</p>
            </div>

            <hr>

            <div class="listing-content-meta">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <span class="lable"><i class="fas fa-envelope"></i> <a :href="`mailto:${guest.email}`">{{ guest.email }}</a></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <span class="lable"><i class="fas fa-mobile"></i> {{ guest.phone }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <span class="lable"><i class="fas fa-flag"></i> {{ guest.nationality }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <span class="lable"><i class="fas fa-location-arrow"></i> {{ guest.address }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- listing block close -->
</template>

<script>
export default {
    name: "GuestCard",
    props: ["guest"]
}
</script>

