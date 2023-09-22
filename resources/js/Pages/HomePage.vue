<template>
  <Box>
    <Title>Bem vindo ao sistema</Title>
    <nav class="flex flex-col mt-4">
      <ul>
        <li><MenuLink @click="visit('/vendedores')">Ver Vendedores</MenuLink></li>
        <li><MenuLink @click="visit('/vendas')">Ver Vendas</MenuLink></li>
        <!-- Add links to other resources as needed -->
      </ul>
    </nav>
    <div v-inertia></div>
  </Box>
</template>

<script>
import Box from '@/Components/Box.vue';
import Title from '@/Components/Title.vue';
import Anchor from '@/Components/Anchor.vue';
import MenuLink from '@/Components/MenuLink.vue';

export default {
    methods: {
        visit(route) {
            this.$inertia.visit(route);
        },
    },
    components: { Box, Title, Anchor, MenuLink }
};
</script>
