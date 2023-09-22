<template>
  <select
    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
    v-bind="$attrs"
    v-model="selectedValue"
  >
    <slot></slot>
  </select>
</template>

<script>
import { ref, defineProps, defineEmits } from 'vue';

export default {
  props: {
    modelValue: {
      type: [String, Number],
      required: true,
    },
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const selectedValue = ref(props.modelValue);

    // Watch for changes to selectedValue and emit the update event
    watchEffect(() => {
      emit('update:modelValue', selectedValue.value);
    });

    return {
      selectedValue,
    };
  },
};
</script>
