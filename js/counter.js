import { getCart } from "./cart.js";
let cart = getCart();
let length = cart.length;
const count = document.getElementById('Cart_counter');
count.textContent = length;