<template>
  <button
    :class="[
      'inline-flex items-center ',
      small ? 'px-3 py-2' : 'px-5 py-3',
      small ? 'text-xs' : 'text-sm',
      'bg-gray-800 border border-transparent rounded-md font-semibold uppercase',
      'text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900',
      'focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2',
      'transition ease-in-out duration-150'
    ]"
  >
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    small: Boolean, // Add a prop for the small variant
  },
};
</script>
