import axios from "axios"

class RoomTypeService {
     async fetchRoomTypes() {
        return await axios.get('api/room_types')
            .then(response => {
                return response.data.data
            }).catch( error => {
                console.error(error.message)
            })
    }

     async fetchRoomType(roomTypeId) {
        return await axios.get(`api/room_types/${roomTypeId}`)
            .then( response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
            })
    }
}

export default new RoomTypeService()

