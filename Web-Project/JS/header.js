window.addEventListener("scroll", function () {
    let header = document.getElementById("header");
    let body = document.body;
    let scrollThreshold = 70;

    if (window.scrollY > scrollThreshold) {
        header.style.top = "-380px";
        body.style.marginTop = "0";
    }
    else {
        header.style.top = "0";

        if (body.classList.contains("menu-open")) {
            body.style.marginTop = "380px";
        }
        else if(body.classList.contains("custom"))
        {
            body.style.marginTop = "0";
        }
        else{
        body.style.marginTop = "100px";
    }
    }
});


document.getElementById("menu-toggle").addEventListener("click", function () {
    let navList = document.getElementById("nav-list");
    let body = document.body;

    navList.classList.toggle("show"); 
    body.classList.toggle("menu-open"); 

    if (body.classList.contains("menu-open")) {
        body.style.marginTop = "380px"; 
    }
    else if(body.classList.contains("custom"))
    {
        body.style.marginTop = "0";
    }
    else{
        body.style.marginTop = "100px";
    }
});
