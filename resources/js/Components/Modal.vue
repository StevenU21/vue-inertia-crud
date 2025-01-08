<template>
    <div class="fixed inset-0 z-50 overflow-auto bg-smoke-dark flex">
        <div
            class="relative p-8 bg-gray-800 text-white w-full max-w-md m-auto flex-col flex rounded-lg"
        >
            <span class="absolute top-0 right-0 p-4">
                <button @click="$emit('close')" class="text-white">
                    <i class="fas fa-times"></i>
                </button>
            </span>
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal",
};
</script>

<style scoped>
.bg-smoke-dark {
    background-color: rgba(0, 0, 0, 0.8);
}
</style>
