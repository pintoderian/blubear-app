<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    digimons: {
        type: Array,
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8"
                >
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-4"
                        v-for="digimon in digimons"
                        :key="digimon.id"
                    >
                        <img
                            :src="digimon.image"
                            :alt="digimon.name"
                            class="w-full"
                        />
                        <div
                            class="flex flex-col gap-4 justify-center mt-4 w-full text-center"
                        >
                            <span>ID: {{ digimon.id }}</span>
                            <a
                                class="text-xl hover:underline"
                                :href="route('digimon', { id: digimon.id })"
                            >
                                {{ digimon.name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
