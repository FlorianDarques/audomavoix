let wichDarkMode = localStorage.getItem("darkmode") // création d'une var qui contient le stockage du darkmode
const body = document.body;

if(window.location.href == 'http://localhost/audomavoix/connexion.php' || window.location.href == 'http://5.135.101.252/audomavoix/connexion.php' || window.location.href == 'http://5.196.139.186/audomavoix/connexion.php'){

document.querySelector('.fa-user').className = 'fa-solid fa-house'
document.querySelector('.nav-link').href = "index.php"
document.querySelector('.singer').src = "../../audomavoix/img/singer3.svg"
}
if(window.location.href == 'http://localhost/audomavoix/member.php' || window.location.href == "http://5.135.101.252/audomavoix/member.php" || window.location.href == 'http://5.196.139.186/audomavoix/member.php') {
    document.querySelector('.fa-user').className = "fa-solid fa-power-off"
    document.querySelector('.nav-link').href = "deconnexion.php"
}
if(window.location.href == 'http://localhost/audomavoix/memberphp.php' || window.location.href == "http://5.135.101.252/audomavoix/memberphp.php" || window.location.href == 'http://5.196.139.186/audomavoix/memberphp.php') {
    document.querySelector('.fa-user').className = "fa-solid fa-power-off"
    document.querySelector('.nav-link').href = "deconnexion.php"
}
if(window.location.href == 'http://localhost/audomavoix/inscription.php' || window.location.href == 'http://5.135.101.252/audomavoix/inscription.php' || window.location.href == 'http://5.196.139.186/audomavoix/inscription.php'){
    document.querySelector('.singer').src = "../../audomavoix/img/singer2.svg"
}

if(window.location.href == 'http://localhost/audomavoix/member.php' || window.location.href == 'http://5.135.101.252/audomavoix/member.php' || window.location.href == 'http://5.196.139.186/audomavoix/member.php'){
    document.querySelector('.singer').src = "../../audomavoix/img/singer4.svg"
}

let btnDarkMode = document.querySelector(".darkmode");
console.log(btnDarkMode);

btnDarkMode.addEventListener("click", () => {

    if (body.classList.contains("light")){
        body.classList.add("dark");
        localStorage.setItem("darkmode", "dark") 
        document.querySelector('.fa-sun').className = "fa-regular fa-moon"
        document.querySelector('.logo-av').src="../../audomavoix/img/Logo.svg"
        body.classList.remove("light");
    } 
    else if (body.classList.contains("dark")){
        body.classList.add("light");
        localStorage.setItem("darkmode", "light") 
        document.querySelector('.fa-moon').className = "fa-regular fa-sun"
        document.querySelector('.logo-av').src="../../audomavoix/img/Logo-Black.svg"
        body.classList.remove("dark");
    }
})      
    if(wichDarkMode === "light"){
        body.classList.add("light");
        localStorage.setItem("darkmode", "light") 
        document.querySelector('.fa-moon').className = "fa-regular fa-sun"
        document.querySelector('.logo-av').src="../../audomavoix/img/Logo-Black.svg"
        body.classList.remove("dark");
    } 
    else if(wichDarkMode === "dark"){
        body.classList.add("dark");
        localStorage.setItem("darkmode", "dark") 
        document.querySelector('.fa-sun').className = "fa-regular fa-moon"
        document.querySelector('.logo-av').src="../../audomavoix/img/Logo.svg"
        body.classList.remove("light");
    }
