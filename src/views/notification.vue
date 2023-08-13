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
                        <span class="col-1">{{ slotProps.data.type }}</span>
                        <span v-if="slotProps.data.status != null" class="col-2 text-center">{{ slotProps.data.status }}</span>
                        <span v-else class="col-2"></span>
                        <span v-if="slotProps.data.amount != null" class="col-1 ">MYR {{ slotProps.data.amount}}</span>
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
                label: 'Account is under verification.',
            },
            {
                date: '1/7/2023',
                label: 'Account is verified.',  
            },
            {
                date: '2/7/2023',
                label: 'Transaction ref 11111111111',
                status: 'Successful',
                type: 'deposit',
                amount: 5000,
            },
            {
                date: '4/7/2023',
                label: 'Transaction ref 22222222222',
                status: 'Successful',
                type: 'deposit',
                amount: 5000,
            },
            {
                date: '5/7/2023',
                label: 'Dividen distribition',
                type: 'dividen',
                amount: 5000,
            },
            {
                date: '5/7/2023',
                label: 'Transaction ref 333333333333',
                status: 'Fail',
                type: 'withdrawal',
                amount: 5000,
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