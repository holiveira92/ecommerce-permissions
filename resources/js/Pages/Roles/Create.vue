<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Roles" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Create New Role</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel class="text-white" for="name" value="Role Name" />

                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="space-y-6">
                            <div>
                                <InputLabel class="text-white" for="name" value="Permissions" />

                                <Multiselect
                                    v-model="multiSelectData.name"
                                    v-bind="multiSelectData"
                                    @change="onSelect"
                                    :object="true"
                                ></Multiselect>

                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create Role
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import Multiselect from '@vueform/multiselect';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
        InputError,
        InputLabel,
        TextInput,
        Multiselect,
    },
    props: {
        permissions: Array,
    },
    data() {
        return {
            form: useForm({
                name: '',
                selected: []
            }),
            multiSelectData: {
                mode: 'tags',
                value: [],
                label: 'name',
                options: this.permissions.map(function(item) {
                    return {
                        value: item.id,
                        name: item.name,
                    };
                }),
            }
        };
    },
    methods: {
        submit() {
            this.form.post(route('roles.store'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('name');
                    }
                },
            });
        },
    },
    onSelect(index, option) {
        this.form.selected = option.internalValue;
    },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
