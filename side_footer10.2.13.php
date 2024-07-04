<script src="mootools.js" type="text/javascript"></script>
<script src="animate.js" type="text/javascript"></script>
<div id="sidebar">
				<div class="inner">
				
				
					<!--[if !IE]>start calendar<![endif]-->
					<div class="calendar">
						<div class="calendar_top">
							<div id="wrapper-clock">

	<div id="back-clock">
         <div id="upperHalfBack">
         		<img src="spacer.png" /><img id="hoursUpBack" src="Single/Up/AM/0.png"/>
                <img id="minutesUpLeftBack" src="Double/Up/Left/0.png" class="asd" /><img id="minutesUpRightBack" src="Double/Up/Right/0.png"/>
                <img id="secondsUpLeftBack" src="Double/Up/Left/0.png" /><img id="secondsUpRightBack" src="Double/Up/Right/0.png"/>
         </div>
         <div id="lowerHalfBack">
         		<img src="spacer.png" /><img id="hoursDownBack" src="Single/Down/AM/0.png" />
               <img id="minutesDownLeftBack" src="Double/Down/Left/0.png" /><img id="minutesDownRightBack" src="Double/Down/Right/0.png" />
               <img id="secondsDownLeftBack" src="Double/Down/Left/0.png" /><img id="secondsDownRightBack" src="Double/Down/Right/0.png" />
         </div>
	</div>
    
    
    <div id="front-clock">
         <div id="upperHalf">
         		<img src="spacer.png" /><img id="hoursUp" src="Single/Up/AM/0.png"/>
                <img id="minutesUpLeft" src="Double/Up/Left/0.png" /><img id="minutesUpRight" src="Double/Up/Right/0.png"/>
                <img id="secondsUpLeft" src="Double/Up/Left/0.png" /><img id="secondsUpRight" src="Double/Up/Right/0.png"/>
         </div>
         <div id="lowerHalf">
         		<img src="spacer.png" /><img id="hoursDown" src="Single/Down/AM/0.png"/>
               <img id="minutesDownLeft" src="Double/Down/Left/0.png" /><img id="minutesDownRight" src="Double/Down/Right/0.png" />
               <img id="secondsDownLeft" src="Double/Down/Left/0.png" /><img id="secondsDownRight" src="Double/Down/Right/0.png" />
         </div>
	</div>
 
    
</div>
<div style="margin-bottom:5px;"></div>
							<span><?php echo(gmdate("l, dS \of F Y ") . "<br />"); ?></span>
						</div>
	
						
						<!--[if !IE]>start section content footer<![endif]-->

						<!--[if !IE]>end section content footer<![endif]-->
					</div>
					
					
					<!--[if !IE]>start quick info<![endif]-->
	  <div class="quick_info">
						<div class="quick_info_top">
							<h2>Quick info</h2>
						</div>
						<div class="quick_info_content">
							<dl>
								<dt><?php     
								$remaining_sms_credit=admin_credit_info($login_user_name);
								echo $remaining_sms_credit['user_allocated_sms_credit'];
						?></dt>
								<dd>Credit Remaining</dd>
							</dl>
							
						</div>
						<span class="quick_info_bottom"></span>
					</div>
					<!--[if !IE]>end quick info<![endif]-->
					
					
				
				
				</div>
		  </div>
			<!--[if !IE]>end sidebar<![endif]-->
			
			
			
			
		</div>
		<!--[if !IE]>end content<![endif]-->
		
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	
	<!--[if !IE]>start footer<![endif]-->
	<div id="footer">
		<div id="footer_inner">
		
		<dl class="copy">
			<dt><strong>Free SMS</strong> <em>build 2013</em></dt>
			<dd>&copy; MM Services Ltd.  All rights reserved.</dd>
		</dl>
		
		<!-- <dl class="quick_links">
			<dt><strong>Quick Links :</strong></dt>
			<dd>
				<ul>
					<li><a href="#">Dashboard </a></li>
					<li><a href="#">My Account</a></li>
					<li><a href="#">General Settings</a></li>
					<li><a href="#">Static Pages</a></li>
					<li><a href="#">Users</a></li>
					<li><a href="#">Products</a></li>
					<li><a href="#">Marketing</a></li>
					<li class="last"><a href="#">Log out</a></li>
				</ul>
			</dd>
		</dl> -->
		
		
		<dl class="help_links">
			<dt><strong>Need Help ?</strong></dt>
			<dd>
				<ul>
					<li><a href="#">Live Help</a></li>
					<li><a href="#">FAQ</a></li>
					<li class="last"><a href="#">Knowledgebase</a></li>
				</ul>
			</dd>
		</dl>
	
		</div>
	</div>
	<!--[if !IE]>end footer<![endif]-->
	
</body>
</h