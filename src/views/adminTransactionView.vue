<script>
export default {
   data() {
    return {
        value: 0,
        guest: true,
        authorized: true,
        transactions:[
            {
                date: '1/7/2023',
                type: 'Withdrawal Transaction',
                amount: 10000,
                referenceId: 'RD21040'
            },
            {
                date: '2/7/2023',
                type: 'Deposit Transaction',
                amount: 8000,
                referenceId: 'RD21042'
            },
            {
                date: '3/7/2023',
                type: 'Deposit Transaction',
                amount: 7000,
                referenceId: 'RD21044'
            },
            {
                date: '4/7/2023',
                type: 'Deposit Transaction',
                amount: 3000,
                referenceId: 'RD21045'
            },
            {
                date: '5/7/2023',
                type: 'Withdrawal Transaction',
                amount: 10000,
                referenceId: 'RD21047'
            },
            {
                date: '6/7/2023',
                type: 'Deposit Transaction',
                amount: 1000,
                referenceId: 'RD21049'
            },
        ],  //from database
        tradingAccount: {
            accountNo: '0000 1111 2222 3333',
            balance: 1000,
            initialBalance: 1000,
            status: 'Active',
            createdAt: '10/1/2023',
        }, //from database
    }
   }, 
}
</script>

<template>
    <UniHeader :isGuest="guest" :isAuthorised="authorized" ></UniHeader>
    <div class="content">

        <!--Transaction Account Details-->
        <div class="mb-6"> 
            <h1 class="font-bold">Details</h1>
            <Card class="mt-4">
                <template #content>
                    <div class="col-12 grid">

                    </div>
                </template>
            </Card>
        </div>

        <!--Transaction Details-->
        <div>
            <h1 class="font-bold">Transaction</h1>
            <DataView :value="transactions" paginator :rows="7" class="shadow-5 mt-4 ">
                <template #list="slotProps">
                    <div class="col-12 grid mt-2 pb-2 dataViewCustom">
                        <span class="col-1">{{ slotProps.data.date }}</span>
                        <span class="col-3 text-right">{{ slotProps.data.type }}</span>
                        <span v-if="slotProps.data.referenceId != null" class="col-2 text-right">ref {{ slotProps.data.referenceId }}</span>
                        <span v-else class="col-2"></span>
                        <span class="col-3 text-right" :class="slotProps.data.type.toLowerCase() =='deposit' || 'dividen'? 'green':'red'">MYR {{ slotProps.data.amount.toFixed(2) }}</span>
                </div>
                </template>
            </DataView>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.red{
    color:red;
}
.green{
    color: green;
}
.dataViewCustom{
    margin-left: inherit;
}
</style>