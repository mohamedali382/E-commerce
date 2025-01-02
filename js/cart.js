// Initialize the cart either from localStorage or as an empty array
export const getCart = () => {
    const cartData = localStorage.getItem("cart");
    return cartData ? JSON.parse(cartData) : []; // Return the parsed cart or an empty array
};

// Function to save the cart to localStorage
export const setCart = (newCart) => {
    localStorage.setItem("cart", JSON.stringify(newCart)); 
    
};



