<?php include'includes/top.php';?> 

<section class="home-slider owl-carousel img" style="background-image: url(routers/images/bg_1.jpg);">

      <div class="slider-item" style="background-image: url(routers/images/bg_3.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Contact Us</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="routers/index.html">Home</a></span> <span>Contact</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

<div class="container-fluid mt-5">
      <div class="col-12">
        <iframe width="100%" height="700px" frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAgewsgIixz9aD0Z2JagHpo49vBAU6F__o &amp;q=34+Church+Road" allowfullscreen="">
		</iframe>
      </div>
</div>

    <section class="ftco-section contact-section">
      <div class="container mt-2">
        <div class="row block-9">
					<div class="col-md-4 contact-info ftco-animate">
						<div class="row">
							<div class="col-md-12 mb-4">
	              <h2 class="h4">Contact Information</h2>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Website:</span> <a href="#">yoursite.com</a></p>
	            </div>
						</div>
					</div>
					<div class="col-md-1 mt-2"></div>
          <div class="col-md-6 ftco-animate">
	    			<form action="send_form_email.php" method="post" name="contactform" class="appointment-form">
	    				<div class="d-md-flex">
		    				<div class="form-group">
		    					<input type="text" name="fname" class="form-control" placeholder="First Name" pattern="[a-zA-Z]{1,}" maxlength="30" title="First name" required>
		    				</div>
	    				</div>
	    				<div class="d-me-flex">
	    					<div class="form-group">
		    					<input type="text" name="sname" class="form-control" placeholder="Last Name" pattern="[a-zA-Z]{1,}" maxlength="30" title="Surname" required>
		    				</div>
	    				</div>	    				
                        <div class="d-me-flex">
	    					<div class="form-group">
		    					<input type="email" name="email" class="form-control" placeholder="Email Address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
		    				</div>
	    				</div>
	    				<div class="form-group">
	                       <textarea name="comments" name="comments" cols="30" rows="3" class="form-control" placeholder="Message" required></textarea>
	                   </div>
	            <div class="form-group">
	              <input type="submit" value="submit" class="btn btn-primary py-3 px-4">
	            </div>
	    			</form>
            </form>
          </div>
        </div>
      </div>
    </section>
    
<?php include'includes/bot.php';?> 