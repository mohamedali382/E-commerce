import orders from "./orders.js";
import order_items from "./orderItems.js";
import products from "./product.js";


const App = (orders,order_item,products) =>{
    let Details = document.getElementById('details');
    let OrderId = new URLSearchParams(window.location.search).get("ord");
    let orderDetails = orders.filter((order)=> order.Order_ID === OrderId)[0];
    if (!orderDetails) {
        window.location.href = "/";
    }
    //////////////////////////////////////////// append Id - date - time //////////////////////////////////
    let detailsHeader = document.createElement("div");
    detailsHeader.classList.add("orderHeader");
    
    let ID = document.createElement('h2');
    ID.classList.add("Order_id");
    ID.textContent = `Order ID: ${orderDetails.Order_ID}`;
    
    let Date = document.createElement('h2');
    Date.classList.add("Date");
    Date.textContent = `Date: ${orderDetails.Date}`;
    
    let Time = document.createElement('h2');
    Time.classList.add("Time");
    Time.textContent = `Time: ${orderDetails.Time}`;
    
    detailsHeader.append(ID,Date,Time)

    Details.appendChild(detailsHeader);
    /////////////////////////////////////////////////// append order item details////////////////////////////
    let orderItems = order_item.filter((items) => items.Ord_ID === OrderId)// fetch data from product items and products.js
    orderItems.forEach((items) => {
        let pro = products.filter((product) => product.Pro_ID === items.product_id)[0];
        console.log(pro);
        let item = document.createElement('div');
        item.classList.add('item');
        
        let image = document.createElement('img');
        image.classList.add('image');
        image.src = pro.pro_image;

        let name = document.createElement('span');
        name.classList.add('itemName');
        name.textContent = `Product: ${pro.Pro_name}`;

        let price = document.createElement('span');
        price.classList.add("itemPrice");
        price.textContent = `price: $${items.price}`;

        let size = document.createElement('span');
        size.classList.add("itemSize");
        size.textContent = `size: ${items.size}`;

        let count = document.createElement('span');
        count.classList.add("itemCount");
        count.textContent = `counter: ${items.count}`;

        let itemTotalPrice = document.createElement('span');
        itemTotalPrice.classList.add("itemTotalPrice");
        itemTotalPrice.textContent = `$${items.count * items.price}`;

        item.append(image,name,price,size,count,itemTotalPrice);
        Details.appendChild(item);
    })
    let detailsFooter = document.createElement("div");
    detailsFooter.classList.add("detailsFooter");
    
    // let status = document.createElement('h2');
    // status.classList.add("stauts");
    // let stat = `status: pending` ? orderDetails.order_status === 0 : `status: history`;
    //  status.textContent = stat;
    
    let Total = document.createElement('span');
    Total.classList.add("total_price");
    Total.textContent = `total: $${orderDetails.Total_Price}`;

    
    detailsFooter.append(Total,status)

    Details.appendChild(detailsFooter);
}
////////////////////////////////append total price - status ////////////////////////////////////////


Promise.all([orders, order_items,products])
    .then(([order, items,products]) => {
        App(order, items,products);
    });
