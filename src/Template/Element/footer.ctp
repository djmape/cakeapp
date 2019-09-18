
<div style="background: #7e0e09; height: 150px; padding: 2%; color: white;s">
	
	<div class = "">
    <div class = "col col-lg-4">
	<b style="color: yellow"> Contact Us </b>
		<p>
			Emails: 
			<?php foreach ($emails as $email): ?>
			<?= $email->contact_email ?>
        	<?php endforeach; ?>
        	 |
        </p>

        <p>
			Contact Numbers: 
			<?php foreach ($numbers as $number): ?>
			<?= $number->contact_number ?>
        	<?php endforeach; ?>
        	 |
        </p>
        </div>
            <div class = "pull-right col col-lg-4">
            <a href="https://twitter.com/official_pupqc" class="btn btn-info btn-sm">
        		<i class="fa fa-twitter">
        		</i>
            </a>
            <style>
            	.btn.btn-indigo, .btn.btn-indigo.disabled, .btn.btn-indigo.disabled:focus, .btn.btn-indigo.disabled:hover, .btn.btn-indigo[disabled], .btn.btn-indigo[disabled]:focus, .btn.btn-indigo[disabled]:hover 
            	{
    				color: #fff;
    				background: #7b81a0;
				}
            </style>
            <a href="https://www.facebook.com/ThePUPOfficial/" class="btn btn-indigo btn-sm">
        		<i class="fa fa-facebook">
        		</i>
            </a>   
            </div>         
	</div>

</div>