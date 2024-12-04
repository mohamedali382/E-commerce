const products = fetch('./products.json')
    .then(response => {
        if (!response.ok) throw new Error('Failed to load products.json');
        return response.json(); // Parses the JSON data
    })
    .catch(error => {
        console.error('Error fetching products:', error);
    });

export default products;