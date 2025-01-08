<template>
    <AuthenticatedLayout>
        <Head title="Genre Details" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Genre Details
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                <i class="fas fa-font mr-2"></i> Name
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ genre.name }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                <i class="fas fa-align-left mr-2"></i> Description
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ genre.description }}</p>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                <i class="fas fa-calendar-alt mr-2"></i> Created At
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ formatDate(genre.created_at) }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-between">
                        <Link :href="route('genres.index')">
                            <PrimaryButton class="bg-gray-500 hover:bg-gray-700 text-white">
                                <i class="fas fa-arrow-left mr-2"></i> Back
                            </PrimaryButton>
                        </Link>
                        <Link :href="route('genres.edit', genre.slug)">
                            <PrimaryButton class="bg-blue-500 hover:bg-blue-700 text-white">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </PrimaryButton>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    genre: Object,
});

const formatDate = (date) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString(undefined, options);
};
</script>
