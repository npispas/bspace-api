import Vue from "vue"
import VueRouter from "vue-router"
import ability from '../services/abilityService'
import AuthService from "../services/authService"

// Define route components.
import Overview from "../pages/Overview"
import Calendar from "../pages/Calendar"
import Settings from "../pages/Settings"
import Error404 from "../pages/Errors/Error404"
import ReservationsRoot from "../components/ReservationsRoot"
import ReservationsIndex from "../pages/Reservations/Index"
import ReservationsShow from "../pages/Reservations/Show"
import ReservationsEdit from "../pages/Reservations/Edit"
import RoomsRoot from "../components/RoomsRoot"
import RoomsIndex from "../pages/Rooms/Index"
import RoomsShow from "../pages/Rooms/Show"
import RoomsEdit from "../pages/Rooms/Edit"
import RoomsCreate from "../pages/Rooms/Create"
import UserRoot from "../components/UsersRoot"
import UserIndex from "../pages/Users/Index"
import UserCreate from "../pages/Users/Create"
import UserEdit from "../pages/Users/Edit"

Vue.use(VueRouter)

// Define the routes
const router =  new VueRouter({
    mode: 'history',
    base: '/dashboard',
    routes: [
        {
            path: '/overview',
            component: Overview
        },
        {
            path: '/calendar',
            component: Calendar,
            beforeEnter(to, from , next) {
                if (ability.can('view', 'Reservation')) {
                    next()
                } else {
                    next('/overview')
                }
            },
        },
        {
            path: '/reservations',
            component: ReservationsRoot,
            children: [
                {
                    path: '',
                    component: ReservationsIndex
                },
                {
                    path: ':reservationId',
                    component: ReservationsShow,
                    beforeEnter(to, from , next) {
                        if (ability.can('view', 'Reservation')) {
                            next()
                        } else {
                            next('/reservations')
                        }
                    },
                },
                {
                    path: ':reservationId/edit',
                    component: ReservationsEdit,
                    beforeEnter(to, from , next) {
                        if (ability.can('edit', 'Reservation')) {
                            next()
                        } else {
                            next('/reservations')
                        }
                    },
                }
            ],
            beforeEnter(to, from , next) {
                if (ability.can('view', 'Reservation')) {
                    next()
                } else {
                    next('/overview')
                }
            }
        },
        {
            path: '/rooms',
            component: RoomsRoot,
            children: [
                {
                    path: '',
                    component: RoomsIndex
                },
                {
                    path: 'create',
                    component: RoomsCreate,
                    beforeEnter(to, from , next) {
                        if (ability.can('create', 'Room')) {
                            next()
                        } else {
                            next('/rooms')
                        }
                    },
                },
                {
                    path: ':roomId',
                    component: RoomsShow,
                    beforeEnter(to, from , next) {
                        if (ability.can('view', 'Room')) {
                            next()
                        } else {
                            next('/rooms')
                        }
                    },
                },
                {
                    path: ':roomId/edit',
                    component: RoomsEdit,
                    beforeEnter(to, from , next) {
                        if (ability.can('edit', 'Room')) {
                            next()
                        } else {
                            next('/rooms')
                        }
                    },
                }
            ],
            beforeEnter(to, from , next) {
                if (ability.can('view', 'Room')) {
                    next()
                } else {
                    next('/overview')
                }
            }
        },
        {
            path: '/users',
            component: UserRoot,
            children: [
                {
                    path: '',
                    component: UserIndex,
                },
                {
                    path: 'create',
                    component: UserCreate,
                    beforeEnter(to, from , next) {
                        if (ability.can('create', 'User')) {
                            next()
                        } else {
                            next('/users')
                        }
                    },
                },
                {
                    path: ':userId/edit',
                    component: UserEdit,
                    beforeEnter(to, from , next) {
                        if (ability.can('edit', 'User')) {
                            next()
                        } else {
                            next('/users')
                        }
                    },
                }
            ],
            beforeEnter(to, from , next) {
                if (ability.can('view', 'User')) {
                    next()
                } else {
                    next('/overview')
                }
            },
        },
        {
            path: '/settings',
            component: Settings
        },
        {
            path: '*',
            component: Error404
        },
    ],
})

router.beforeEach((to, from, next) => {
    if (to.path === '/login') {
        next()
    } else {
        router.app.loading = true;
        AuthService.fetchAuthUser()
            .then((response) => {
                if (response !== undefined) {
                    router.app.authUser = response.user
                    ability.update(response.permissions)
                    next()
                } else {
                    location.replace('/dashboard/login')
                }
            })
    }
})

export default router
