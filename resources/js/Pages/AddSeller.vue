<template>
  <div>
    <h1>Create Seller</h1>
    <button @click="visit('/vendas')">Voltar</button>
    <form @submit.prevent="createSeller">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="seller.name" required />
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="seller.email" required />
      </div>
      <button type="submit">Create Seller</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

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
};
</script>
