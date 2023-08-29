<template>
    <UniHeader ></UniHeader>
    <div class="content">

        <!--Withdrawal list Content-->
        <div>
            <h1 class="font-bold">Withdrawal List</h1>
            <DataView :value="withdrawallist" paginator :rows="10" class="shadow-5 mt-4 ">
                <template #list="slotProps">
                    <div class="col-12 grid mt-2 pb-2 dataViewCustom">
                        <span class="col-2">{{ slotProps.data.date }}</span>
                        <span class="col-6">{{ slotProps.data.label }}</span>



                </div>
                </template>
            </DataView>
        </div>
    </div>
</template>

<script>
export default {
   data() {
    return {
//notification dummy data
        withdrawallist:[
            {
                date: '1/7/2023',
                label: 'Deposit transaction ref 111111111',
            },
            {
                date: '1/7/2023',
                label: 'Withdrawal transaction ref 111111111',
            },
            {
                date: '2/7/2023',
                label: 'Deposit transaction ref 2222222222',
            },
            {
                date: '4/7/2023',
                label: 'Withdrawal transaction ref 3333333333',
            },
            {
                date: '5/7/2023',
                label: 'Withdrawal transaction ref 5555555555',
            },
            {
                date: '5/7/2023',
                label: 'Deposit transaction ref 5555555555',
            },
           
        ],  
    }
   }, 
}
</script>

<style lang="scss" scoped>
.dataViewCustom{
    margin-left: inherit;
}
</style>