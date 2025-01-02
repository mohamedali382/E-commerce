import products from "./product.js";
import sizes from './productSizes.js';
import { getCart, setCart } from './cart.js';

const initApp = (products, ProSizes) => {
    let idProduct = new URLSearchParams(window.location.search).get("id");
    let info = products.filter((value) => value.Pro_ID == idProduct)[0];
    if (!info) {
        window.location.href = "/";
    }
    
    let detail = document.querySelector(".section-one");
    detail.querySelector(".photo img").src = info.pro_image;
    detail.querySelector(".name").innerHTML = info.Pro_name;
    let image = info.pro_image;
    let name = info.Pro_name;

    populateSizes(idProduct, ProSizes);

    // Add the event listener for price update on size selection
    document.getElementById('sizeSelector').addEventListener('change', () => {
        updatePrice(idProduct, ProSizes);
    });

    detail.querySelector(".description").innerHTML = info.Description;
    detail.querySelector(".addCart").dataset.id = idProduct;

    // Add the "Add to Cart" event listener only once
    const addCartButton = document.getElementById('addCart');
    addCartButton.addEventListener('click', () => {
        const selectedSize = document.getElementById('sizeSelector').value;
        const selectedItem = ProSizes.find(item => item.pro_id === idProduct && item.size === selectedSize);
        if (selectedItem) {
            addToCart(idProduct, image, name,selectedItem.id ,selectedItem.price, selectedItem.size);
        }
    });

    // Similar products section
    let ListProduct = document.querySelector(".similar-products");
    ListProduct.innerHTML = null;
    products
        .filter((value) => value.Pro_ID != idProduct)
        .forEach((product) => {
            let newProduct = document.createElement("div");
            newProduct.classList.add("product");
            newProduct.innerHTML = ` 
                <a href="./details.html?id=${product.Pro_ID}">
                <img src = "${product.pro_image}"/>
                </a>
                <h2>${product.Pro_name}</h2>
                <div class="price">$${product["max-price"]} - $${product["min-price"]}</div>`;
            ListProduct.appendChild(newProduct);
        });
};

function populateSizes(idProduct, productSize) {
    const sizeSelector = document.getElementById('sizeSelector');
    const filtered = productSize.filter(item => item.pro_id === idProduct);

    filtered.forEach(item => {
        const option = document.createElement('option');
        option.value = item.size;
        option.textContent = item.size;
        sizeSelector.appendChild(option);
    });
}

function updatePrice(idProduct, productSize) {
    const selectedSize = document.getElementById('sizeSelector').value;
    const priceDisplay = document.getElementById('priceDisplay');
    const addCartButton = document.getElementById('addCart');
  
    const selectedItem = productSize.find(item => item.pro_id === idProduct && item.size === selectedSize);
  
    if (selectedItem) {
        priceDisplay.textContent = `Price: $${selectedItem.price}`;
        addCartButton.disabled = false;
        addCartButton.style.backgroundColor = 'black';
    } else {
        priceDisplay.textContent = 'Price:';
        addCartButton.disabled = true;
    }
}

const addToCart = (id, image, name,priceId, price, size) => {
    let cart = getCart();
    let item = {
        Id: id,
        Image: image,
        Name: name,
        price_Id: priceId,
        Price: price,
        Size: size,
        Count: 1,
    };

    // Check if the product already exists in the cart
    let foundProduct = cart.find((product) => product.Id === item.Id && product.Size === item.Size);
    if (foundProduct) {
        foundProduct.Count++;  // Increment count if found
    } else {
        cart.push(item);  // Add new item to the cart
    }
    
    console.log('Updated cart:', cart);
    setCart(cart);
};

// Initialize the app with products and sizes
Promise.all([products, sizes])
    .then(([data, size]) => {
        initApp(data, size);
    });
