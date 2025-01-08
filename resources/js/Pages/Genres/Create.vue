<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Genres" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create Genre
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <Form :submitAction="submit" buttonText="Create Genre" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Form from "@/Pages/Genres/Form.vue";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Form,
    },
    methods: {
        submit(form) {
            form.post(route("genres.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    form.reset();
                    Swal.fire(
                        'Success!',
                        'Genre has been created.',
                        'success'
                    );
                },
                onError: () => {
                    if (form.errors.name) {
                        form.reset("name");
                    }
                    if (form.errors.description) {
                        form.reset("description");
                    }
                    Swal.fire(
                        'Failed!',
                        'Failed to create genre.',
                        'error'
                    );
                },
            });
        },
    },
};
</script>
