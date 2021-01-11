import axios from "axios"

class ReservationService {
     async fetchReservations() {
        return await axios.get('api/reservations')
            .then(response => {
                return response.data.data
            }).catch( error => {
                console.error(error.message)
            })
    }

     async fetchReservation(reservationId) {
        return await axios.get(`api/reservations/${reservationId}`)
            .then(response => {
                return response.data.data
            }).catch( error => {
                console.error(error.message)
            })
    }

    async updateReservation(reservationId, data) {
        return await axios.put(`api/reservations/${reservationId}`, {
            start_date: data.startDate,
            start_hour: data.startHour,
            end_date: data.endDate,
            end_hour: data.endHour,
            room: data.room,
        })
            .then(response => {
                return response.data.data
            }).catch( error => {
                console.error(error.message)
            })
    }

     async reservationsGenerate() {
        return await axios.get('api/reservations/generate')
            .then(response => {
                return response.data.data
            }).catch( error => {
                console.error(error.message)
            })
    }

     async deleteReservation(reservationId) {
        return await axios.delete(`api/reservations/${reservationId}`)
            .then(response => {
                return response.data.data
            }).catch( error => {
                console.error(error.message)
            })
    }
}

export default new ReservationService()
