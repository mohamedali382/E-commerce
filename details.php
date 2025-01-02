<?php 
include './nav.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/details.css" />
    <title>Document</title>
  </head>
  <body>
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
    <?php 
    include './footer.php';
    ?>
    <script type="module" src="./js/details.js"></script>
  </body>
</html>