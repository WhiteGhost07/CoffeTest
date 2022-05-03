document.querySelector("#add_comment").addEventListener("click", function()
{
    let text = document.querySelector("#text").value,
    url =  new URL(location.href),
    photo_id = url.searchParams.get("id");

    fetch("add_comment.php", {
        method: "POST",
        body: new URLSearchParams({
            text:text,
            photo_id: photo_id
        })
    })
    .then(async function(response){
        let data = await response.text();
        data = JSON.parse(data);
        let new_commnent_div = document.createElement("div");
        new_commnent_div.classList.add("comment");
        let new_commnent_author  = document.createElement("p");
        new_commnent_author.classList.add("author");
        new_commnent_author.innerText = data.name;
        
        let new_commnent_text  = document.createElement("p");
        new_commnent_text.classList.add("text");
        new_commnent_text.innerText = data.text;

        let new_commnent_date  = document.createElement("p");
        new_commnent_date.classList.add("date");
        new_commnent_date.innerText = data["post date"];   /* 8 */        
        new_commnent_div.append(new_commnent_author, new_commnent_text, new_commnent_date);
        document.querySelector(".comments h2").after(new_commnent_div);
        document.querySelector("#text").value = "";
    })
});