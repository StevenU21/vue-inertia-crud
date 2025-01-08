<template>
    <AuthenticatedLayout>
        <Head title="Genre" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Genres
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between mb-6">
                    <Pagination class="hidden sm:block" :links="genres.links" />

                    <Link :href="route('genres.create')">
                        <PrimaryButton>
                            <i class="fas fa-plus mr-2"></i> Create Genre
                        </PrimaryButton>
                    </Link>
                </div>
                <!-- Tabla de géneros -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-max">
                            <thead>
                                <tr>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-id-badge mr-2"></i>ID
                                    </th>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-font mr-2"></i>Nombre
                                    </th>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-align-left mr-2"></i>Descripción
                                    </th>
                                    <th class="text-white p-4 text-left">
                                        <i class="fas fa-calendar-alt mr-2"></i>Fecha de Registro
                                    </th>
                                    <th class="text-white p-4">
                                        <i class="fas fa-cogs mr-2"></i>Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="genres.data.length === 0">
                                    <td colspan="5" class="text-white px-4 py-8 text-center bg-gray-700 rounded-lg">
                                        Aún no hay registros
                                    </td>
                                </tr>
                                <tr v-else v-for="genre in genres.data" :key="genre.id">
                                    <td class="text-white px-4 py-2">{{ genre.slug }}</td>
                                    <td class="text-white px-4 py-2">{{ genre.name }}</td>
                                    <td class="text-white px-4 py-2">{{ genre.description }}</td>
                                    <td class="text-white px-4 py-2">{{ formatDate(genre.created_at) }}</td>
                                    <td class="text-white px-4 py-2 space-x-2 text-center">
                                        <div class="flex space-x-2 justify-center">
                                            <Link :href="route('genres.show', genre.slug)" class="text-blue-500 hover:text-blue-700">
                                                <PrimaryButton class="bg-blue-500 hover:bg-blue-700 text-white">
                                                    <i class="fas fa-eye mr-2"></i> Mostrar
                                                </PrimaryButton>
                                            </Link>
                                            <Link :href="route('genres.edit', genre.slug)" class="text-blue-500 hover:text-blue-700">
                                                <PrimaryButton class="bg-blue-500 hover:bg-blue-700 text-white">
                                                    <i class="fas fa-edit mr-2"></i> Editar
                                                </PrimaryButton>
                                            </Link>
                                            <PrimaryButton @click="deleteGenre(genre.slug)" class="bg-red-500 hover:bg-red-700 text-white">
                                                <i class="fas fa-trash mr-2"></i> Eliminar
                                            </PrimaryButton>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex justify-left mb-6 mt-6">
                    <Pagination :links="genres.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";

defineProps({
    genres: Object,
});

const formatDate = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString(undefined, options);
};

const deleteGenre = (slug) => {
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
            router.delete(route("genres.destroy", slug), {
                onSuccess: () => {
                    Swal.fire(
                        'Deleted!',
                        'Genre has been deleted.',
                        'success'
                    );
                },
                onError: () => {
                    Swal.fire(
                        'Failed!',
                        'Failed to delete genre.',
                        'error'
                    );
                }
            });
        }
    });
};
</script>
