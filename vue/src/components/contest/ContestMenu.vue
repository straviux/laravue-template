<template>
  <div class="navbar bg-base-100">
    <div class="navbar-start">
      <div class="dropdown">
        <label tabindex="0" class="btn btn-ghost lg:hidden">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h8m-8 6h16"
            />
          </svg>
        </label>
      </div>
      <a class="btn btn-ghost normal-case text-xl">Contest Maintenance</a>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul
        tabindex="0"
        class="menu menu-compact menu-horizontal"
        role="tablist"
        id="tabs-tab"
      >
        <li class="nav-item hover:bg-white" role="presentation">
          <router-link
            :to="{ name: 'Contest' }"
            class="border-x-0 hover:bg-white focus:bg-white border-t-0 uppercase"
            active-class="border-b-2 border-color_1"
            >Contest</router-link
          >
        </li>
      </ul>
    </div>
    <div class="navbar-end">
      <router-link
        :to="{ name: 'AddContest' }"
        class="btn btn-sm gap-2 btn-primary text-white shadow-lg"
        ><mdicon name="chart-box-plus-outline" /> Add Contest</router-link
      >
    </div>
  </div>
</template>
<script setup></script>
