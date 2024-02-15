// Fetch items from the server
function getItems(){
  fetch("get_items.php")
  .then((response) => response.json())
  .then((products) => {
    const itemsContainer = document.getElementById("itemsContainer");
    products.forEach((product) => {
      const itemElement = document.createElement("div");
      itemElement.classList.add("item");

      const imgElement = document.createElement("img");
      imgElement.src = "data:image/jpeg;base64," + product.image_base64;
      imgElement.alt = product.name;

      const h2Element = document.createElement("h2");
      h2Element.textContent = product.name;

      const pElement = document.createElement("p");
      pElement.textContent = "Description of " + product.name;

      itemElement.appendChild(imgElement);
      itemElement.appendChild(h2Element);
      itemElement.appendChild(pElement);

      itemsContainer.appendChild(itemElement);
    });
  })
  .catch((error) => console.error("Error fetching items:", error));
}
getItems();

/*-------------------------------------------------------------------------------------------------------*/
const form = document.querySelector("#form");
form.addEventListener("submit", async function(e){
  e.preventDefault();
  const formData = new FormData();
  const fileField = document.querySelector('#image');
  const thename = document.querySelector('#name');
  formData.append("name", thename.value);
  formData.append("image", fileField.files[0]);

  /*for (const pair of formData.entries()) {
    console.log(pair[0], pair[1]);
    console.log("////////////////////////////")
    console.log(typeof  pair[1]);
  }*/

  try {
    const response = await fetch("http://localhost/imagesAndDatabaseTest/insert_product.php", {
      method: "POST",
      body: formData,
    });
    const result = await response.json();
    console.log("Success:", result);
  } catch (error) {
    console.error("Error:", error);
  }
});
