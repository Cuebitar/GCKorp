<template>
    <UniHeader ></UniHeader>
    <div class="content">

        <!--Notification Content-->
        <div>
            <h1 class="font-bold">Notification</h1>
            <DataView :value="notification" paginator :rows="10" class="shadow-5 mt-4 ">
                <template #list="slotProps">
                    <div class="col-12 grid mt-2 pb-2 dataViewCustom">
                        <span class="col-2">{{ slotProps.data.date }}</span>
                        <span class="col-6">{{ slotProps.data.label }}</span>
                        <span v-if="slotProps.data.status != null" class="col-2">{{ slotProps.data.status }}</span>
                        <span v-else class="col-2"></span>
                        <span v-else class="col-1"></span>



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
        notification:[
            {
                date: '1/7/2023',
                label: 'Deposit transaction ref 111111111',
                status: 'Denied',
            },
            {
                date: '1/7/2023',
                label: 'Withdrawal transaction ref 111111111',
                status: 'Approved',
            },
            {
                date: '2/7/2023',
                label: 'Deposit transaction ref 2222222222',
                status: 'Approved',
            },
            {
                date: '4/7/2023',
                label: 'Withdrawal transaction ref 3333333333',
                status: 'Denied',
            },
            {
                date: '5/7/2023',
                label: 'Withdrawal transaction ref 5555555555',
                status: 'Approved',
            },
            {
                date: '5/7/2023',
                label: 'Deposit transaction ref 5555555555',
                status: 'Denied',
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