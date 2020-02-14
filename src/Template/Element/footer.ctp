
    <div class="row" style="background: #7e0e09; height: 250px; padding: 2%; color: white; margin: 0; margin-top: 5%">
            <div class = "col col-9">
	            <b style="color: yellow"> Contact Us </b>
                <p>
                    Emails: 
			        <?php
			        	foreach ($emails as $email):
			        ?>
						<?= $email->contact_email ?>

        			<?php
        				endforeach;
        			?>
        	 		|
        		</p>

        		<p>
					Contact Numbers: 
					<?php
						foreach ($numbers as $number):
					?>
							<?= $number->contact_number ?>
        			<?php
        				endforeach;
        			?>
        	 		|
        		</p>
        	</div>

            <div class = "pull-right col-3">
            	<style>
            		.btn.btn-indigo, .btn.btn-indigo.disabled, .btn.btn-indigo.disabled:focus, .btn.btn-indigo.disabled:hover, .btn.btn-indigo[disabled], .btn.btn-indigo[disabled]:focus, .btn.btn-indigo[disabled]:hover  {
    					color: #fff;
    					background: #7b81a0;
					}
            	</style>
            	<a href="http://www.pup.edu.ph/" class="btn btn-white" title="PUP Official Website">	
  					<?php
  						echo $this->Html->image("../webroot/img/PUPlogosmall.png",['style' => 'width: 100%; margin: 1%']);
                    ?>
				</a> 
            	<a href="https://www.facebook.com/ThePUPOfficial/" class="btn btn-lg btn-indigo" title="Like us on Facebook">
  					<i class="fab fa-facebook fa-2x"></i>
				</a> 
            	<a href="https://twitter.com/official_pupqc" class="btn btn-lg btn-primary" title="Follow us on Twitter">
  					<i class="fab fa-twitter fa-2x"></i>
				</a> 
            </div>     

	</div>