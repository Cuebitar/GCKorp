<script lang="ts">
export default {
   data() {
    return {
        value: 0,
        guest: true,
        authorized: true
    }
   }, 
}
</script>

<template>
    <UniHeader :isGuest="guest" :isAuthorised="authorized" ></UniHeader>
    <div class="content">
        <Knob v-model="value" />
    </div>
</template>