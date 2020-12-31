export default {
    data() {
        return {
            roomTypes: [],
            roomType: {}
        }
    },

    methods: {
        getRoomTypes: function () {
            axios.get('api/room_types')
                .then( response => {
                    console.log("RoomTypes Index Page Axios");
                    console.log(response.data.data);
                    this.roomTypes = response.data.data;
                }).catch( error => {
                console.error(error.message);
            })
        },

        getRoomType: function (roomTypeId) {
            axios.get(`api/room_types/${roomTypeId}`)
                .then( response => {
                    console.log("Rooms Show Page Axios");
                    console.log(response.data.data);
                    this.roomType = response.data.data;
                }).catch( error => {
                console.error(error.message);
            })
        },

        deleteRoomType: function (roomTypeId) {
            axios.delete(`api/room_types/${roomTypeId}`)
                .then( response => {
                    console.log("Deleted room type");
                    console.log(response.data.data);
                    this.roomTypes = _.remove(this.roomTypes, (roomType => roomType.id !== roomTypeId));
                }).catch( error => {
                console.error(error.message);
            })
        },
    }
}
