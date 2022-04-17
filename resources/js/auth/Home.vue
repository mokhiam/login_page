<template>
    <div class="text-center ">
        <p style="font-size:40px" >hi {{user.name}}</p>
    </div>
</template>
<script>
import {mapState} from "vuex";
import {isLoggedIn} from "./../shared/utils/auth";
export default { 
    computed: {
    ...mapState({
      isLoggedIn: "isLoggedIn",
      user:"user"
    })
      },
    mounted(){
    if(!isLoggedIn())
    {
      this.$router.push("auth/login");
    }
  },
}
</script>
<style scoped>
.text-center {
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);
padding: 10px;
}
</style>
