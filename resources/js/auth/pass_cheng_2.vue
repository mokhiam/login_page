<template>
  <div class="w-50 m-auto">
    <div class="card card-body">
      <form>
        <div class="form-group">
          <label for="code">Code</label>
          <input
            type="text"
            name="Code"
            placeholder="Enter your Code"
            class="form-control"
            v-model="code"
            :class="[{'is-invalid': errorFor('code')}]"
          />
          <v-errors :errors="errorFor('code')"></v-errors>
        </div>
        <button
            type="submit"
            class="btn btn-primary btn-lg btn-block"
            @click.prevent="check_code"
        >send-code</button>
        <hr />
      </form>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState({
      email: "email",
    }),
  },
    data(){
        return {
            code:null,
            errors:null,
        }
    },
    methods:{
        async check_code(){
            this.errors=null;
            try{
                await axios.post("/api/chek_code",{
                  email: this.email,
                  code:this.code  
                });
                this.$router.push({name:'pass_cheng_3'});
            }catch(error){
                this.errors = error.response && error.response.data.errors;  
            }
        },
        errorFor(field) {
        return null !== this.errors && this.errors[field]
                ? this.errors[field]
                : null;
        }

    }

}

</script>