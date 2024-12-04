import orders from "./orders.js";


const getOrders = (orders) => {
    const pending = document.getElementsByClassName('pending_orders')[0];
    const history = document.getElementsByClassName('history_orders')[0];
    orders.forEach( (orderObj) => {
        const order = document.createElement('div');
        order.classList.add('order');
        
        order.innerHTML = 
        `
        <h2 class="orderId">Order no: ${orderObj.Order_ID}</h2>
        <span class="orderPrice"> total: ${orderObj.Total_Price}</span>
        <span class="Time">${orderObj.Time}</span>
        <span class="date">${orderObj.Date}</span>
        <button><a href="./orderDetails.php?ord=${orderObj.Order_ID}">view</a></button>
        `

        if (orderObj.order_status == 0){
            pending.appendChild(order);
        }
        else{
            history.appendChild(order);
        }
    })
}

orders.then(order => {
    getOrders(order);
});