<template>
  <Box>
    <Title class="mb-4">Adicionar Nova Venda</Title>
    <form class="flex flex-col gap-3 items-start" @submit.prevent="createOrder">
      <div>
        <InputLabel for="seller_id">Seller ID:</InputLabel>
        <select id="seller_id" v-model="order.seller_id" required>
          <option value="">Selecione o vendedor</option>
          <option v-for="seller in sellers" :key="seller.id" :value="seller.id">
            {{ seller.id }} - {{ seller.name }}
          </option>
        </select>
      </div>
      <div>
        <InputLabel for="price_in_cents">Price (in cents):</InputLabel>
        <TextInput
          type="number"
          id="price_in_cents"
          v-model="order.price_in_cents"
          required
        />
      </div>
      <div>
        <InputLabel for="payment_approved_at">Payment Approved At:</InputLabel>
        <TextInput
          type="date"
          id="payment_approved_at"
          v-model="order.payment_approved_at"
          required
        />
      </div>
      <div class="flex flex-row gap-4 mt-4">
        <SecondaryButton @click="visit('/vendas')">Voltar</SecondaryButton>
        <PrimaryButton type="submit">Create Order</PrimaryButton>
      </div>
    </form>
  </Box>
</template>

<script>
import Box from "@/Components/Box.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Title from "@/Components/Title.vue";
import axios from "axios";

export default {
  data() {
    return {
      order: {
        seller_id: "",
        price_in_cents: "",
        payment_approved_at: "",
      },
      sellers: [],
    };
  },
  methods: {
    visit(route) {
      this.$inertia.visit(route);
    },
    createOrder() {
      // Send a POST request to create an order
      axios.post("/api/orders", this.order).then((response) => {
        // Handle the response as needed (e.g., show a success message)
        console.log("Order created:", response.data.data);
        // Clear the form fields
        this.order.seller_id = "";
        this.order.price_in_cents = "";
        this.order.payment_approved_at = "";
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
  components: {
    Box,
    Title,
    InputLabel,
    TextInput,
    SecondaryButton,
    PrimaryButton,
  },
};
</script>
