import products from "./product.js";

const appendProductsToTable = (products) => {
  const list = document.getElementById("pro");
  products.forEach((element) => {
    let item = document.createElement("div");
    item.classList.add('product')
    item.innerHTML = `
                <a href="./details.php?id=${element.Pro_ID}">
                    <img src="${element.pro_image}" alt="${element.Pro_name}"/>
                </a>
            <p>${element.Pro_name}</p>
            <h3>${element["max-price"]} - ${element["min-price"]}</h3>
        `;
    list.appendChild(item);
  });
};

products.then((data) => {
  appendProductsToTable(data);
});
