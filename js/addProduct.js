let multiinput = document.getElementById('multiinput');
let addition = document.getElementById('addition');

addition.addEventListener('click', function() {
    let newsize = document.createElement('div');
    newsize.classList.add('sizes');
    newsize.innerHTML = `
                <div class="size">
                    <label>Size</label>
                    <input type="text" name="size[]" required>
                </div>
                <div class="size">
                    <label>Price</label>
                    <input type="number" name="price[]" required>
                </div>
            
    `;
    multiinput.appendChild(newsize);
    multiinput.style
});