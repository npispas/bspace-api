<template>
    <v-container
        fluid
        class="mt-5"
    >
        <v-card
            elevation="10"
        >
            <v-row no-gutters>
                <v-col>
                    <v-sheet height="64">
                        <v-toolbar
                            flat
                        >
                            <v-btn
                                outlined
                                class="mr-4"
                                color="grey darken-2"
                                @click="setToday"
                            >
                                Today
                            </v-btn>
                            <v-btn
                                fab
                                text
                                small
                                color="grey darken-2"
                                @click="prev"
                            >
                                <v-icon small>
                                    mdi-chevron-left
                                </v-icon>
                            </v-btn>
                            <v-btn
                                fab
                                text
                                small
                                color="grey darken-2"
                                @click="next"
                            >
                                <v-icon small>
                                    mdi-chevron-right
                                </v-icon>
                            </v-btn>
                            <v-toolbar-title v-if="$refs.calendar">
                                {{ $refs.calendar.title }}
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-menu
                                bottom
                                right
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        outlined
                                        color="grey darken-2"
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        <span>{{ typeToLabel[type] }}</span>
                                        <v-icon right>
                                            mdi-menu-down
                                        </v-icon>
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item @click="type = 'day'">
                                        <v-list-item-title>Day</v-list-item-title>
                                    </v-list-item>
                                    <v-list-item @click="type = 'week'">
                                        <v-list-item-title>Week</v-list-item-title>
                                    </v-list-item>
                                    <v-list-item @click="type = 'month'">
                                        <v-list-item-title>Month</v-list-item-title>
                                    </v-list-item>
                                    <v-list-item @click="type = '4day'">
                                        <v-list-item-title>4 days</v-list-item-title>
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </v-toolbar>
                    </v-sheet>
                    <v-sheet height="800">
                        <v-calendar
                            ref="calendar"
                            v-model="focus"
                            :events="events"
                            :event-color="getEventColor"
                            :type="type"
                            @click:event="showEvent"
                            @click:more="viewDay"
                            @click:date="viewDay"
                            @change="updateRange"
                        ></v-calendar>
                        <v-menu
                            v-model="selectedOpen"
                            :close-on-content-click="false"
                            :activator="selectedElement"
                            offset-x
                        >
                            <v-card
                                color="grey lighten-4"
                                min-width="350px"
                                flat
                            >
                                <v-toolbar
                                    :color="selectedEvent.color"
                                    dark
                                >
                                    <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
                                </v-toolbar>
                                <v-card-text>
                                    <v-row>
                                        <v-col>
                                            <v-icon small>mdi-office-building-outline</v-icon>
                                            <span> {{ selectedEvent.room }}</span>
                                        </v-col>
                                        <v-col>
                                            <v-icon small>mdi-percent</v-icon>
                                            <span> {{ selectedEvent.occupancy }}</span>
                                        </v-col>
                                    </v-row>
                                    <v-row v-for="guest in selectedEvent.guests" :key="guest.id">
                                        <v-col>
                                            <v-icon small>mdi-account</v-icon>
                                            <span> {{ `${guest.full_name} (Arrived)` }}</span>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                                <v-card-actions>
                                    <v-btn
                                        text
                                        color="secondary"
                                        @click="selectedOpen = false"
                                    >
                                        Dismiss
                                    </v-btn>

                                    <v-spacer></v-spacer>

                                    <v-btn
                                        text
                                        color="secondary"
                                        :to="`/reservations/${selectedEvent.id}`"
                                    >
                                        View
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-menu>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
import ReservationService from "../services/reservationService"
import spinnerMixin from "../mixins/spinnerMixin"

export default {
    name: "Calendar",
    mixins: [spinnerMixin],

    beforeRouteEnter (to, from, next) {
        ReservationService.fetchReservations().then((response) => {
            next(vm => {
                vm.loading = false
                vm.reservations = response
            })
        })
    },

    data: () => ({
        reservations: [],
        focus: '',
        type: 'month',
        typeToLabel: {
            month: 'Month',
            week: 'Week',
            day: 'Day',
            '4day': '4 Days',
        },
        selectedEvent: {},
        selectedElement: null,
        selectedOpen: false,
        events: [],
        colors: ['green', 'blue', 'red', 'orange', 'gray'],
        names: ['checked-in', 'confirmed', 'canceled', 'unconfirmed', 'checked-out'],
    }),

    mounted () {
        this.$refs.calendar.checkChange()
    },

    methods: {
        viewDay({date}) {
            this.focus = date
            this.type = 'day'
        },
        getEventColor(event) {
            return event.color
        },
        setToday() {
            this.focus = ''
        },
        prev() {
            this.$refs.calendar.prev()
        },
        next() {
            this.$refs.calendar.next()
        },
        showEvent({nativeEvent, event}) {
            const open = () => {
                this.selectedEvent = event
                this.selectedElement = nativeEvent.target
                setTimeout(() => {
                    this.selectedOpen = true
                }, 10)
            }

            if (this.selectedOpen) {
                this.selectedOpen = false
                setTimeout(open, 10)
            } else {
                open()
            }

            nativeEvent.stopPropagation()
        },

        updateRange({start, end}) {
            const events = []

            for (let i = 0; i < this.reservations.length; i++) {
                events.push({
                    id: this.reservations[i].id,
                    name: `#${this.reservations[i].unique_id} - ${this.reservations[i].owner_name}`,
                    start: new Date(`${this.reservations[i].room_stays[0].start_date}T${this.reservations[i].room_stays[0].start_hour}`),
                    end: new Date(`${this.reservations[i].room_stays[0].end_date}T${this.reservations[i].room_stays[0].end_hour}`),
                    color: this.colors[this.names.indexOf(this.reservations[i].status)],
                    timed: true,
                    room: this.reservations[i].room_stays[0].rooms[0].name,
                    occupancy: parseFloat(this.reservations[i].guest_count / this.reservations[i].room_stays[0].rooms[0].max_occupancy).toFixed(2) * 100,
                    guests: this.reservations[i].room_stays[0].guests
                })
            }

            this.events = events
        }
    }
}
</script>
