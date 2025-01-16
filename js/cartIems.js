import { getCart, setCart } from "./cart.js";
let cart = getCart();
const checkOut = document.getElementById("checkOut");
const guest = document.getElementById("guest");
const Close = document.getElementById("close");
const message = document.getElementById('message');
const tp = document.getElementById("TotalP");

let totalPrice = 0;

console.log(cart);
cart.forEach((element) => {
  let cartItems = document.getElementById("cartItems");
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

  // items count
  let plus = document.createElement("span");

  plus.innerText = `+`;

  let minus = document.createElement("span");

  minus.innerHTML = `-`;

  let itemCount = document.createElement("p");
  itemCount.textContent = `${element.Count}`;

  let price = element.Price * element.Count;
  let itemPrice = document.createElement("p");
  itemPrice.textContent = `Price: $${price}`;

  totalPrice += (element.Price * element.Count);
  tp.innerText = `${totalPrice}`;

  plus.addEventListener("click", () => {
    element.Count++;
    itemCount.textContent = `${element.Count}`;
    price = element.Price * element.Count;
    itemPrice.textContent = `Price: $${price}`;
    totalPrice += (element.Price * 1);
    tp.innerText = `${totalPrice}`;
    setCart(cart);
  });

  minus.addEventListener("click", () => {
    if (element.Count === 1) {
      cart = cart.filter(
        (item) => !(item.Id === element.Id && item.Size === element.Size)
      );
      cartItems.removeChild(pro);
    } 
    else {
      element.Count--;
      itemCount.textContent = `${element.Count}`;
      price = element.Price * element.Count;
      itemPrice.textContent = `Price: $${price}`;
    }
    setCart(cart);
    totalPrice -= (element.Price * 1);
    tp.innerText = `${totalPrice}`;
    
  });
  localStorage.setItem("total price", totalPrice);
  // Append image, name, price, and size to the product div
  pro.append(itemImage, itemName, plus, itemCount, minus, itemPrice, itemSize);

  // Append the product div to the cart items container
  cartItems.appendChild(pro);

});

Close.addEventListener('click', () =>{
  window.history.back();
})
checkOut.addEventListener("click", () => {
  if (cart.length === 0) {
    
    message.textContent = "Your cart is empty";
    
  } else {
    const jsonData = JSON.stringify({ 'total': totalPrice, 'orderItems': cart });

fetch("dataTransfer.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: jsonData
})
  
.then(response => response.text())  
.then(result => console.log(result))
.then(() => {
  window.location.href = "purcash.php";
})
.catch(error => console.error("Error:", error));
  }
});

guest.addEventListener("click", () => {
  if (cart.length === 0) {
    
    message.textContent = "Your cart is empty";
    
  } else {
    const jsonData = JSON.stringify({ 'total': totalPrice, 'orderItems': cart });

fetch("dataTransfer.php", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: jsonData
})
  
.then(response => response.text())  
.then(result => console.log(result))
.then(() => {
  window.location.href = "purcash_guest.php";
})
.catch(error => console.error("Error:", error));
  }
});
