<script setup>
  import {ref, onMounted} from "vue";
  import { useAuth }     from '@/Store/auth';
  import { useBooking }  from '@/Store/booking'

  import DashboardLayout from '@/Layouts/Dashboard.vue';
  import PageTitle       from '@/Shared/Partials/PageTitle.vue';
  import DateInput       from '@/Shared/Fields/DateInput.vue';


  const auth    = useAuth();
  const booking = useBooking();

  const date     = ref(null);
  const bookings = ref([]);

  onMounted( async () => {
    const { data } = await booking.list();  
    bookings.value = data;
  });

  // send a request with filters
  const filterList = async (selectedDate) => {
    const { data } = await booking.list(selectedDate);  
    bookings.value = data;
  };

</script>
<template>
  <DashboardLayout>
    <PageTitle title="Bookings" :subtitle="'Welcome to ' + auth.user?.name + ', here is the list of bookings'" />
    <section class="w-full"> 
        <div class="flex flex-col md:col-span-2 md:row-span-2 bg-white shadow rounded-lg">
        <div class="px-6 py-5 font-bold border-b border-gray-100">List of bookings</div>
        <div class="p-4 flex-grow">

            <div class="w-full md:w-1/3 mb-6 md:mb-0 pb-3">
                <DateInput @update:modelValue="filterList" v-model="date" type="text" />
            </div>

            <table v-if="bookings?.length" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Phone</th>
                            <th scope="col" class="px-6 py-3">Make</th>
                            <th scope="col" class="px-6 py-3">Model</th>
                            <th scope="col" class="px-6 py-3">Slot</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr 
                            v-for="(booking, index) in bookings"
                         
                            class="bg-white  dark:bg-gray-800  hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            <td class="px-6 py-4">{{ booking.name }}</td>
                            <td class="px-6 py-4">{{ booking.email }}</td>
                            <td class="px-6 py-4">{{ booking.phone }}</td>
                            <td class="px-6 py-4">{{ booking.make }}</td>
                            <td class="px-6 py-4">{{ booking.model }}</td>
                            <td class="px-6 py-4">{{ booking.slot }}</td>
                            <td class="px-6 py-4">{{ booking.date }}</td>
                        </tr>
                    </tbody>
            </table>

            <div v-else class="p-3 pl-0">
                There are no bookings
            </div>
        </div>
        </div>
    </section>
  </DashboardLayout>
</template>
  