<template>
    <div class="col-xl-2 col-lg-3 col-md-12 col-sm-12 col-12">
        <nav class="navbar db-sidenav">
            <div class="offcanvas-collapse" id="db-sidenav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <router-link to="/overview" class="nav-link" active-class="active">
                            <i class="fas fa-fw fa-tachometer-alt"></i>Overview
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/reservations" class="nav-link" active-class="active">
                            <i class="fas fa-fw fa-list"></i>Reservations
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/rooms" class="nav-link" active-class="active">
                            <i class="fas fa-fw fa-building"></i>Rooms
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/users" class="nav-link" active-class="active">
                            <i class="fas fa-fw fa-user"></i>Users
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link to="/profile" class="nav-link" active-class="active">
                            <i class="fas fa-fw fa-cogs"></i>Settings
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" v-on:click.prevent="logout"><i class="fas fa-fw fa-sign-out-alt"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>

<script>
    import logoutMixin from "../../mixins/logoutMixin";

    export default {
        name: "SideNav",
        mixins: [logoutMixin],
    }
</script>

