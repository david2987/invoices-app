<script setup>
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
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
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white dark:text-gray-400 bg-transparent dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>                                        
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
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
  

