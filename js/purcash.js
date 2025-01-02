import { getCart } from "./cart.js";
let totalPrice = 0;

let cart = getCart();
const items = document.getElementById('requiredOrder');

console.log(cart);
cart.forEach((element) => {

  let pro = document.createElement("div");
  pro.classList.add("item");

  // Create and set image
  let itemImage = document.createElement("img");
  itemImage.src = element.Image;

  // Create and set name, price, and size
  let itemName = document.createElement("p");
  itemName.textContent = element.Name;

  let itemSize = document.createElement("p");
  itemSize.textContent = `Size: ${element.Size}`;

  let itemCount = document.createElement("p");
  itemCount.textContent = `${element.Count}`;

  let price = element.Price * element.Count;
  let itemPrice = document.createElement("p");
  itemPrice.textContent = `Price: $${price}`;

  pro.append(itemImage, itemName, itemCount,itemPrice, itemSize);

  totalPrice = totalPrice + (element.Count * price);
  items.appendChild(pro);
})
let tot = document.createElement("div")
tot.textContent = `total Price: $${totalPrice}`;
items.appendChild(tot)

/********************************* */

// Create a JSON object
const jsonData = JSON.stringify({ 'total': totalPrice, 'orderItems': cart });

fetch("dataTransfer.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: jsonData
})
  
.then(response => response.text())  // Handle the response
.then(result => console.log(result))  // Print the response in the console
.catch(error => console.error("Error:", error));

/********************************************* */
console.log("total price:", totalPrice);
console.log(cart);