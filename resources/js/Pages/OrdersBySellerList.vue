<template>
  <div>
    <h1>List of Orders for Seller {{ sellerId }}</h1>
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
import { ref, onMounted } from "vue";
import axios from "axios";

export default {
  props: {
    sellerId: String, // Accept the seller ID as a prop
  },
  setup(props) {
    const orders = ref([]);

    onMounted(() => {
      // Fetch the list of orders for the specific seller using Axios
      axios.get(`/api/sellers/${props.sellerId}/orders`).then((response) => {
        orders.value = response.data.data;
      });
    });

    return { orders };
  },
};
</script>
