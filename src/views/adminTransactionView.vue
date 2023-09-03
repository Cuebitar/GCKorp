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
        tradingAccounts: [
            {
            accountNo: '0000 1111 2222 3333',
            balance: 1000,
            initialBalance: 1000,
            status: 'Active',
            createdAt: '10/1/2023',
            }, 
            {
            accountNo: '1234 5678 9875 1236',
            balance: 6333,
            initialBalance: 98985,
            status: 'Active',
            createdAt: '10/7/2023',
            }, 
            {
            accountNo: '7989 5659 5464 0548',
            balance: 59094,
            initialBalance: 91797,
            status: 'Active',
            createdAt: '1/9/2023',
            }, 
            {
            accountNo: '7979 5054 4499 1448',
            balance: 2646,
            initialBalance: 4548,
            status: 'Active',
            createdAt: '7/4/2023',
            }, 
            {
            accountNo: '1554 3265 0646 1446',
            balance: 6344,
            initialBalance: 96452,
            status: 'Active',
            createdAt: '10/6/2023',
            }, 
            {
            accountNo: '4548 6414 1252 9988',
            balance: 97915,
            initialBalance: 45408,
            status: 'Active',
            createdAt: '10/3/2023',
            }, 
    ],//from database

    accountShowModal: true,
    transactionShowModal: false,

    }
   }, 

   methods: {
    
    showTransaction() {
        this.accountShowModal = false;
        this.transactionShowModal = true;
    },
    goBack() {
        this.accountShowModal = true;
        this.transactionShowModal = false;
    }
    
    
  }
}
</script>

<template>
    <div>
        <!--Header-->
        <AdminHeader></AdminHeader>
    </div>    
    
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

        <!--Trading Account Details-->
        <div  v-if="accountShowModal" class="modal">
            <h1 class="font-bold">Trading Account</h1>
            <DataView :value="tradingAccounts" paginator :rows="7" class="shadow-5 mt-4 ">
                <template #list="slotProps">
                    <div class="col-12 grid mt-2 pb-2 dataViewCustom">
                        
                        <span @click="showTransaction" class="col-3">{{ slotProps.data.accountNo }}</span>
                        <span class="col-2">Balance (MYR): {{ slotProps.data.balance }}</span>
                        <span class="col-3">InitialBanalce (MYR): {{ slotProps.data.initialBalance }}</span>
                        <span class="col-1">{{ slotProps.data.status }}</span>
                        <span class="col-2">Created: {{ slotProps.data.createdAt }}</span>
                        <Button @click="showTransaction">Select</Button>
                </div>
                </template>
            </DataView>
        </div>


        <!--Transaction Details-->
        <div v-if="transactionShowModal" class="modal">
            <Button @click="goBack">Back</Button>
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