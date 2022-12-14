<template>
  <Loader v-if="contestLoading" :is-full-screen="true" />
  <div v-else class="mt-5 md:col-span-2 md:mt-0 w-full md:w-[500px] mx-auto">
    <form @submit.prevent="saveContest">
      <div class="shadow sm:overflow-hidden sm:rounded-md">
        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
          <div class="flex justify-between">
            <h1 class="text-xl uppercase mb-2">
              {{ model.id ? model.contest_name : "Add new Contest" }}
            </h1>
            <router-link
              :to="{ name: 'Contest' }"
              class="underline text-blue-800"
              >Cancel</router-link
            >
          </div>
          <div class="grid grid-cols-3 gap-6">
            <div class="col-span-12">
              <label
                for="headline"
                class="block text-sm font-medium text-gray-700"
                >Event</label
              >
              <select
                class="select select-bordered w-full mt-3"
                v-model="model.event_id"
              >
                <option
                  v-for="({ id, event_name }, index) in events"
                  :key="index"
                  :value="id"
                  requried
                >
                  {{ event_name }}
                </option>
              </select>
            </div>
          </div>
          <div class="grid grid-cols-3 gap-6">
            <div class="col-span-12">
              <label
                for="headline"
                class="block text-sm font-medium text-gray-700"
                >Contest</label
              >
              <div class="mt-4 flex shadow-sm">
                <input
                  v-model="model.contest_name"
                  type="text"
                  name="headline"
                  id="headline"
                  class="input block w-full flex-1 rounded-sm border-gray-300 focus:border-transparent focus:ring-none sm:text-sm"
                />
              </div>
            </div>
          </div>

          <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700"
              >Contest Date</label
            >
            <Datepicker
              format="yyyy/MM/dd"
              v-model="model.contest_date"
              class="mt-2"
            ></Datepicker>
          </div>
          <div
            class="px-4 py-3 sm:px-6 flex items-center justify-center space-x-7"
          >
            <div class="form-control">
              <label class="label cursor-pointer space-x-2">
                <span class="label-text text-lg">Active</span>
                <input
                  type="checkbox"
                  class="checkbox checkbox-primary"
                  v-model="model.status"
                />
              </label>
            </div>
          </div>
        </div>

        <div class="px-4 py-3 text-right sm:px-6 -mt-12">
          <button
            type="submit"
            class="btn bg-green-600 text-white gap-1 uppercase shadow mt-4 rounded btn-success"
          >
            Save <mdicon name="content-save" />
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
<script setup>
import { ref, watch, computed } from "vue";
import store from "../../store";
import { useRoute, useRouter } from "vue-router";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import moment from "moment";
import Loader from "../Loader.vue";
import { v4 as uuidv4 } from "uuid";
// import router from "../../../router";

const route = useRoute();
const router = useRouter();
let model = ref({
  uuid: "",
  contest_name: "",
  status: "",
  event_id: "",
  contest_date: "",
});

const events = computed(() => store.state.events.data);
const contestLoading = computed(() => store.state.currentContest.loading);

store.dispatch("getEvents");

watch(
  () => store.state.currentContest.data,
  (newVal, oldVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
      status: newVal.status !== "draft",
    };
    model.value.event_id = model.value.event.id;
    console.log(newVal);
  }
);

if (route.params.id) {
  store.dispatch("getContest", route.params.id);
}

const saveContest = () => {
  let action = "created";
  if (model.value.id) {
    action = "updated";
  }

  if (!model.value.uuid) {
    model.value.uuid = uuidv4();
  }

  model.value.contest_date = moment(model.value.contest_date).format(
    "YYYY-MM-DD"
  );
  store
    .dispatch("saveContest", model.value)
    .then(({ data }) => {
      store.commit("notify", {
        type: "success",
        message: "Contest data was successfully " + action,
      });
      router.push({
        name: "Contest",
      });
    })
    .catch((err) => {
      store.commit("notify", {
        type: "error",
        message: "Something went wrong, please try again or contact your admin",
      });
    });
};
</script>
