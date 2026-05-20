const signInForm=document.querySelector(".login-form");
const signUpForm=document.querySelector(".register-form");
const registerBtn=document.querySelector("#SignUpBtn");
const singInBtn=document.querySelector("#SignInBtn");

signInForm.onsubmit = (e)=>{
    e.preventDefault();
}

loginBtn.onclick = (e)=>{
    let xhr=new XMLHttpRequest();
    xhr.open('POST',"php/login.php",true);
    xhr.onload=()=>{
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response;
                if(data==="Login success"){
                    location.href="home.php";
                }
                else{
                    errorText.classList.add("show");
                    errorText.textContent=data;

                    setTimeout(()=>{
                        errorText.classList.remove("show");
                },3000)
            }
        }
    }
}
let formData=new FormData(signInForm);
xhr.send(formData);
}