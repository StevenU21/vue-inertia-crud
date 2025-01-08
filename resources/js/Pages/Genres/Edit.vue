<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Edit Genre" />

        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Edit Genre
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8"
                >
                    <Form
                        :genre="genre"
                        :submitAction="submit"
                        buttonText="Update Genre"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Form from "@/Pages/Genres/Form.vue";
import Swal from "sweetalert2";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Form,
    },
    props: {
        genre: Object,
    },
    methods: {
        submit(form) {
            form.put(route("genres.update", this.genre), {
                preserveScroll: true,
                onSuccess: () => {
                    form.reset();
                    Swal.fire("Success!", "Genre has been updated.", "success");
                },
                onError: () => {
                    if (form.errors.name) {
                        form.reset("name");
                    }
                    if (form.errors.description) {
                        form.reset("description");
                    }
                    Swal.fire("Failed!", "Failed to update genre.", "error");
                },
            });
        },
    },
};
</script>
