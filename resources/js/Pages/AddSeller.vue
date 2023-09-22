<template>
  <Box>
    <Title class="mb-4">Adicionar Novo Vendedor</Title>
    <form class="flex flex-col gap-3 items-start" @submit.prevent="createSeller">
      <div class="flex flex-col gap-2">
        <InputLabel for="name">Name:</InputLabel>
        <TextInput
          placeholder="Nome do vendedor"
          type="text"
          id="name"
          v-model="seller.name"
          required
        />
      </div>
      <div class="flex flex-col gap-2">
        <InputLabel for="email">Email:</InputLabel>
        <TextInput
          placeholder="Email do vendedor"
          type="email"
          id="email"
          v-model="seller.email"
          required
        />
      </div>
      <div class="flex flex-row gap-4 mt-4">
        <SecondaryButton @click="visit('/vendedores')">Voltar</SecondaryButton>
        <PrimaryButton>Criar Vendedor</PrimaryButton>
      </div>
    </form>
  </Box>
</template>



<script>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Title from '@/Components/Title.vue';
import Box from '@/Components/Box.vue';
import InputError from '@/Components/InputError.vue';

import axios from "axios";
import SecondaryButton from "@/Components/SecondaryButton.vue";

export default {
    data() {
        return {
            seller: {
                name: "",
                email: "",
            },
        };
    },
    methods: {
        visit(route) {
            this.$inertia.visit(route);
        },
        createSeller() {
            // Send a POST request to create a seller
            axios.post("/api/sellers", this.seller).then((response) => {
                // Handle the response as needed (e.g., show a success message)
                console.log("Seller created:", response.data.data);
                // Clear the form fields
                this.seller.name = "";
                this.seller.email = "";
            });
        },
    },
    components: {
      TextInput,
      InputLabel,
      PrimaryButton,
      Title,
      SecondaryButton,
      Box,
      InputError
    }
};
</script>
