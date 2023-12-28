<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Permissions List" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Permissions List</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <Link :href="route('permissions.create')">
                        <PrimaryButton>Create New Permission</PrimaryButton>
                    </Link>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full">
                        <tr>
                            <th class="text-white p-4 text-left">ID</th>
                            <th class="text-white p-4 text-left">Permission Name</th>
                            <th class="text-white p-4">Actions</th>
                        </tr>
                        <tr v-for="permission in permissions" :key="permission.id">
                            <td class="text-white px-4 py-2">{{ permission.id }}</td>
                            <td class="text-white px-4 py-2">{{ permission.name }}</td>
                            <td class="text-white px-4 py-2 space-x-4 text-center">
                                <Link :href="route('permissions.edit', permission.id)">
                                    <PrimaryButton>Edit</PrimaryButton>
                                </Link>
                                <PrimaryButton @click="deletePermission(permission)">Delete</PrimaryButton>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Layout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        Link,
        PrimaryButton,
    },
    props: {
        permissions: Object
    },
    data() {
        return {
            form: useForm({
            })
        };
    },
    mounted() {
    },
    methods: {
        deletePermission(item){
            if(confirm("Do you really want to delete this permission?")){
                this.form.delete(route('permissions.destroy', item.id), {
                    preserveScroll: true,
                    onSuccess: () => {},
                    onError: () => {},
                    onFinish: () => {},
                });
            }
        },
    },
};
</script>
