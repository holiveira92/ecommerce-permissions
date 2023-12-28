<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Permissions" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Create New Permission</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel class="text-white" for="name" value="Permission Name" />

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

                         <!--
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
                        -->

                        <div class="space-y-6">
                            <div>
                                <InputLabel class="text-white" for="excluded_routes" value="Excluded Products/Routes(Separeted by ',')" />

                                <TextInput
                                    id="excluded_routes"
                                    ref="excludedRoutesInput"
                                    v-model="form.excluded_routes"
                                    type="text"
                                    class="block w-full"
                                    autocomplete="name-input"
                                />

                                <InputError :message="form.errors.excluded_routes" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create Permission
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
            this.form.post(route('permissions.store'), {
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
