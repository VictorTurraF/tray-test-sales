<template>
  <Box>
    <Title class="mb-4">Enviar relatório do vendedor por email</Title>
    <form @submit.prevent="sendSellerReport" class="flex flex-col gap-3 items-start">
      <div class="flex flex-col gap-2">
        <label for="seller_id">Selecionar Vendedor:</label>
        <select v-model="sellerId" id="seller_id" required>
          <option value="">Selecione o vendedor</option>
          <option v-for="seller in sellers" :key="seller.id" :value="seller.id">
            {{ seller.id }} - {{ seller.name }}
          </option>
        </select>
      </div>
      <div class="flex flex-col gap-2">
        <label for="report_date">Data do Relatório:</label>
        <input type="date" v-model="reportDate" id="report_date" />
      </div>
      <div class="mt-4 flex gap-3">
        <SecondaryButton @click="visit('/')">Voltar</SecondaryButton>
        <PrimaryButton type="submit">
          Enviar Relatório por email
        </PrimaryButton>
      </div>
    </form>
  </Box>
</template>

<script>
import Box from '@/Components/Box.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Title from '@/Components/Title.vue';

export default {
    data() {
        return {
            sellerId: "",
            reportDate: "",
            sellers: [], // Populate this with seller data from your API
        };
    },
    methods: {
        visit(route) {
            this.$inertia.visit(route);
        },
        sendSellerReport() {
            const formData = new FormData();
            formData.append("seller_id", this.sellerId);
            formData.append("date", this.reportDate);
            // Make a POST request to your backend route to trigger the command
            axios
                .post("/api/reports/sellers/" + this.sellerId, {
                date: this.reportDate,
            })
                .then((response) => {
                // Handle success, e.g., show a success message
                console.log("Report sent successfully:", response.data);
            })
                .catch((error) => {
                // Handle errors, e.g., show an error message
                console.error("Error sending report:", error);
            });
        },
        fetchSellers() {
            // Fetch the list of sellers from the API when the component is mounted
            axios.get("/api/sellers").then((response) => {
                this.sellers = response.data.data;
            });
        },
    },
    mounted() {
        // Call the method to fetch sellers when the component is mounted
        this.fetchSellers();
    },
    components: { Box, PrimaryButton, SecondaryButton, Title }
};
</script>
