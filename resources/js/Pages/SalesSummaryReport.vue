<template>
  <Box>
    <Title class="mb-4">Enviar Resumo de Vendas por Email</Title>
    <form @submit.prevent="sendSalesSummary" class="flex flex-col gap-3 items-start">
      <div class="flex flex-col gap-2">
        <InputLabel for="email">Email do Destinatário:</InputLabel>
        <TextInput type="email" v-model="recipientEmail" id="email" required />
      </div>
      <div class="mt-4 flex gap-4">
        <SecondaryButton @click="visit('/')">Voltar</SecondaryButton>
        <PrimaryButton type="submit">
          Enviar Resumo de Vendas
        </PrimaryButton>
      </div>
    </form>
  </Box>
</template>

<script>
import axios from 'axios';
import Box from '@/Components/Box.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Title from '@/Components/Title.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

export default {
  data() {
    return {
      recipientEmail: '',
    };
  },
  methods: {
    visit(route) {
      this.$inertia.visit(route);
    },
    sendSalesSummary() {
      // Make a POST request to your backend route to send the sales summary report
      axios
        .post("/api/reports/sales-summary", {
          email: this.recipientEmail,
        })
        .then((response) => {
          // Handle success, e.g., show a success message
          console.log("Sales summary report sent successfully:", response.data);
        })
        .catch((error) => {
          // Handle errors, e.g., show an error message
          console.error("Error sending sales summary report:", error);
        });
    },
  },
  components: { Box, PrimaryButton, SecondaryButton, Title, InputLabel, TextInput }
};
</script>
