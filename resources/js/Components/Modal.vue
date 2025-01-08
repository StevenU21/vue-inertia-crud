<template>
    <transition name="modal">
        <div v-if="visible" class="fixed inset-0 z-50 overflow-auto bg-smoke-dark flex backdrop-blur">
            <div class="relative p-8 bg-gray-800 text-white w-full max-w-md m-auto flex-col flex rounded-lg">
                <span class="absolute top-0 right-0 p-4">
                    <button @click="closeModal" class="text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </span>
                <slot></slot>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "Modal",
    props: {
        visible: {
            type: Boolean,
            default: false,
        },
    },
    methods: {
        closeModal() {
            this.$emit("close");
        },
    },
};
</script>

<style scoped>
.bg-smoke-dark {
    background-color: rgba(0, 0, 0, 0.8);
}
.backdrop-blur {
    backdrop-filter: blur(5px);
}
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.5s;
}
.modal-enter, .modal-leave-to /* .modal-leave-active in <2.1.8 */ {
    opacity: 0;
}
</style>
