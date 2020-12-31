export default {
    data() {
        return {
            reservations: [],
            filteredReservations: [],
            reservation: {},
            roomStays: []
        }
    },

    methods: {
        getReservations: function () {
            axios.get('api/reservations')
                .then( response => {
                    console.log("Reservations Index Page Axios");
                    console.log(response.data.data);
                    this.reservations = response.data.data;
                    this.filteredReservations = response.data.data;
                }).catch( error => {
                    console.error(error.message);
                })
        },

        getReservation: function (reservationId) {
            axios.get(`api/reservations/${reservationId}`)
                .then( response => {
                    console.log("Reservations Show Page Axios");
                    console.log(response.data.data);
                    this.reservation = response.data.data;
                    this.roomStays = this.reservation.room_stays[0];
                }).catch( error => {
                console.error(error.message);
            })
        },

        deleteReservation: function (reservationId) {
            axios.delete(`api/reservations/${reservationId}`)
                .then( response => {
                    console.log("Deleted reservation");
                    console.log(response.data.data);
                    this.reservations = _.remove(this.reservations, (reservation => reservation.id !== reservationId));
                    this.filteredReservations = this.reservations;
                }).catch( error => {
                    console.error(error.message);
                })
        },

        filterReservationsByStatus: function (reservationStatus) {
            if (reservationStatus === '') {
                this.filteredReservations = this.reservations;

                return;
            }

            this.filteredReservations = this.reservations.filter( reservation => {
                return reservation.status === reservationStatus;
            });
        },

        reservationsGenerate: function () {
            axios.get('api/reservations/generate')
                .then( () => {
                    console.log("Generated a test reservation");
                    this.getReservations();
                }).catch( error => {
                    console.error(error.message);
                });
        }
    }
}
