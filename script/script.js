if(window.location.href == 'http://localhost/audomavoix/connexion.php'){
document.querySelector('.fa-user').className = 'fa-solid fa-house'
document.querySelector('.nav-link').href = "index.php"
}
// console.log(window.location.href);

let btnDarkMode = document.querySelector(".darkmode");
console.log(btnDarkMode);

btnDarkMode.addEventListener("click", () => {

    const body = document.body;

    if (body.classList.contains("light")){

        body.classList.add("dark");
        body.classList.remove("light");


    } else if (body.classList.contains("dark")){

        body.classList.add("light");
        document.querySelector('fa-moon').className = "fa-regular fa-sun"
        body.classList.remove("dark");

    }

})