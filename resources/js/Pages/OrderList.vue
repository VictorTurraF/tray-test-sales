<template>
  <Box style="width: 700px;">
    <Title class="mb-4">List of Orders</Title>
    <div class="flex flex-row gap-4">
      <SecondaryButton @click="visit('/')">Voltar</SecondaryButton>
      <PrimaryButton @click="visit('/vendas/cadastrar')">Adicionar Venda</PrimaryButton>
    </div>
    <div class="mt-4 rounded-md bg-gray-900 text-white font-bold px-3 py-2 grid grid-cols-3 gap-4 items-center mb-3" style="grid-template-columns: 1fr 1fr 1fr;">
      <span>Vendedor</span>
      <span class="text-right">Valor da venda</span>
      <span class="text-right">Data da venda</span>
    </div>
    <ul class="flex flex-col gap-3 rounded-md">
      <li class="rounded-md bg-gray-300 px-3 py-2 grid grid-cols-3 gap-4 items-center" style="grid-template-columns: 1fr 1fr 1fr;" v-for="order in orders" :key="order.id">
        <span>{{ order.seller_id }}</span>
        <span class="text-right">R$ {{ order.price_in_cents / 100 }}</span>
        <span class="text-right">{{ order.payment_approved_at }}</span>
      </li>
    </ul>
  </Box>
</template>

<script>
import Box from "@/Components/Box.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Title from "@/Components/Title.vue";
import axios from "axios";

export default {
  methods: {
    visit(route) {
      this.$inertia.visit(route);
    },
  },
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
  components: { Box, Title, SecondaryButton, PrimaryButton },
};
</script>
