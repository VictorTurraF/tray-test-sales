<template>
  <Anchor class="block px-3 py-2 bg-gray-700 text-white hover:none">
    <slot />
  </Anchor>
</template>

<script>
import Anchor from '@/Components/Anchor.vue';

export default {
  components: { Anchor }
};
</script>

<style scoped>
a {
  position: relative;
  z-index: 0;
}

a::before {
  content: '';
  position: absolute;
  z-index: -1;
  top: 0;
  bottom: 0;
  left: 0;
  right: 100%;
  background-color: #075985;
  transition: right .2s ease-in-out;
}

a:hover::before {
  right: 0;
}
</style>
