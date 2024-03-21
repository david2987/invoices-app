<script setup>
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
<nav class="bg-red-600 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700" style="border-color: #e7e7e7;">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="flex justify-between h-16">
                        <div class="flex ">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('invoices')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex  ">
                                <NavLink :href="route('invoices')" :active="route().current('invoices')"  class="text-md text-white" >
                                    <i class="bi bi-file-earmark-ruled"></i> Invoices
                                </NavLink>                               
                                <NavLink :href="route('services')" :active="route().current('services')"  class="text-md text-white">
                                    <i class="bi bi-currency-dollar"></i> Services
                                </NavLink>                              
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger> 
                                        Salir                                      
                                    </template>                                    
                                </Dropdown>
                            </div>
                        </div>

                       
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('invoices')" :active="route().current('invoices')">
                            invoices
                        </ResponsiveNavLink>                       
                        <ResponsiveNavLink :href="route('services')" :active="route().current('services')">
                            Services
                        </ResponsiveNavLink>
                    </div>                                    
                </div>
            </nav>

</template>
    
  <style scoped>
    .link{
        color:white
    }
  /* Add any additional Tailwind CSS styles here */
  </style>
  

