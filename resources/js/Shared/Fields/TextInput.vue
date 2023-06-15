<script setup>
    defineProps({
        id: {
            type: String,
            default() {
                return `text-input-${Math.random() * 1000}`;
            },
        },

        type: {
            type: String,
            default: 'text'
        },
        modelValue: String,
        label: String,
        error: String,
    });
</script>
<template>
    <div class="form-group" :class="$attrs.class">
      <label v-if="label" :for="id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
        {{ label }}
      </label>
      <input 
          :id="id" 
          ref="input" 
          v-bind="{ ...$attrs, class: null }" 
          class="appearance-none block w-full text-gray-700 border 
          rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
          :class="{ error: error }" 
          :type="type" 
          :value="modelValue" 
          @input="$emit('update:modelValue', $event.target.value)"
        >
        <p v-if="error" class="text-red-500 text-sm mt-1"> {{ error }}</p>
    </div>
</template>
