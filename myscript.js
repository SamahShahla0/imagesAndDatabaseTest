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