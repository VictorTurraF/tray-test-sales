<template>
  <div>
    <h1>Lista de Vendedores</h1>
    <button @click="visit('/vendedores/cadastrar')">Adicionar vendedor</button>
    <button @click="visit('/')">Voltar</button>
    <ul>
      <li v-for="seller in sellers" :key="seller.id">
        <span>{{ seller.name }}</span>
        <span>{{ seller.email }}</span>
        <button @click="viewSellerOrders(seller.id)">Ver vendas</button>
      </li>
    </ul>
  </div>
</template>

<script>
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
};
</script>
