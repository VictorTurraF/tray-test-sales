<template>
  <Box style="width: 700px;">
    <Title class="mb-4">Lista de Vendedores</Title>
    <div class="flex flex-row gap-4">
      <SecondaryButton @click="visit('/')">Voltar</SecondaryButton>
      <PrimaryButton @click="visit('/vendedores/cadastrar')">Adicionar vendedor</PrimaryButton>
    </div>
    <div class="mt-4 rounded-md bg-gray-900 text-white font-bold px-3 py-2 grid grid-cols-3 gap-4 items-center mb-3" style="grid-template-columns: 1fr 1fr 148px;">
      <span>Nome</span>
      <span>Email</span>
      <span>Ações</span>
    </div>
    <ul class="flex flex-col gap-3 rounded-md">
      <li class="rounded-md bg-gray-300 px-3 py-2 grid grid-cols-3 gap-4 items-center" style="grid-template-columns: 1fr 1fr auto;" v-for="seller in sellers" :key="seller.id">
        <span>{{ seller.name }}</span>
        <span>{{ seller.email }}</span>
        <PrimaryButton :small="true" @click="viewSellerOrders(seller.id)">Visualizar vendas</PrimaryButton>
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
        viewSellerOrders(sellerId) {
            this.$inertia.visit(`/vendedores/${sellerId}/vendas`);
        },
    },
    data() {
        return {
            sellers: [],
        };
    },
    mounted() {
        // Fetch the list of sellers from the API using Axios
        axios.get("/api/sellers").then((response) => {
            this.sellers = response.data.data;
        });
    },
    components: { Box, Title, SecondaryButton, PrimaryButton }
};
</script>
