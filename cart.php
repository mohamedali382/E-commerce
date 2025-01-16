<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/cart.css">
    <title>Document</title>
  </head>
  <body>
    <main>
      <section id="cartItems"></section>
      <div class="totalPrice"><span>Total price: </span><span id="TotalP">0</span>$</div>
      <div class="buttons">
        <button id="close">Close</button>
        <div class="payments">
        <button id="checkOut">check Out</button>
        <button id="guest">continue as a guest</button>
        </div>
      </div>
      <div class="message" id="message"></div>
    </main>

    <script type="module" src="js/cartIems.js"></script>
  </body>
</html>
