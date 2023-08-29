<template>
 <div>
        <!--Header-->
        <AdminHeader></AdminHeader>
    </div>
  <div class="content">

        <!--Withdrawal list Content-->
        <div>
            <h1 class="font-bold">Withdrawal List</h1>
            <table>
            <thead>
              <tr>
                <th>Reference ID</th>
                <th>Date</th>
                <th> </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="withdrawallist in withdrawallists" :key="withdrawallist.referenceid" @click="goToDetails(withdrawallists.referenceid)">
                <td>{{ withdrawallist.referenceid }}</td>
                <td>{{ withdrawallist.date }}</td>
                <td>{{ withdrawallist.label }}</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
</template>

<script>
export default {
   data() {
    return {
//notification dummy data
        withdrawallists:[
            {
                referenceid: '111111111',
                date: '1/7/2023',
                label: 'Withdrawal transaction need to be verified',
            },
            {
                referenceid: '222222222',
                date: '1/7/2023',
                label: 'Withdrawal transaction need to be verified',
            },
            {
                referenceid: '333333333333',
                date: '1/7/2023',
                label: 'Withdrawal transaction need to be verified',
            },
            {
                referenceid: '444444444',
                date: '4/7/2023',
                label: 'Withdrawal transaction need to be verified',
            },
            {
                referenceid: '5555555555',
                date: '5/7/2023',
                label: 'Withdrawal transaction need to be verified',
            },
           
        ],  
    }
   }, 

   methods: {
    goToDetails(withdrawallistReferenceID) {
      this.$router.push({ name: 'admin-Withdrawal-Detail', params: { referenceid: withdrawallistReferenceID } });
    }
  }
}
</script>

<style scoped>
.withdrawalList-container {
  display: flex;
  flex-direction: column;
  align-items: center;
}

table {
  width: 80%;
  border-collapse: collapse;
  margin: 0 auto; /* Center the table horizontally */
}

th, td {
  padding: 8px 12px;
  border: 1px solid #ddd;
}

tr:hover {
  background-color: #f5f5f5;
  cursor: pointer;
}
</style>


