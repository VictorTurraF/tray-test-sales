<template>
  <Box style="width: 700px">
    <Title class="mb-2">Lista de vendas por vendedor</Title>
    <SubTitle class="mb-4">Vendedor: ID - Nome do vendedor</SubTitle>
    <SecondaryButton @click="visit('/vendedores')">Voltar</SecondaryButton>
    <div class="mt-4 rounded-md bg-gray-900 text-white font-bold px-3 py-2 grid grid-cols-3 gap-4 items-center mb-3" style="grid-template-columns: 100px 1fr 1fr;">
      <span>ID da venda</span>
      <span class="text-right">Valor da venda</span>
      <span class="text-right">Data da venda</span>
    </div>
    <ul class="flex flex-col gap-3 rounded-md">
      <li class="rounded-md bg-gray-300 px-3 py-2 grid grid-cols-3 gap-4 items-center" style="grid-template-columns: 100px 1fr 1fr;" v-for="order in orders" :key="order.id">
        <span>{{ order.id }}</span>
        <span class="text-right">R$ {{ order.price_in_cents / 100 }}</span>
        <span class="text-right">{{ order.payment_approved_at }}</span>
      </li>
    </ul>
  </Box>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import Box from "@/Components/Box.vue";
import Title from "@/Components/Title.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SubTitle from "@/Components/SubTitle.vue";

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
    components: { Box, Title, SecondaryButton, SubTitle }
};
</script>
