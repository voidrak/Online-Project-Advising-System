<script setup>
import logo from "../assets/image/navbar-logo.svg"

</script>

<template>
    <footer class="bg-green-50 py-8 md:py-16">
        <div class="container max-w-screen-xl mx-auto px-4">
            <div class="lg:flex flex-col md:flex-row text-center lg:text-left lg:justify-between">
                <div class="mb-10 lg:mb-0">
                    <img :src="logo" alt="Image" class="mb-5 mx-auto lg:mx-0">
                    <p class="font-normal text-gray-400 text-md">Excepteur sint occaecat cupidatat non <br> proident,
                        sunt in
                        culpa qui officia deserunt <br> mollit anim id est laborum.</p>
                </div>
                <div class="space-y-4 mb-10 lg:mb-0">
                    <h4 class="font-semibold text-gray-500 text-lg mb-6">Our services</h4>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Pricing</a>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">UI
                        Design</a>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Animation</a>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Development</a>
                </div>
                <div class="space-y-4 mb-10 lg:mb-0">
                    <h4 class="font-semibold text-gray-500 text-lg mb-6">Our Company</h4>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Reporting</a>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Get
                        in Touch</a>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">Management</a>
                </div>
                <div class="space-y-4">
                    <h4 class="font-semibold text-gray-500 text-lg mb-6">Our services</h4>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">121
                        King St, VIC3000, US</a>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">888-123-42287</a>
                    <a href="#"
                        class="block font-normal text-gray-400 text-md hover:text-gray-700 transition ease-in-out duration-300">info@example.com</a>
                </div>
            </div>
            <hr class="text-gray-300 mt-10">
            <p class="font-normal text-gray-400 text-md text-center mt-5">&copy; 2021 Digital Agency. All rights
                reserved.
            </p>
        </div> <!-- container.// -->
    </footer>
</template>