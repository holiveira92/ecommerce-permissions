<template>
    <AuthenticatedLayout>
        <!-- Title -->
        <Head title="Accounts List" />

        <template #header>
            <h2 class="font-semibold text-xl leading-tight">Accounts List</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-6">
                    <Link :href="route('users.create')">
                        <PrimaryButton>Create Account</PrimaryButton>
                    </Link>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full">
                        <tr>
                            <th class="text-white p-4 text-left">ID</th>
                            <th class="text-white p-4 text-left">Name</th>
                            <th class="text-white p-4 text-left">Email</th>
                            <th class="text-white p-4 text-left">Role</th>
                            <th class="text-white p-4">Actions</th>
                        </tr>
                        <tr v-for="account in accounts" :key="account.id">
                            <td class="text-white px-4 py-2">{{ account.id }}</td>
                            <td class="text-white px-4 py-2">{{ account.name }}</td>
                            <td class="text-white px-4 py-2">{{ account.email }}</td>
                            <td class="text-white px-4 py-2">{{ account.email }}</td>
                            <td class="text-white px-4 py-2 space-x-4 text-center">
                                <Link :href="route('users.edit', account.id)">
                                    <PrimaryButton>Edit</PrimaryButton>
                                </Link>
                                <PrimaryButton @click="deleteAccount(account)">Delete</PrimaryButton>
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
        accounts: Object
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
        deleteAccount(item){
            if(confirm("Do you really want to delete this user account?")){
                this.form.delete(route('users.destroy', item.id), {
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
