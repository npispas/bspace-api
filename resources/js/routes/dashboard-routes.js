// Define route components.
import Overview from "../pages/Dashboard";
import Error404 from "../pages/Errors/Error404";
import ReservationsRoot from "../components/ReservationsRoot"
import ReservationsIndex from "../pages/Reservations/Index"
import ReservationsShow from "../pages/Reservations/Show"
import RoomsRoot from "../components/RoomsRoot";
import RoomsIndex from "../pages/Rooms/Index";
import RoomsShow from "../pages/Rooms/Show";
import RoomsCreate from "../pages/Rooms/Create";
import UserRoot from "../components/UsersRoot";
import UserIndex from "../pages/Users/Index";
import UserShow from "../pages/Users/Show";

// Define the routes
const routes = [
    {
        path: '/overview',
        component: Overview
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
                component: ReservationsShow
            }
        ]
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
                component: RoomsCreate
            },
            {
                path: ':roomId',
                component: RoomsShow
            }
        ]
    },
    {
        path: '/users',
        component: UserRoot,
        children: [
            {
                path: '',
                component: UserIndex
            },
            {
                path: ':userId',
                component: UserShow
            }
        ]
    },
    {
        path: '*',
        component: Error404
    },
]

export default routes;
