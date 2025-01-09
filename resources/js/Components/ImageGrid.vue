<template>
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
            <div v-for="item in items" :key="item.id" class="relative flex justify-center group">
                <div class="text-white px-4 py-2 text-center">
                    <img v-if="item.file" :src="item.path_file" alt="File" class="max-w-full h-auto cursor-pointer" @click="openModal(item.path_file)" />
                    <button @click="confirmDelete(item.id)" class="absolute top-0 right-0 m-2 p-2 bg-red-600 text-white rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition duration-300 ease-in-out transform hover:scale-110">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <Modal :visible="isModalVisible" @close="closeModal">
            <img :src="selectedImage" alt="Selected File" class="max-w-full h-auto" />
        </Modal>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import Modal from "./Modal.vue";

export default {
    components: {
        Modal,
    },
    props: {
        items: {
            type: Array,
            default: () => [],
        },
        csrfToken: String,
    },
    data() {
        return {
            isModalVisible: false,
            selectedImage: null,
        };
    },
    methods: {
        async deleteImage(id) {
            try {
                await axios.delete(`/images/${id}`, {
                    headers: {
                        "X-CSRF-TOKEN": this.csrfToken,
                    },
                });
                this.$emit("image-deleted", id);
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'The image has been deleted.',
                    timer: 1500,
                    showConfirmButton: false,
                });
            } catch (error) {
                console.error("Error deleting image:", error);
            }
        },
        confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteImage(id);
                }
            });
        },
        openModal(image) {
            this.selectedImage = image;
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
            this.selectedImage = null;
        },
    },
};
</script>

<style scoped>
.group:hover .group-hover\:opacity-100 {
    opacity: 1;
}
</style>
