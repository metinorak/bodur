<?php require_once APPROOT . '/views/inc/' . 'header.php'; ?>


    <!-- Begin page content -->
    <main role="main" class="container">
      <h1 class="mt-5">URL Shortener</h1>
      <p class="lead">You can shorten your URLs easily.</p>


      <form class = "row container" action="<?php echo URLROOT .'/pages/addUrl'; ?>" method="post">
        <input type="text" name = 'url' class = "form-control col-sm-9" placeholder = "Enter the URL">
        <input type="submit" class = "col-sm-3 btn-primary" value="Shorten">
      </form>
      
    </main>



    <?php if(!empty($data['code'])): ?>

      <div class="jumbotron mt-4">
        <div class="container">
          <h2 class="mt-2">Your short URL: <a href="<?php echo URLROOT . '/' . $data['code']; ?>"><strong style = "font-size: 1.2em"><?php echo remove_http(URLROOT) . '/' . $data['code']; ?></strong></a></h2>
          <p class = "text-muted">
            Original URL:
            <?php echo $data['url']; ?> 
          </p>
        </div>
        
      </div>

    <?php endif; ?>


<?php require_once APPROOT . '/views/inc/' . 'footer.php'; ?>