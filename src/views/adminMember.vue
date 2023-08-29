<template lang="">
    <!--Remember to do comment for every section so we can easily differentiate section-->
    <div>
        <!--Header-->
        <AdminHeader></AdminHeader>
    </div>
    
        <!--Content-->
        <div class="members-container">
          <h1>Members</h1>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Funds</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="member in members" :key="member.id" @click="goToDetails(member.id)">
                <td>{{ member.id }}</td>
                <td>{{ member.name }}</td>
                <td>{{ member.funds }}</td>
              </tr>
            </tbody>
          </table>
        </div>
</template>

<script>
export default {
  data() {
    return {
      members: [
        { id: 1, name: 'John Doe', funds: 1000 },
        { id: 2, name: 'Jane Smith', funds: 1500 },
        { id: 3, name: 'Robert Johnson', funds: 800 },
        { id: 4, name: 'John Smith', funds: 1500 },
        { id: 5, name: 'Kim Johnson', funds: 800 },
        { id: 6, name: 'Fisher Smith', funds: 1500 },
        { id: 7, name: 'James Johnson', funds: 800 },
        { id: 8, name: 'Kingsly Smith', funds: 1500 },
        { id: 9, name: 'Anna Johnson', funds: 800 },
        { id: 10, name: 'Oscar Smith', funds: 1500 },
        { id: 11, name: 'Tim Johnson', funds: 800 },
        { id: 12, name: 'Dawne Smith', funds: 1500 },
        { id: 13, name: 'Rock Johnson', funds: 800 }
      ]
    };
  },
  methods: {
    goToDetails(memberId) {
      // Assuming you have vue-router set up and a route named 'member-details'
      this.$router.push({ name: 'member-details', params: { id: memberId } });
    }
  }
};
</script>

<style scoped>
.members-container {
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