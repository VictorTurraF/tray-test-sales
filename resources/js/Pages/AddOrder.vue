<template>
  <div>
    <h1>Create Order</h1>
    <form @submit.prevent="createOrder">
      <div>
        <label for="seller_id">Seller ID:</label>
        <input type="text" id="seller_id" v-model="order.seller_id" required />
      </div>
      <div>
        <label for="price_in_cents">Price (in cents):</label>
        <input
          type="number"
          id="price_in_cents"
          v-model="order.price_in_cents"
          required
        />
      </div>
      <div>
        <label for="payment_approved_at">Payment Approved At:</label>
        <input
          type="date"
          id="payment_approved_at"
          v-model="order.payment_approved_at"
          required
        />
      </div>
      <button type="submit">Create Order</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      order: {
        seller_id: "",
        price_in_cents: "",
        payment_approved_at: "",
      },
    };
  },
  methods: {
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
  },
};
</script>
