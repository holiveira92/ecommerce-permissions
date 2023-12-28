
<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Role" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Edit Role</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit" enctype="multipart/form-data">

                        <div class="space-y-6">
                            <div>
                                <InputLabel class="text-white" for="name" value="Name" />

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

                        <div class="mt-8">
                            <PrimaryButton type="submit">Update Role</PrimaryButton>
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
        role: Object,
        permissions: Array,
        rolePermissions: Array
    },
    data() {
        return {
            form: useForm({
                name: this.role.name,
                _method: 'put',
                selected: []
            }),
            multiSelectData: {
                mode: 'tags',
                value: this.rolePermissions.map(function(item) {
                    return {
                        value: item.id,
                        name: item.name,
                    };
                }),
                label: 'name',
                options: this.permissions.map(function(item) {
                    return {
                        value: item.id,
                        name: item.name,
                    };
                }),
            }
        }
    },
    methods: {
        submit() {
            this.form.post(route("roles.update", this.role.id), this.form, {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) {
                        this.form.reset('name');
                    }
                },
            });
        },
        onSelect(index, option) {
            this.form.selected = option.internalValue;
        },
    }
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
