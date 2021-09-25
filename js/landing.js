/* ----------- Navbar fading when in hero-section ----------- */

const checkpoint = 600;

window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll <= checkpoint) {
        opacity = 0 + currentScroll / checkpoint;
        opacity2 = 1 - currentScroll / checkpoint;
    } else {
        opacity = 1;
        opacity2 = 0;
    }
    document.querySelector("nav").style.opacity = opacity;
    document.querySelector("#arrow-down").style.opacity = opacity2;
    document.querySelector("#arrow-up").style.opacity = opacity;
    if(opacity <= 0)
    {
        document.querySelector("#arrow-up").style.display = "none";
    }
    else
    {
        var w = window.innerWidth
        if(w <= 1024)
        {
            document.querySelector("#arrow-up").style.display = "block";
        }
        else
        {
            document.querySelector("#arrow-up").style.display = "none";
        }
    }
});

/* ------------------- Dissolve author div ------------------- */

const authorTag = document.querySelector("#author");

authorTag.addEventListener("click", () => {
    authorTag.classList.add("hide");
});