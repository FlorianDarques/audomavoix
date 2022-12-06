if(window.location.href == 'http://localhost/audomavoix/connexion.php' || window.location.href == 'http://5.135.101.252/audomavoix/connexion.php'){
document.querySelector('.fa-user').className = 'fa-solid fa-house'
document.querySelector('.nav-link').href = "index.php"
}
if(window.location.href == 'http://localhost/audomavoix/member.php' || window.location.href == "http://5.135.101.252/audomavoix/member.php") {
    document.querySelector('.fa-user').className = "fa-solid fa-power-off"
    document.querySelector('.nav-link').href = "deconnexion.php"
}
// console.log(window.location.href);

let btnDarkMode = document.querySelector(".darkmode");
console.log(btnDarkMode);

btnDarkMode.addEventListener("click", () => {

    const body = document.body;

    if (body.classList.contains("light")){

        body.classList.add("dark");
        document.querySelector('.fa-sun').className = "fa-regular fa-moon"
        document.querySelector('.logo-av').src="../../audomavoix/img/Logo.svg"
        body.classList.remove("light");


    } else if (body.classList.contains("dark")){

        body.classList.add("light");
        document.querySelector('.fa-moon').className = "fa-regular fa-sun"
        document.querySelector('.logo-av').src="../../audomavoix/img/Logo-Black.svg"
        body.classList.remove("dark");

    }

})