// Fetch items from the server
fetch("get_items.php")
.then((response) => response.json())
.then((items) => {
  const itemsContainer = document.getElementById("itemsContainer");
  items.forEach((item) => {
    const itemElement = document.createElement("div");
    itemElement.classList.add("item");

    const imgElement = document.createElement("img");
    imgElement.src = "data:image/jpeg;base64," + item.image_base64;
    imgElement.alt = item.name;

    const h2Element = document.createElement("h2");
    h2Element.textContent = item.name;

    const pElement = document.createElement("p");
    pElement.textContent = "Description of " + item.name;

    itemElement.appendChild(imgElement);
    itemElement.appendChild(h2Element);
    itemElement.appendChild(pElement);

    itemsContainer.appendChild(itemElement);
  });
})
.catch((error) => console.error("Error fetching items:", error));