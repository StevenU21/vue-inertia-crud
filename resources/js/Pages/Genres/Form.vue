<template>
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
                <i class="fas fa-save mr-2"></i> {{ buttonText }}
            </PrimaryButton>
        </div>
    </form>
</template>

<script>
import { Head, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        Link,
        PrimaryButton,
        InputError,
        InputLabel,
        TextInput,
        TextArea,
    },
    props: {
        genre: {
            type: Object,
            default: () => ({
                name: '',
                description: ''
            })
        },
        buttonText: {
            type: String,
            default: 'Create Genre'
        },
        submitAction: {
            type: Function,
            required: true
        }
    },
    setup(props) {
        const form = useForm({
            name: props.genre.name,
            description: props.genre.description,
        });

        const submit = () => {
            props.submitAction(form);
        };

        return {
            form,
            submit
        };
    }
};
</script>
