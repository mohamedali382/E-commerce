<?php 
include './nav.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/main.css" />
    <title>Burd</title>
  </head>
  <body>

    <main>
      <section class="section-one">
        <img src="./img/Screenshot_16-9-2024_23231_.jpeg" alt="" />
        <article>
          <h4>50% OFF summer super sale</h4>
          <h1>
            Unleash your street <br />
            style with our new <br />fashion
          </h1>
          <a href="./Products.php"><button>shop now</button></a>
        </article>
      </section>
      <section class="pre-section-one">
        <div class="categories">
          <div class="market">
            <div class="shop-link">
              <a href="./Products.php"><div>All</div></a>
            </div>
            <p>for ages 1 - 7 years</p>
          </div>
          <div class="market">
            <div class="shop-link">
            <a href="#"><div class="pending">Boys</div></a>
            </div>
            <p>will be avaliable soon</p>
          </div>
          <div class="market">
            <div class="shop-link">
            <a href="#"><div class="pending">Girls</div></a>
            </div>
            <p>will be avaliable soon</p>
          </div>
        </div>
      </section>
      <section class="section-two">
        <div class="services">
          <img src="./img/Truck.svg" alt="" />
          <h4>Free shipping</h4>
          <p>
            free shipping on all AUE <br />
            orders or orders above 400$
          </p>
        </div>
        <div class="services">
          <img src="./img/box.svg" alt="" />
          <h4>14 days return</h4>
          <p>
            Benefit from a 14-day <br />
            return policy
          </p>
        </div>
        <div class="services">
          <img src="./img/Icon (4).png" alt="" />
          <h4>pay online</h4>
          <p>
          Enjoy paying online and have<br />
          your order processed instantly.
          </p>
        </div>
      </section>
      <section class="section-three">
        <a href="./details.php?id=17">
        <div class="home-photo">
          <div class="home-font">
            <h3>ALL ages from</h3>
            <p>3 months to 7 years</p>
          </div>
        </div>
        </a>
        <div class="home-photos-two">
          <a href="details.php?id=27">
          <div class="photo-one">
            <div class="home-font">
              <p>weekly offers</p>
              <h3>new collection</h3>
              <p>All ages form 1 - 7</p>
            </div>
          </div>
          </a>
          <a href="./Products.php">
          <div class="photo-two">
            <div class="home-font">
              <h3>See more</h3>
              <p>bijamas</p>
            </div>
          </div>
          </a>
        </div>
      </section>
    </main>
  <?php 
  include './footer.php';
  ?>
  </body>
</html>