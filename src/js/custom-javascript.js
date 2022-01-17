// Add your custom JS here.
let moon = document.getElementById("parallax-moon");
let monster = document.getElementById("parallax-monster");
let treesLg = document.getElementById("parallax-trees-lg");
let treesMd = document.getElementById("parallax-trees-md");
let treesSm = document.getElementById("parallax-trees-sm");
let paraTitle = document.getElementById("parallax-title");

window.addEventListener('scroll', function() {
    var value = window.scrollY;

    moon.style.top = value * 0.8 + 'px';
    monster.style.top = value * -0.4 + 'px';
    treesLg.style.bottom = value * 0.5 + 'px';
    treesMd.style.top = value * 0.3 + 'px';
    treesSm.style.bottom = value * 0.1 + 'px';
    paraTitle.style.top = value * 0.7 + 'px';
})