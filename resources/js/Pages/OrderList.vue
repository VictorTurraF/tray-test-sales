<template>
  <div>
    <h1>List of Orders</h1>
    <ul>
      <li v-for="order in orders" :key="order.id">
        Seller ID: {{ order.seller_id }} - Price: ${{
          order.price_in_cents / 100
        }}
        - Approved At: {{ order.payment_approved_at }}
      </li>
    </ul>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      orders: [],
    };
  },
  mounted() {
    // Fetch the list of orders from the API using Axios
    axios.get("/api/orders").then((response) => {
      console.log("rr", response.data);
      this.orders = response.data.data;
    });
  },
};
</script>
