let header_button = document.querySelector(".icon");
header_button.addEventListener("click", function(){
    // document.querySelector("header").classList.add("open");
    let header = document.querySelector("header");
    if (header.classList.contains("open")){
        close_popup();
    }
    else {
        header.classList.add("open");
        header_button.querySelector("img").src = "pngwing.com.png"
    }
});
function close_popup() {
    document.querySelector("header").classList.remove("open");
    header_button.querySelector("img").src = "list.png";
}

document.querySelector("#grid").addEventListener("click", close_popup, false);

document.querySelector("header .popup").addEventListener("click", close_popup, false);
/*Открытие окошка*/
document.querySelector("#show_add_photo").addEventListener("click", function(){
    document.querySelector("#add_new_photo").classList.add("open");
});
/*Кнопка Отмена*/
document.querySelector("#cancel")?.addEventListener("click", function (e) {
    e.preventDefault();
    document.querySelector("#add_new_photo")?.classList.remove("open");
});

/*Кнопка Добавить фото*/
document.querySelector("#add_photo")?.addEventListener("click", function(){
    let src = document.querySelector("#new_photo_src").value;
    let text = document.querySelector("#new_photo_text").value;
    if (src && text)
    {
    let new_photo_div = document.createElement("div");
    new_photo_div.classList.add("photo");
    let new_img = document.createElement("img");
    new_img.src = src;
    new_photo_div.append(new_img);
    let new_p = document.createElement("p");
    new_p.innerText = text? text:"Стандартный текст";
    new_photo_div.append(new_p);
    document.querySelector("#grid").prepend(new_photo_div);
    document.querySelector("#add_new_photo").classList.remove("open");
    new_photo_div.addEventListener("click", open_photo, false);
    }
    else {
        if(!src){
            document.querySelector("#new_photo_src").classList.add("error");
        }
        if(!text){
            document.querySelector("#new_photo_text").classList.add("error");
        }
    }
});

function open_photo() {
    let src = this.querySelector("img").src,
    popup_photo = document.querySelector("#popup_photo");
    popup_photo.querySelector("img").src = src;
    popup_photo.classList.add("open");
}

// let photos = document.querySelectorAll(".photo");
// for (let photo of photos) {
//     photo.addEventListener("click", open_photo, false);
// }

// document.querySelector("#popup_photo").addEventListener("click", function (){
//     this.classList.remove("open");
// })