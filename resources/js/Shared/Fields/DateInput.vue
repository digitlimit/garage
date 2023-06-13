<script setup>
  import { ref } from 'vue';
  import VueDatePicker from '@vuepic/vue-datepicker';
  import '@vuepic/vue-datepicker/dist/main.css'

  const props = defineProps({
      id: {
          type: String,
          default() {
              return `date-input-${Math.random() * 1000}`;
          },
      },

      type: {
          type: String,
          default: 'text'
      },
      modelValue: Date,
      label: String,
      error: String,
  });

  const emit = defineEmits(['update:modelValue']);

  let selected = ref(props.modelValue);

  const handleChange = (value) => {
    emit('update:modelValue', value);
  };
</script>

<template>
  <div class="form-group" :class="$attrs.class">
    <label v-if="label" :for="id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
      {{ label }}
    </label>
    <VueDatePicker 
      ref="input" 
      v-bind="{ ...$attrs, class: null }" 
      v-model="selected"
      input-class-name="date-input"
      :class="{ error: error }" 
      :value="modelValue" 
      :min-date="new Date()"
      :disabled-week-days="[0, 6]"
      @update:model-value="handleChange"
      :enable-time-picker="false"
    />
    <p v-if="error" class="text-red-500 text-sm mt-1"> {{ error }}</p>
  </div>
</template>

<style lang="scss">
  .date-input {
    height: 2.8rem;
  }
</style>