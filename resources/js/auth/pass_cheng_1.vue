<template>
  <div class="w-50 m-auto">
    <div class="card card-body">
      <form>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input
            type="text"
            name="email"
            placeholder="Enter your e-mail"
            class="form-control"
            v-model="email"
            :class="[{'is-invalid': errorFor('email')}]"
          />
          <v-errors :errors="errorFor('email')"></v-errors>
        </div>
        <button
            type="submit"
            class="btn btn-primary btn-lg btn-block"
            @click.prevent="send_email"
            :disabled="loading"
        >send-email</button>
        <hr />
      </form>
    </div>
  </div>
</template>

<script>
import { set_email } from "./../shared/utils/auth";
export default {
    data(){
        return{
          email: null,
          errors:null,
          loading:null,
        };
    },
    methods:{
        async send_email(){
          this.loading=true;
            this.errors = null;
            try{
                await axios.post("/api/chek_email", {
                email: this.email,
                });
                set_email(this.email);
                this.$store.commit('setEmail',this.email);
                const code=await axios.post("/api/email", {
                email: this.email,
                });
                this.$router.push("/auth/rest_pass_2");
            }catch(error){
                this.errors = error.response && error.response.data.errors;  
            }
            this.loading=false;
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
