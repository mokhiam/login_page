import axios from "axios";
import router from './routes';
import { isLoggedIn,logOut,set_token,del_token,get_token,get_email} from "./shared/utils/auth";
export default {
    state: {
        isLoggedIn: false,
        user: {},
        email:null
    },
    mutations: {
        setUser(state, payload) {
            state.user = payload;
        },
        setLoggedIn(state, payload) {
            state.isLoggedIn = payload;
        },
        setEmail(state,payload){
            state.email=payload;
        }
    },
    actions:{
        async loadStoredState( {commit, dispatch }) {
        commit("setLoggedIn", isLoggedIn());
        commit('setEmail',get_email());
        try{
            const token=get_token();
            const user=(await axios.get("/user",{
            headers: {"Authorization" : `${token}`}
            })).data;
            commit("setUser", user);
            }catch(error){
                axios.post("/logout");
                dispatch("logout");
                router.push("/auth/login").catch(()=>{});
            }
        },
        async loadUser({ commit, dispatch }) {
            if (isLoggedIn()) {
                try {
                    const token=get_token();
                    const user=(await axios.get("/user",{
                    headers: {"Authorization" : `${token}`}
                    })).data;
                    console.log(user);
                    commit("setUser", user);
                    commit("setLoggedIn", true);
                } catch (error) {
                    dispatch("logout");
                }
            }
        },
        logout({ commit }) {
            commit("setUser", {});
            commit("setLoggedIn", false);
            logOut();
            del_token();

        }

    },

}; 