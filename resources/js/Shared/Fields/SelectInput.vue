<script setup>
import { ref, watch } from "vue";

const props = defineProps({
    id: {
        type: String,
        default() {
            return `text-input-${Math.random() * 1000}`;
        },
    },

    options: {
        type: Array,
        default: []
    },

    type: {
        type: String,
        default: 'text'
    },
    modelValue: [String, Number, Boolean],
    label: String,
    error: String,
});

const emit = defineEmits(['update:modelValue']);

let selected = ref(props.modelValue);

const handleChange = () => {
    emit('update:modelValue', selected.value);
};

</script>
<template>
    <div class="form-group" :class="$attrs.class">
        <label v-if="label" :for="id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
            {{ label }}
        </label>

        <div class="relative">
            <select 
            :id="id" 
            ref="input" 
            v-model="selected" 
            v-bind="{ ...$attrs, class: null }" 
            class="block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" 
            :class="{ error: error }" 
            :value="modelValue" 
            @change="handleChange"
        >
            <option v-for="(option, index) in options" :value="option.value" :key="index">
                {{ option.label }}
            </option>
            <slot></slot>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <p v-if="error" class="text-red-500 text-sm mt-1"> {{ error }}</p>
    </div>
  </template>

