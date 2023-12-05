const forms=document.querySelector(".forms"),
 pwShowHide=document.querySelectorAll(".eye-icon")
 links=document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click",() => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        console.log(pwFields);
    })
})

links.forEach(link =>{ 
    link.addEventListener("click",=>{
        preventDefault();
    })
})
