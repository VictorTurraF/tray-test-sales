<template>
  <div>
    <h1>List vendas por vendedor</h1>

    <button @click="visit('/vendedores')">Voltar</button>
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
  methods: {
    visit(route) {
      this.$inertia.visit(route);
    }
  },
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
