<template>
    <v-overlay
        :value="$root.$data.loading"
        color="white"
        opacity="30"
    >
        <v-progress-circular
            indeterminate
            :size="60"
            color="indigo"
        >
        </v-progress-circular>
    </v-overlay>
</template>

<script>
export default {
    name: 'Spinner'
}
</script>
