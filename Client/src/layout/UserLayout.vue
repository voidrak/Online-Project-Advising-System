<script setup>
import logo from "../assets/image/navbar-logo.svg"
import Navbar from "@/components/Navbar.vue"
import Footer from "@/components/Footer.vue"
</script>

<template>

  <section>
    <section class="container max-w-screen-xl mx-auto px-4 py-4 md:py-8 flex flex-col min-h-screen">
      <Navbar />
      <main class="flex-grow">
        <slot></slot>
      </main>
    </section>
    <Footer />
  </section>

</template>