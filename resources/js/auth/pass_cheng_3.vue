<template>
  <div class="w-50 m-auto">
    <div class="card card-body">
      <form>
        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            placeholder="Enter your password"
            class="form-control"
            v-model="password"
            :class="[{ 'is-invalid': errorFor('password') }]"
          />
          <v-errors :errors="errorFor('password')"></v-errors>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Re-type Password</label>
          <input
            type="password"
            name="password_confirmation"
            placeholder="Confirm your password"
            class="form-control"
            v-model="password_confirmation"
            :class="[{ 'is-invalid': errorFor('password_confirmation') }]"
          />
          <v-errors :errors="errorFor('password_confirmation')"></v-errors>
        </div>
        <button
            type="submit"
            class="btn btn-primary btn-lg btn-block"
            @click.prevent="set_pass"
        >entert-new-password</button>
        <hr />
      </form>
    </div>
  </div>
</template>

<script>
import { logIn,isLoggedIn,set_token ,del_email} from "./../shared/utils/auth";
import { mapState } from "vuex";
export default {
      computed: {
    ...mapState({
      email: "email",
     }),
    },
    data(){
        return {
            password:null,
            password_confirmation:null,
            errors:null,
        }
    },
    methods:{
        async set_pass(){
            this.errors=null;
            try{
                const ch=await axios.post("/api/chenage_pass",{
                  email: this.email,
                  password:this.password,
                  password_confirmation:this.password_confirmation
                });
            const token = (
            await axios.post("/api/login", {
              email: this.email,
              password: this.password,
            })
          ).data;
          set_token(token);
          logIn();
          this.$store.dispatch("loadUser");
          this.$router.push({ name: "home" });
          del_email();
            }catch(error){
                this.errors = error.response && error.response.data.errors;  
                if(this.errors['code'])
                {
                  this.$router.push("/");
                }
            }
        },
        errorFor(field) {
        try{
        return null !== this.errors && this.errors[field]
                ? this.errors[field]
                : null;
          }catch(error){
             return [
              'error'
            ];
          }
        }

    }

}

</script>