document.addEventListener("DOMContentLoaded", function () {
    const currentPath = window.location.pathname;
    console.log("Current Path:", currentPath);
    document.querySelectorAll(".nav-link").forEach(link => {
        link.classList.remove("active", "bg-gradient-dark", "text-white");
        link.classList.add("text-dark");
    });

    document.querySelectorAll(".nav-link").forEach(link => {
        if (link.pathname === currentPath) {
            link.classList.add("active", "bg-gradient-dark", "text-white");
            link.classList.remove("text-dark");
        }
    });

    document.querySelectorAll(".nav-link").forEach(link => {
        link.addEventListener("click", function () {
            document.querySelectorAll(".nav-link").forEach(item => {
                item.classList.remove("active", "bg-gradient-dark", "text-white");
                item.classList.add("text-dark");
            });
            this.classList.add("active", "bg-gradient-dark", "text-white");
            this.classList.remove("text-dark");
        });
    });
});
