<template>
    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h3 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-200">
            <i class="fas fa-book mr-2"></i> Book Details
        </h3>
        <div class="space-y-2">
            <p class="text-gray-700 dark:text-gray-300">
                <i class="fas fa-id-badge mr-2"></i><strong>ID:</strong> {{ book.slug }}
            </p>
            <p class="text-gray-700 dark:text-gray-300">
                <i class="fas fa-heading mr-2"></i><strong>Title:</strong> {{ book.title }}
            </p>
            <p class="text-gray-700 dark:text-gray-300">
                <i class="fas fa-align-left mr-2"></i><strong>Description:</strong> {{ book.description }}
            </p>
            <p class="text-gray-700 dark:text-gray-300">
                <i class="fas fa-tags mr-2"></i><strong>Genre:</strong> {{ book.genre.name }}
            </p>
            <p class="text-gray-700 dark:text-gray-300">
                <i class="fas fa-user mr-2"></i><strong>Author:</strong> {{ book.author }}
            </p>
            <p class="text-gray-700 dark:text-gray-300">
                <i class="fas fa-calendar-alt mr-2"></i><strong>Release Date:</strong> {{ formatDate(book.release_date) }}
            </p>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
    book: Object,
});

const formatDate = (date) => {
    const options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(date).toLocaleDateString(undefined, options);
};
</script>
