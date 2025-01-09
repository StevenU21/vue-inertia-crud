<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Documents" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Documents</h2>
        </template>

        <div class="mt-10">
            <CustomFileUpload :csrfToken="csrf_token" @files-uploaded="handleFilesUploaded" />
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pagination-container">
                    <Pagination :links="items.links" />
                </div>
                <ImageGrid :items="items.data" :csrfToken="csrf_token" @image-deleted="removeImage" />
                <div class="pagination-container">
                    <Pagination :links="items.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import CustomFileUpload from "@/Components/FileUpload.vue";
import Pagination from "@/Components/Pagination.vue";
import ImageGrid from "@/Components/ImageGrid.vue";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        CustomFileUpload,
        Pagination,
        ImageGrid,
    },
    props: {
        items: {
            type: Object,
            default: () => ({ data: [], links: [] }),
        },
        csrf_token: String,
    },
    methods: {
        handleFilesUploaded(newFiles) {
            newFiles.forEach((file) => {
                const newItem = {
                    id: file.id,
                    file: file.file,
                    path_file: file.path_file,
                };
                this.items.data.push(newItem);
            });
        },
        removeImage(id) {
            this.items.data = this.items.data.filter(item => item.id !== id);
        },
    },
};
</script>
