console.log("autocomplete.js is loaded!");

document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("supplier");
    const resultBox = document.getElementById("autocomplete-list");

    input.addEventListener("keyup", function () {
        const query = input.value.trim();
        if (query.length < 1) {
            resultBox.innerHTML = "";
            return;
        }

        fetch("ajax_suppliers.php?term=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                resultBox.innerHTML = "";
                data.forEach(item => {
                    const div = document.createElement("div");
                    div.textContent = item;
                    div.style.cursor = "pointer";
                    div.style.padding = "5px";

                    div.addEventListener("click", function () {
                        input.value = item;
                        resultBox.innerHTML = "";
                    });

                    resultBox.appendChild(div);
                });
            });
    });
});
