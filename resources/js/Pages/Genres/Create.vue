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
                    <form @submit.prevent="submit">
                        <div class="space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    ref="nameInput"
                                    v-model="form.name"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="name-input"
                                />

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Description" />

                                <TextArea
                                    id="description"
                                    ref="descriptionInput"
                                    v-model="form.description"
                                    class="mt-1 block w-full"
                                    autocomplete="description-input"
                                />

                                <InputError :message="form.errors.description" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-8 flex justify-between">
                            <Link :href="route('genres.index')">
                                <PrimaryButton class="bg-gray-500 hover:bg-gray-700 text-white">
                                    <i class="fas fa-arrow-left mr-2"></i> Volver
                                </PrimaryButton>
                            </Link>
                            <PrimaryButton type="submit">
                                <i class="fas fa-save mr-2"></i> Create Genre
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        InputError,
        InputLabel,
        TextInput,
        TextArea,
    },
    data() {
        return {
            form: useForm({
                name: "",
                description: "",
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(route("genres.store"), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset("name");
                    }
                    if (this.form.errors.description) {
                        this.form.reset("description");
                    }
                },
            });
        },
    },
};
</script>
