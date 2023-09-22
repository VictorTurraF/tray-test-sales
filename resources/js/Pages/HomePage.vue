<template>
  <div>
    <h1>Bem vindo ao sistema</h1>
    <nav>
      <ul>
        <li><a @click="visit('/vendedores')">Ver Vendedores</a></li>
        <li><a @click="visit('/vendas')">Ver Vendas</a></li>
        <!-- Add links to other resources as needed -->
      </ul>
    </nav>
    <div v-inertia></div>
  </div>
</template>

<script>
export default {
  methods: {
    visit(route) {
      this.$inertia.visit(route);
    },
  },
};
</script>
