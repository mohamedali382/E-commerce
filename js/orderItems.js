const order_items = fetch('./orderItems.json')
.then((response) => {
    if (!response.ok) {
      throw new Error("failed to load orders");
    }
    return response.json();
  })
  .catch((error) => {
    console.error("error fetch oreders: ", error);
  });

export default order_items;