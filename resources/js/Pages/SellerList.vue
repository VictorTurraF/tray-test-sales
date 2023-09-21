<template>
  <div>
    <h1>List of Sellers</h1>
    <ul>
      <li v-for="seller in sellers" :key="seller.id">
        {{ seller.name }} - {{ seller.email }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      sellers: [],
    };
  },
  mounted() {
    // Fetch the list of sellers from the API using Axios
    axios.get("/api/sellers").then((response) => {
      console.log("rr", response);
      this.sellers = response.data.data;
    });
  },
};
</script>
