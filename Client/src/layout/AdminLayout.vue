<script setup>
</script>

<template>
  <!--start the project-->
  <div id="main-wrapper" class=" flex p-5 xl:pr-0 bg-[#f0f5f9]">
    <aside id="application-sidebar-brand"
      class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full  transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0  w-[280px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar   transition-all duration-300">
      <!-- ---------------------------------- -->
      <!-- Start Vertical Layout Sidebar -->
      <!-- ---------------------------------- -->
      <div class="p-4">
        <!-- Logo -->
      </div>
      <div class="scroll-sidebar" data-simplebar="">
        <nav class=" w-full flex flex-col sidebar-nav px-4 mt-5">
          <ul id="sidebarnav" class="text-gray-600 text-sm">
            <li class="text-xs font-bold pb-[15px]">
              <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
              <span class="text-xs text-gray-400 font-semibold">HOME</span>
            </li>

            <li class="sidebar-item">
              <div
                class="sidebar-link gap-3 py-2.5 my-1  cursor-pointer flex items-center relative  rounded-md   w-full">
                <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                  <path
                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                </svg> <span class="text-xl font-semibold">Users</span>

              </div>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Bottom Upgrade Option -->
      <div class="m-4  relative grid">
        <button class="text-base font-semibold hover:bg-red-700 btn">Log Out</button>
      </div>
      <!-- </aside> -->
    </aside>
    <div class=" w-full page-wrapper xl:px-6 px-0">

      <!-- Main Content -->
      <main class="h-full  max-w-full  ">
        <div class="container full-container p-0 flex flex-col gap-6">
          <!--  Header Start -->
          <header class=" bg-white shadow-md rounded-md w-full text-sm py-4 px-6">
            <nav class=" w-ful flex items-center justify-between" aria-label="Global">
              <ul class="icon-nav flex items-center gap-4">

              </ul>
              <div class="flex items-center gap-4">
                <a href="#" class="btn text-base font-medium hover:bg-green-700" aria-current="page">Upgrade to Pro</a>
                <div class="hs-dropdown relative inline-flex [--placement:bottom-right] sm:[--trigger:hover]">
                  <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                    <!-- <img class="object-cover w-9 h-9 rounded-full" src="@@webRoot/assets/images/profile/user-1.jpg"
                      alt="" aria-hidden="true"> -->
                  </a>
                </div>


              </div>
            </nav>
          </header>
          <!--  Header End -->
        </div>
        <div class=" min-h-[calc(100vh-110px)]">
          <slot></slot>
        </div>
      </main>
      <!-- Main Content End -->

    </div>
  </div>
  <!--end of project-->





</template>

<style scoped>
[data-simplebar] {
  position: relative;
  flex-direction: column;
  flex-wrap: wrap;
  justify-content: flex-start;
  align-content: flex-start;
  align-items: flex-start;
}

.simplebar-wrapper {
  overflow: hidden;
  width: inherit;
  height: inherit;
  max-width: inherit;
  max-height: inherit;
}

.simplebar-mask {
  direction: inherit;
  position: absolute;
  overflow: hidden;
  padding: 0;
  margin: 0;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  width: auto !important;
  height: auto !important;
  z-index: 0;
}

.simplebar-offset {
  direction: inherit !important;
  box-sizing: inherit !important;
  resize: none !important;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  padding: 0;
  margin: 0;
  -webkit-overflow-scrolling: touch;
}

.simplebar-content-wrapper {
  direction: inherit;
  box-sizing: border-box !important;
  position: relative;
  display: block;
  height: 100%;
  /* Required for horizontal native scrollbar to not appear if parent is taller than natural height */
  width: auto;
  max-width: 100%;
  /* Not required for horizontal scroll to trigger */
  max-height: 100%;
  /* Needed for vertical scroll to trigger */
  overflow: auto;
  scrollbar-width: none;
  -ms-overflow-style: none;
}

.simplebar-content-wrapper::-webkit-scrollbar,
.simplebar-hide-scrollbar::-webkit-scrollbar {
  display: none;
  width: 0;
  height: 0;
}

.simplebar-content:before,
.simplebar-content:after {
  content: ' ';
  display: table;
}

.simplebar-placeholder {
  max-height: 100%;
  max-width: 100%;
  width: 100%;
  pointer-events: none;
}

.simplebar-height-auto-observer-wrapper {
  box-sizing: inherit !important;
  height: 100%;
  width: 100%;
  max-width: 1px;
  position: relative;
  float: left;
  max-height: 1px;
  overflow: hidden;
  z-index: -1;
  padding: 0;
  margin: 0;
  pointer-events: none;
  flex-grow: inherit;
  flex-shrink: 0;
  flex-basis: 0;
}

.simplebar-height-auto-observer {
  box-sizing: inherit;
  display: block;
  opacity: 0;
  position: absolute;
  top: 0;
  left: 0;
  height: 1000%;
  width: 1000%;
  min-height: 1px;
  min-width: 1px;
  overflow: hidden;
  pointer-events: none;
  z-index: -1;
}

.simplebar-track {
  z-index: 1;
  position: absolute;
  right: 0;
  bottom: 0;
  pointer-events: none;
  overflow: hidden;
}

[data-simplebar].simplebar-dragging {
  pointer-events: none;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

[data-simplebar].simplebar-dragging .simplebar-content {
  pointer-events: none;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

[data-simplebar].simplebar-dragging .simplebar-track {
  pointer-events: all;
}

.simplebar-scrollbar {
  position: absolute;
  left: 0;
  right: 0;
  min-height: 10px;
}

.simplebar-scrollbar:before {
  position: absolute;
  content: '';
  background: black;
  border-radius: 7px;
  left: 2px;
  right: 2px;
  opacity: 0;
  transition: opacity 0.2s 0.5s linear;
}

.simplebar-scrollbar.simplebar-visible:before {
  opacity: 0.5;
  transition-delay: 0s;
  transition-duration: 0s;
}

.simplebar-track.simplebar-vertical {
  top: 0;
  width: 11px;
}

.simplebar-scrollbar:before {
  top: 2px;
  bottom: 2px;
  left: 2px;
  right: 2px;
}

.simplebar-track.simplebar-horizontal {
  left: 0;
  height: 11px;
}

.simplebar-track.simplebar-horizontal .simplebar-scrollbar {
  right: auto;
  left: 0;
  top: 0;
  bottom: 0;
  min-height: 0;
  min-width: 10px;
  width: auto;
}


.simplebar-dummy-scrollbar-size {
  direction: rtl;
  position: fixed;
  opacity: 0;
  visibility: hidden;
  height: 500px;
  width: 500px;
  overflow-y: hidden;
  overflow-x: scroll;
  -ms-overflow-style: scrollbar !important;
}

.simplebar-dummy-scrollbar-size>div {
  width: 200%;
  height: 200%;
  margin: 10px 0;
}

.simplebar-hide-scrollbar {
  position: fixed;
  left: 0;
  visibility: hidden;
  overflow-y: scroll;
  scrollbar-width: none;
  -ms-overflow-style: none;
}


.simplebar-scrollbar:before {
  background: rgba(0, 0, 0, 0.5) !important;
}

.left-sidebar .scroll-sidebar {
  height: calc(100vh - 180px);
}


#sidebarnav .sidebar-item .sidebar-link::before {
  position: absolute;
  top: 0;
  bottom: 0;
  left: -16px;
  content: "";
  width: 0;
  height: 100%;
  z-index: -1;
  border-radius: 0px 24px 24px 0px;
  transition: all 0.4s ease-in-out;
  background-color: #e5f3fb;
}

#sidebarnav .sidebar-item .sidebar-link:hover:before {
  width: calc(100% + 16px);
}

#sidebarnav .sidebar-item .sidebar-link.active:before {
  width: calc(100% + 16px);
}

#sidebarnav .sidebar-item .sidebar-link.active {
  color: #006aaf;
}

#sidebarnav .sidebar-item .sidebar-link:hover {
  color: #006aaf;
}

.page-wrapper {
  margin-left: 270px;
}

@media (max-width: 1280px) {
  .page-wrapper {
    margin-left: 0px;
  }

}
</style>