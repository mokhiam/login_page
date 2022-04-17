export function isLoggedIn(){
    return localStorage.getItem("isLoggedIn")=='true';
}

export function logIn(){
   localStorage.setItem("isLoggedIn",true);
}

export function logOut(){
    localStorage.setItem("isLoggedIn",false);
}

export function set_token(token){
    localStorage.setItem("token",token);
}

export function del_token(){
    localStorage.removeItem("token");
}
export function get_token(){
    return localStorage.getItem("token");
}
export function set_email(email){
    return localStorage.setItem("email",email);
}
export function get_email(){
    return localStorage.getItem("email");
}

export function del_email(){
    localStorage.removeItem("email");
}