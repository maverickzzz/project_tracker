<template>
        <Menu as="div" class="relative inline-block text-left z-10">
            <div>
                <MenuButton>
                    Hello, <span class="font-bold capitalize">{{ $page.props._user.name }}</span>
                </MenuButton>
            </div>

            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <MenuItems
                    class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                    <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                            <Link href="/change-password"
                            class="group flex w-full items-center rounded-md px-2 py-2 text-sm hover:bg-black/[0.08]"
                        >
                            <Icon :name="'lock'" /> Change Password
                        </Link>
                        </MenuItem>
                    </div>
                    <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                            <Link href="/logout"
                                class="group flex w-full items-center rounded-md px-2 py-2 text-sm text-danger hover:btn-danger hover:text-white"
                            >
                                <Icon :name="'power-off'" /> Log Out
                            </Link>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
</script>
