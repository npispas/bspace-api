<template>
    <!-- error start -->
    <div class="error-page">
        <div class="container">
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-md-12 col-sm-12 col-12">
                    <div class="error-page-img">
                        <img src="../../../images/error-img.png" alt="" class="img-fluid">
                    </div>
                    <div class="error-page-content">
                        <h1 class="error-page-content-title">Sorry. The page you are looking for does not exist</h1>
                        <p class="error-page-content-text">We may have removed a page to which you found a link, or you may have the wrong address for the page you are looking for.
                            Recommended actions</p>
                        <router-link to="/overview" class="btn btn-primary">Back to homepage</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- error close -->
</template>

<script>
    export default {
        name: "Error404"
    }
</script>
