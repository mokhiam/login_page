<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-white border-bottom navbar-light">
      <router-link class="navbar-brand mr-auto" :to="{ name: 'home' }"
        >Home</router-link
      >
      <ul class="navbar-nav">
        <li class="nav-item" v-if="!isLoggedIn">
          <router-link :to="{ name: 'register' }" class="nav-link"
            >Register</router-link
          >
        </li>
        <li class="nav-item" v-if="!isLoggedIn">
          <router-link :to="{ name: 'login' }" class="nav-link"
            >Sign-in</router-link
          >
        </li>
        <li class="nav-item" v-if="isLoggedIn">
          <a class="nav-link" href="#" @click="logout">Logout</a>
        </li>
      </ul>
    </nav>
    <div class="container mt-4 mb-4 pr-4 pl-4">
      <router-view></router-view>
    </div>
  </div>
</template> 

<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState({
      isLoggedIn: "isLoggedIn",
    }),
  },
  methods: {
    logout() {
      try {
        axios.post("/logout");
        this.$store.dispatch("logout");
        this.$router.push("auth/login");
      } catch (error) {
        this.$store.dispatch("auth/login");
        this.$router.push("/");
      }
    },
  },
};
</script>
  