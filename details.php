<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/details.css" />
    <title>Document</title>
  </head>
  <body>
  <header>
      <div class="offer">free shipping on orders over 200 AED</div>
      <div class="head">
        <div>carch</div>
        <div><h1>BuRd</h1></div>
        <div class="personals">
          <a href="./signForms.php">Account</a>
          <a href="./cart.php">Cart</a>
        </div>
      </div>
      <nav>
        <ul>
          <li><a href="./index.php">Home</a></li>
          <li><a href="./Products.php">Shop All</a></li>
          <li><a href="./aboutUs.php">about us</a></li>
          <li><a href="./ContactUs.php">contact us</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <section class="section-one">
        <div class="photo">
          <img src="" alt="" />
        </div>
        <article>
          <div class="name"></div>
          <h2 class="price" id="priceDisplay">Price:</h2>
          <select name="" id="sizeSelector" aria-placeholder="select">
            <option disabled selected>select size</option>
          </select>
          <div class="description"></div>
          <button class="addCart" id="addCart"  disabled>Add to cart</button>
        </article>
      </section>

      <section class="section-two">
        <h2>may you like</h2>
        <div class="similar-products">
        </div>
      </section>
    </main>
    <footer>
      <div class="links">
        <h1>BuRd</h1>
      </div>
      <div class="links">
        <h3>Info</h3>
        <div class="spans">
          <span>Digital</span>
          <span>Print</span>
          <span>Tutorial</span>
          <span>FAQ</span>
        </div>
      </div>
      <div class="links">
        <h3>connect</h3>
        <div class="spans">
          <span><a href="#">instgram</a></span>
          <span><a href="#">Facebook</a></span>
          <span><a href="#">tiktok</a></span>
          <span><a href="#">contact</a></span>
        </div>
      </div>
      <div class="links">
        <h3>Pen Pals</h3>
        <div class="spans">
          <span><a href="#">instgram</a></span>
          <span><a href="#">Facebook</a></span>
        </div>
      </div>
    </footer>
    <script type="module" src="./js/details.js"></script>
  </body>
</html>