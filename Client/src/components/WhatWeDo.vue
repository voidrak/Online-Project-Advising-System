<script setup>
import image1 from "@/assets/image/image-1.svg"
import image2 from "@/assets/image/image-2.svg"
import image3 from "@/assets/image/image-3.svg"
</script>

<template>
    <section class="py-8 md:py-16">

        <div class="container max-w-screen-xl mx-auto px-4">

            <h1 class="font-semibold text-gray-700 text-3xl md:text-4xl text-center mb-5">What we do?</h1>

            <p class="font-normal text-gray-500 text-md md:text-lg text-center mb-10 md:mb-20">We provide comprehensive
                project advising and management services to help students succeed in their academic endeavors.</p>

            <div class="flex flex-col xl:flex-row items-center justify-between mb-20 md:mb-40">
                <div class="mx-auto xl:mx-0 mb-20 xl:mb-0">
                    <img :src="image1" alt="Image">
                </div>

                <div class="mx-auto xl:mx-0 text-center xl:text-left">
                    <h1 class="font-bold text-gray-700 text-3xl md:text-4xl mb-10">Expert Guidance</h1>

                    <p class="font-normal text-gray-400 text-sm md:text-lg mb-5"> Our advisors provide personalized
                        guidance <br /> to help you navigate your project from start to finish. <br />
                        We ensure you have the resources and support needed to <br /> succeed in your academic
                        endeavors.
                    </p>

                    <a href="#"
                        class="flex items-center justify-center xl:justify-start font-semibold text-green-500 text-lg gap-3 hover:text-green-700 transition ease-in-out duration-300">
                        See more
                        <i data-feather="chevron-right"></i>
                    </a>
                </div>
            </div>

            <div class="flex flex-col xl:flex-row items-center justify-between mb-20 md:mb-40">
                <div class="mx-auto xl:mx-0 text-center xl:text-left mb-20 xl:mb-0">
                    <h1 class="font-bold text-gray-700 text-3xl md:text-4xl mb-10">Resource Management.
                    </h1>

                    <p class="font-normal text-gray-400 text-sm md:text-lg mb-5"> We provide tools and resources to help
                        you manage <br />
                        your project efficiently, ensuring you stay on track <br /> and meet your deadlines.
                    </p>

                    <a href="#"
                        class="flex items-center justify-center xl:justify-start font-semibold text-green-500 text-lg gap-3 hover:text-green-700 transition ease-in-out duration-300">
                        See more
                        <i data-feather="chevron-right"></i>
                    </a>
                </div>

                <div class="mx-auto xl:mx-0">
                    <img :src="image2" alt="Image">
                </div>
            </div>

            <div class="flex flex-col xl:flex-row items-center justify-between">
                <div class="mx-auto xl:mx-0 mb-20 xl:mb-0">
                    <img :src="image3" alt="Image">
                </div>

                <div class="mx-auto xl:mx-0 text-center xl:text-left">
                    <h1 class="font-bold text-gray-700 text-3xl md:text-4xl mb-10">Collaboration and Support</h1>

                    <p class="font-normal text-gray-400 text-sm md:text-lg mb-5"> We offer a collaborative platform
                        where <br /> students can share ideas, get feedback, and work <br /> together to achieve their
                        project goals. <br /> Our support system ensures you have the guidance <br /> you need at every
                        step.
                    </p>

                    <a href="#"
                        class="flex items-center justify-center xl:justify-start font-semibold text-green-500 text-lg gap-3 hover:text-green-700 transition ease-in-out duration-300">
                        See more
                        <i data-feather="chevron-right"></i>
                    </a>
                </div>
            </div>

        </div> <!-- container.// -->

    </section>
</template>