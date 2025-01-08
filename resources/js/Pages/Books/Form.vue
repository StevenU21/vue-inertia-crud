<template>
    <form @submit.prevent="submit">
        <div class="space-y-6">
            <div>
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="block w-full"
                    autocomplete="title"
                />

                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <div>
                <InputLabel for="description" value="Description" />

                <TextArea
                    id="description"
                    v-model="form.description"
                    class="mt-1 block w-full"
                    rows="4"
                />

                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div>
                <InputLabel for="genre" value="Genre" />

                <select
                    id="genre"
                    v-model="form.genre_id"
                    class="block w-full mt-1 dark:bg-gray-700 text-white dark:bg-gray-900 rounded-md">
                    <option v-for="(id, name) in genres" :key="id" :value="id">
                        {{ name }}
                    </option>
                </select>

                <InputError :message="form.errors.genre_id" class="mt-2" />
            </div>

            <div>
                <InputLabel for="author" value="Author" />

                <TextInput
                    id="author"
                    v-model="form.author"
                    type="text"
                    class="block w-full"
                    autocomplete="author"
                />

                <InputError :message="form.errors.author" class="mt-2" />
            </div>

            <div>
                <InputLabel for="release_date" value="Release Date" />

                <TextInput
                    id="release_date"
                    v-model="form.release_date"
                    type="date"
                    class="block w-full"
                    autocomplete="release_date"
                />

                <InputError :message="form.errors.release_date" class="mt-2" />
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <PrimaryButton :disabled="form.processing" type="submit">
                <i class="fas fa-save mr-2"></i> {{ buttonText }}
            </PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { defineProps, watch } from "vue";

const props = defineProps({
    book: {
        type: Object,
        default: () => ({
            title: "",
            description: "",
            author: "",
            release_date: "",
            genre_id: null,
        }),
    },
    genres: {
        type: Object,
        required: true,
    },
    submitAction: {
        type: Function,
        required: true,
    },
    buttonText: {
        type: String,
        default: "Save",
    },
});

const form = useForm({
    title: props.book.title,
    description: props.book.description,
    author: props.book.author,
    release_date: props.book.release_date,
    genre_id: props.book.genre_id,
});

const submit = () => {
    props.submitAction(form);
};

// Watch for changes in props.book to update the form values
watch(() => props.book, (newBook) => {
    form.title = newBook.title;
    form.description = newBook.description;
    form.author = newBook.author;
    form.release_date = newBook.release_date;
    form.genre_id = newBook.genre_id;
}, { immediate: true });
</script>
