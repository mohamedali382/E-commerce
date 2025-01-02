<?php 
include './connect.php';
include './nav.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/contactUs.css" />
    <title>Document</title>
  </head>
  <body>
    <main>
      <div class="formSection">
        <form action="sendMessage.php" method="POST">
          <div class="fonts">
            <h1>Get in touch</h1>
            <p>drop a message here</p>
          </div>
          <div class="inputs">
            <input type="text" placeholder="First name" name="FirstName"/>
            <input type="text" placeholder="Last name" name="LastName"/>
            <input type="text" placeholder="number" name="Number"/>
            <input type="text" placeholder="Email" name="Email"/>
            <textarea placeholder="your message" name="message" id=""></textarea>
          </div>
          <div class="buttons">
            <button type="submit" name="click">submit</button>
            <p>Policy-privicy</p>
            <p>© 2024</p>
          </div>
        </form>
        <?php
        if (isset($_SESSION['Mess'])) {
            echo "<h4>" . $_SESSION['Mess'] . "</h4>";
            unset($_SESSION['Mess']);
        }
        ?>
      </div>
      <section>
        <div class="section-one">
            <h2>Contact Us</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus tempora voluptatum doloremque sequi eos nisi, natus velit nihil impedit fugiat voluptatem illo totam ex odit aliquid sapiente tenetur facere numquam?</p>
            <p>ma392213@gmail.com</p>
            <p>0112-360-7019</p>
        </div>
        <div class="section-two">
            <article>
                <h3 >reports</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, ea. Reiciendis obcaecati consequuntur veritatis enim nesciunt rem? Rem ab fugiat, suscipit non eius id inventore, optio possimus a</p>
            </article>
            <article>
                <h3>Feedback</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam iste reiciendis quo! Eligendi totam nihil minima nulla sed quia alias accusamus provident deserunt dignissimos, corporis, tempora</p>
            </article>
            <article>
                <h3>Media</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias dicta nulla saepe doloremque impedit quibusdam est voluptate vero quas tempora magnam, reiciendis earum repellendus exercitation</p>
            </article>
        </div>
      </section>
    </main>
    <?php 
    include './footer.php';
    ?>
  </body>
</html>