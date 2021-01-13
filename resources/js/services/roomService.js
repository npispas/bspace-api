import axios from "axios"

class RoomService {
     async fetchRooms() {
        return await axios.get('api/rooms')
            .then(response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
            })
    }

     async deleteRoom(roomId) {
        return await axios.delete(`api/rooms/${roomId}`)
            .then(response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
            })
    }

     async fetchRoom(roomId) {
        return await axios.get(`api/rooms/${roomId}`)
            .then(response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
            })
    }

     async createRoom(data) {
        return await axios.post('api/rooms', {
            name: data.name,
            location: data.location,
            interior_size: data.interiorSize,
            room_type_id: data.roomType,
            min_occupancy: data.minOccupancy,
            max_occupancy: data.maxOccupancy,
            available_from: data.availableFrom,
            available_to: data.availableTo,
            is_published: data.isPublished,
            description: data.description,
            images: data.images
        })
            .then( response => {
                return response.data
            }).catch(error => {
                console.error(error.message)
            })
    }

    async uploadImages(roomId, image) {

        let formData = new FormData
        formData.append('image', image)

        let conf = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }

        return await axios.post(`api/rooms/${roomId}/image`, formData, conf)
            .then( response => {
                return response.data.data
            }).catch(error => {
                console.error(error.message)
            })
    }
}

export default new RoomService()

