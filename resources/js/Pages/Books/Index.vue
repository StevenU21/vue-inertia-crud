<template>
    <AuthenticatedLayout>
        <Head title="Books" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Books
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between mb-6">
                    <Pagination class="hidden sm:block" :links="books.links" />

                    <PrimaryButton @click="openCreateModal">
                        <i class="fas fa-plus mr-2"></i> Create Book
                    </PrimaryButton>
                </div>
                <!-- Tabla de libros -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-max">
                            <thead>
                                <tr>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-id-badge mr-2"></i>ID
                                    </th>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-book mr-2"></i>Title
                                    </th>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-align-left mr-2"></i>Description
                                    </th>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-tags mr-2"></i>Genre
                                    </th>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-user mr-2"></i>Author
                                    </th>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-calendar-alt mr-2"></i>Release Date
                                    </th>
                                    <th class="text-white p-4">
                                        <i class="fas fa-cogs mr-2"></i>Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="books.data.length === 0">
                                    <td colspan="7" class="text-white px-4 py-8 text-center bg-gray-700 rounded-lg">
                                        No records found
                                    </td>
                                </tr>
                                <tr v-else v-for="book in books.data" :key="book.id">
                                    <td class="text-white px-4 py-2">
                                        {{ book.slug }}
                                    </td>
                                    <td class="text-white px-4 py-2">
                                        {{ book.title }}
                                    </td>
                                    <td class="text-white px-4 py-2">
                                        {{ book.description }}
                                    </td>
                                    <td class="text-white px-4 py-2">
                                        {{ book.genre.name }}
                                    </td>
                                    <td class="text-white px-4 py-2">
                                        {{ book.author }}
                                    </td>
                                    <td class="text-white px-4 py-2">
                                        {{ formatDate(book.release_date) }}
                                    </td>
                                    <td class="text-white px-4 py-2 space-x-2 text-center">
                                        <div class="flex space-x-2 justify-center">
                                            <PrimaryButton @click="openShowModal(book)" class="bg-blue-500 hover:bg-blue-700 text-white">
                                                <i class="fas fa-eye mr-2"></i> Show
                                            </PrimaryButton>
                                            <PrimaryButton @click="openEditModal(book)" class="bg-blue-500 hover:bg-blue-700 text-white">
                                                <i class="fas fa-edit mr-2"></i> Edit
                                            </PrimaryButton>
                                            <PrimaryButton @click="deleteBook(book.slug)" class="bg-red-500 hover:bg-red-700 text-white">
                                                <i class="fas fa-trash mr-2"></i> Delete
                                            </PrimaryButton>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex justify-left mb-6 mt-6">
                    <Pagination :links="books.links" />
                </div>
            </div>
        </div>

        <Modal :visible="showCreateModal" @close="showCreateModal = false">
            <div class="p-4">
                <Form :submitAction="createBook" :genres="genres" buttonText="Create Book" />
            </div>
        </Modal>

        <Modal :visible="showEditModal" @close="showEditModal = false">
            <div class="p-4">
                <Form :submitAction="updateBook" :genres="genres" :book="currentBook" buttonText="Update Book" />
            </div>
        </Modal>

        <Modal :visible="showShowModal" @close="showShowModal = false">
            <Show :book="currentBook" />
        </Modal>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Pagination from "@/Components/Pagination.vue";
import Modal from "@/Components/Modal.vue";
import Form from "@/Pages/Books/Form.vue";
import Show from "@/Pages/Books/Show.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    books: Object,
    genres: Object,
});

const showCreateModal = ref(false);
const showEditModal = ref(false);
const showShowModal = ref(false);
const currentBook = ref(null);

const formatDate = (date) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(date).toLocaleDateString(undefined, options);
};

const deleteBook = (slug) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(route("books.destroy", slug), {
                onSuccess: () => {
                    Swal.fire("Deleted!", "Book has been deleted.", "success");
                },
                onError: () => {
                    Swal.fire("Failed!", "Failed to delete book.", "error");
                },
            });
        }
    });
};

const createBook = (form) => {
    router.post(route('books.store'), form, {
        onSuccess: () => {
            showCreateModal.value = false;
            Swal.fire(
                'Created!',
                'Book has been created.',
                'success'
            );
        },
        onError: () => {
            Swal.fire(
                'Failed!',
                'Failed to create book.',
                'error'
            );
        }
    });
};

const openCreateModal = () => {
    showCreateModal.value = true;
};

const openEditModal = (book) => {
    currentBook.value = book;
    showEditModal.value = true;
};

const openShowModal = (book) => {
    currentBook.value = book;
    showShowModal.value = true;
};

const updateBook = (form) => {
    router.put(route('books.update', currentBook.value.slug), form, {
        onSuccess: () => {
            showEditModal.value = false;
            Swal.fire(
                'Updated!',
                'Book has been updated.',
                'success'
            );
        },
        onError: () => {
            Swal.fire(
                'Failed!',
                'Failed to update book.',
                'error'
            );
        }
    });
};
</script>
