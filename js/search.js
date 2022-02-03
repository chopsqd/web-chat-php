const userList = document.querySelector(".users .users-list"),
      searchBar = document.querySelector(".users .search input"),
      searchBtn = document.querySelector(".users .search button");

searchBtn.addEventListener('click', () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
})

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../backend/users-list.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                if(!searchBar.classList.contains("active")) {
                    userList.innerHTML = xhr.response;
                }
            }
        }
    }
    xhr.send();
}, 500)

searchBar.addEventListener('keyup', () => {
    let searchTerm = searchBar.value;
    if(searchTerm !== "") {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../backend/search.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;
                userList.innerHTML = xhr.response;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
})