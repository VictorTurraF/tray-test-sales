<template>
  <a :href="to" class="text-gray-800 hover:underline hover:text-gray cursor-pointer">
    <slot></slot>
  </a>
</template>

<script>
export default {
  name: 'Link',
  props: {
    to: String, // The URL to navigate to
  },
}
</script>
