
<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Accounts" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Edit Account</h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit">

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

                            <div>
                                <InputLabel class="text-white" for="email" value="Email" />

                                <TextInput
                                    id="email"
                                    ref="emailInput"
                                    v-model="form.email"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autocomplete="email-input"
                                />

                                <InputError :message="form.errors.email" class="mt-2" />
                            </div>

                            <div class="space-y-6">
                            <div>
                                <InputLabel class="text-white" for="role-id" value="Role" />

                                <Multiselect
                                    v-model="form.role_id"
                                    v-bind="multiSelectData"
                                />

                                <InputError :message="form.errors.role_id" class="mt-2" />
                            </div>
                        </div>

                        </div>


                        <div class="mt-8">
                            <PrimaryButton type="submit">Update Account</PrimaryButton>
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
        user: Object,
        roles: Array,
        userRoles: Object
    },
    data() {
        return {
            form: useForm({
                name: this.user.name,
                email: this.user.email,
                role_id: this.userRoles.role_id ?? '',
                _method: 'put',
            }),
            roleOptions: this.roles.map(function(item) {
                return {
                    value: item.id,
                    name: item.name,
                };
            }),
            multiSelectData: {
                mode: 'single',
                value: this.userRoles.role_id ?? '',
                label: 'name',
                options: this.roles.map(function(item) {
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
            this.form.post(route("users.update", this.user.id), this.form, {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.name) this.form.reset('name');
                    if (this.form.errors.email) this.form.reset('email');
                    if (this.form.errors.role_id) this.form.reset('role_id');
                },
            });
        },
    }
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
