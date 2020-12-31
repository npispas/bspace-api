export default {
    data() {
        return {
            rooms: [],
            filteredRooms: [],
            room: {},
            roomType: {},
            roomTypeId: 'No Selection',
            name: '',
            location: '',
            interiorSize: 0,
            minOccupancy: 0,
            maxOccupancy: 0,
            availableFrom: '',
            availableTo: '',
            isPublished: false,
            description: '',
            images: '',
        }
    },

    methods: {
        getRooms: function () {
            axios.get('api/rooms')
                .then( response => {
                    console.log("Rooms Index Page Axios");
                    console.log(response.data.data);
                    this.rooms = response.data.data;
                    this.filteredRooms = response.data.data;
                }).catch( error => {
                    console.error(error.message);
            })
        },

        createRoom: function () {
            axios.post('api/rooms', {
                name: this.name,
                location: this.location,
                interior_size: this.interiorSize,
                room_type_id: this.roomTypeId,
                min_occupancy: this.minOccupancy,
                max_occupancy: this.maxOccupancy,
                available_from: this.availableFrom,
                available_to: this.availableTo,
                is_published: this.isPublished,
                description: this.description,
            })
                .then( response => {
                    console.log("Room Created");
                    console.log(response.data.data);
                    this.$router.push('/rooms');
                }).catch( error => {
                    console.error(error.message);
            })
        },

        getRoom: function (roomId) {
            axios.get(`api/rooms/${roomId}`)
                .then( response => {
                    console.log("Rooms Show Page Axios");
                    console.log(response.data.data);
                    this.room = response.data.data;
                    this.roomType = this.room.room_type;
                }).catch( error => {
                    console.error(error.message);
            })
        },

        deleteRoom: function (roomId) {
            axios.delete(`api/rooms/${roomId}`)
                .then( response => {
                    console.log("Deleted room");
                    console.log(response.data.data);
                    this.rooms = _.remove(this.rooms, (room => room.id !== roomId));
                    this.filteredRooms = this.rooms;
                }).catch( error => {
                    console.error(error.message);
            })
        },

        filterReservationsByPublicity: function (published) {
            if (published === null) {
                this.filteredRooms = this.rooms;

                return;
            }

            this.filteredRooms = this.rooms.filter( room => {
                return room.is_published === published;
            });
        }
    }
}
