<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Table from "@/Components/Table.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableRow from "@/Components/TableRow.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import { usePermission } from "@/composables/permissions";
import DataTable from "@/Components/MyComponents/DataTable2.vue";
const props = defineProps({
  equipos: Object,
});
const {hasPermission} = usePermission();

const tablekeysheaders= ref({
     'marca':'Marca','serie':'Serie','tipo_equipo':'Tipo Equipo','oficina.nombre':'Oficina','estado':'Estado'
    }
);

const customClassColum= ref({
        'estado': {
            'Regular': "rounded-full bg-yellow-100 px-2 py-1 font-semibold text-yellow-600 border-2 border-yellow-600 dark:bg-gray-700 dark:text-yellow-400",
            'Pesimo': "rounded-full bg-red-100 px-2 py-1 font-semibold text-red-600 border-2 border-red-600 dark:bg-gray-700 dark:text-red-400",
            'Bueno': "rounded-full bg-blue-100 px-2 py-1 font-semibold text-blue-600 border-2 border-blue-600 dark:bg-gray-700 dark:text-blue-400",
            'Excelente': "rounded-full bg-green-100 px-2 py-1 font-semibold text-green-600 border-2 border-green-600 dark:bg-gray-700 dark:text-green-400",
        }
    }
);
const customButtons= ref([{
        label: "Editar",
        action: 'editar',
        permisos: hasPermission('equipo update'),
        buttonClasses: "inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150",
    },
    {
        label: "Eliminar",
        action: 'eliminar',
        permisos: hasPermission('equipo delete'),
        buttonClasses: "inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150",
    },
    // Puedes agregar más botones personalizados con clases de estilo personalizadas
]);

const tableFiltros= ref([]);

const form = useForm({});

const editEquipo = (id) => {
  form.get(route("admin.equipos.edit", id));
};

const deleteEquipo = (id) => {
  form.delete(route("admin.equipos.destroy", id));
};
</script>

<template>
  <Head title="Equipos" />
  <AdminLayout>
    <div class="max-w-7xl mx-auto py-4">
      <div class="flex justify-end mr-6" v-if="hasPermission('equipo create')">
        <Link :href="route('admin.equipos.create')" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Registrar Equipo</Link>
        <!-- <SecondaryButton @click="FormStore">Registrar Equipo</SecondaryButton> -->
        <!-- <Modal :show="showModel" @close="closeModal">
          <div class="p-4">
            <div class="mb-6">
              <InputLabel>Marca</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Serie</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Protocolo de Internet (IP)</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Estado</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Observación</InputLabel>
              <textarea class="w-full rounded" rows="5" v-model="gdgfdg"/>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Tipo de equipo</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mb-6">
              <InputLabel>Oficina</InputLabel>
              <TextInput class="w-full" v-model="gdgfdg"></TextInput>
              <InputError class="mt-2" />
            </div>
            <div class="mt-6 flex space-x-4 justify-end">
              <SecondaryButton @click="closeModal">Cancelar</SecondaryButton>
              <SecondaryButton @click="save">Registrar</SecondaryButton>
            </div>
          </div>
        </Modal> -->
      </div>
      <div class="mt-6">
        <DataTable
        :numerarRow="true"
        :table-keys-headers="tablekeysheaders" 
        :tableData="equipos"
        :customButtons="customButtons"
        :custom-class-colum="customClassColum"
        :tableFiltros="tableFiltros"
        @editar="editEquipo"
        @eliminar="deleteEquipo"
        />
        <!-- <Table>
          <template #header>
            <TableRow>
              <TableHeaderCell>Marca</TableHeaderCell>
              <TableHeaderCell>Serie</TableHeaderCell>
              <TableHeaderCell>Ip</TableHeaderCell>
              <TableHeaderCell>Estado</TableHeaderCell>
              <TableHeaderCell>Tipo</TableHeaderCell>
              <TableHeaderCell>Oficina</TableHeaderCell>
              <template v-if="hasPermission('equipo update','equipo delete')">
                <TableHeaderCell>Acciones</TableHeaderCell>
              </template>
            </TableRow>
          </template>
          <template #default>
            <TableRow v-for="equipo in equipos" :key="equipo.id">
              <TableDataCell class="space-x-4">{{ equipo.marca }}</TableDataCell>
              <TableDataCell class="space-x-4">{{ equipo.serie }}</TableDataCell>
              <TableDataCell class="space-x-4">{{ equipo.ip }}</TableDataCell>
              <TableDataCell class="space-x-4">{{ equipo.estado }}</TableDataCell>
              <TableDataCell class="space-x-4">{{ equipo.tipo_equipo }}</TableDataCell>
              <TableDataCell class="space-x-4">{{ equipo.oficina.nombre }}</TableDataCell>
              <TableDataCell class="space-x-4">
                <div class="mt-6 flex space-x-4">
                  <template v-if="hasPermission('equipo update')">
                    <Link :href="route('admin.equipos.edit', equipo.id)" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                      Editar
                    </Link>
                  </template>
                  <template v-if="hasPermission('equipo delete')">
                    <Link
                    :href="route('admin.equipos.destroy', equipo.id)"
                    method="delete"
                    as="button"
                    type="button"
                    class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                    >Delete</Link
                  >
                  </template>
                </div>
              </TableDataCell>
            </TableRow>
          </template>
        </Table> -->
      </div>
    </div>
  </AdminLayout>
</template>

<style lang="scss" scoped></style>
