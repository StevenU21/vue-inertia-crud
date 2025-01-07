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
                    <Pagination :links="genres.links" />

                    <Link :href="route('genres.create')">
                        <PrimaryButton>Create Company</PrimaryButton>
                    </Link>
                </div>
                <!-- Tabla de géneros -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="text-white p-4 text-left">ID</th>
                                <th class="text-white p-4 text-left">Nombre</th>
                                <th class="text-white p-4 text-left">Descripción</th>
                                <th class="text-white p-4 text-left">Fecha de Registro</th>
                                <th class="text-white p-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="genre in genres.data" :key="genre.id">
                                <td class="text-white px-4 py-2">{{ genre.id }}</td>
                                <td class="text-white px-4 py-2">{{ genre.name }}</td>
                                <td class="text-white px-4 py-2">{{ genre.description }}</td>
                                <td class="text-white px-4 py-2">{{ formatDate(genre.created_at) }}</td>
                                <td class="text-white px-4 py-2 space-x-4 text-center">
                                    <Link :href="route('genres.show', genre.id)" class="text-blue-500 hover:text-blue-700">
                                        <PrimaryButton class="bg-blue-500 hover:bg-blue-700 text-white">Mostrar</PrimaryButton>
                                    </Link>
                                    <Link :href="route('genres.edit', genre.id)" class="text-blue-500 hover:text-blue-700">
                                        <PrimaryButton class="bg-blue-500 hover:bg-blue-700 text-white">Editar</PrimaryButton>
                                    </Link>
                                    <PrimaryButton @click="deleteGenre(genre)" class="bg-red-500 hover:bg-red-700 text-white">
                                        Eliminar
                                    </PrimaryButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    genres: Object,
});

const formatDate = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString(undefined, options);
};

const deleteGenre = (genre) => {
    // Lógica para eliminar el género
};
</script>
