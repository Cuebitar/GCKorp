<script lang="ts">
export default {
   data() {
    return {
        value: 0
    }
   }, 
}
</script>

<template>
    <UniHeader></UniHeader>
    <div class="">
        <Knob v-model="value" />
    </div>
</template>