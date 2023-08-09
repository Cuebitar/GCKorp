<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <UniHeader></UniHeader>

        <!--Content-->
        <div class="mt-5 surface-800 w-0rem">
            <h1 class="text-blue-100">Example of using PrimeVue and PrimeFlex</h1>

            <DataTable :value="example" tableStyle="min-width: 50rem">
                <Column field="name" header="Name"></Column>
                <Column field="url" header="URL">
                    <template #body="slotProps">
                        <a class="text-red-100 no-underline" :href=slotProps.data.url>{{slotProps.data.name}}</a>
                    </template>
                </Column>
            </DataTable>
        </div>
    </div>
</template>
<script lang="ts">
export default {
    data() {
        return {
            example: [
                {
                    name: "Vue",
                    url: "https://vuejs.org/"
                },
                {
                    name: "primeVue",
                    url: "https://primevue.org/"
                },
                {
                    name: "primeFlex",
                    url: "https://primefaces.org/primeflex"
                }
            ] //From Database
        }
    },
    methods: {
        usingtoDo(){
            //TODO Fix this
        }
    }
}
</script>
<style lang="">
    
</style>