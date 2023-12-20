<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    digimon: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Digimon Detalle" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Digimon Detalle
            </h2>
            <a :href="route('dashboard')">Regresar</a>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-4 justify-start px-8 py-8">
                        <img
                            :src="digimon.images[0].href"
                            :alt="digimon.name"
                            class="w-[20rem]"
                        />
                        <span>ID: {{ digimon.id }}</span>
                        <span>Nombre: {{ digimon.name }}</span>
                        <span
                            >Descripción:
                            {{
                                digimon.descriptions.find(
                                    (des) => des.language == "en_us"
                                ).description
                            }}</span
                        >
                        <div class="flex flex-row gap-4 items-center">
                            <span>Skills: </span>
                            <div
                                class="flex flex-row gap-2"
                                v-for="skill in digimon.skills"
                                :key="skill.id"
                            >
                                <div class="bg-slate-300 rounded px-2 py-2">
                                    {{ skill.skill }}
                                </div>
                            </div>
                        </div>
                        <span>Evoluciones anteriores</span>
                        <hr />
                        <div
                            class="grid grids-cols-3 md:grid-cols-6 lg:grid-cols-8"
                        >
                            <div
                                class="flex flex-col justify-center text-center gap-2"
                                v-for="evo in digimon.priorEvolutions"
                                :key="evo.id"
                            >
                                <img
                                    :src="evo.image"
                                    :alt="evo.digimon"
                                    class="w-full"
                                />
                                <span>{{ evo.digimon }}</span>
                            </div>
                        </div>
                        <span>Evoluciones siguientes</span>
                        <hr />
                        <div
                            class="grid grids-cols-3 md:grid-cols-6 lg:grid-cols-8"
                        >
                            <div
                                class="flex flex-col justify-center text-center gap-2"
                                v-for="evo in digimon.nextEvolutions"
                                :key="evo.id"
                            >
                                <img
                                    :src="evo.image"
                                    :alt="evo.digimon"
                                    class="w-full"
                                />
                                <span>{{ evo.digimon }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
