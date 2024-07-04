<div id="main_menu">
                    <ul>
                    
                    <?php
    				switch ($user_type_code) {
    				case 1:
    				    echo '<li><a href="send_all_sms.php"><span><span>SEND SMS (ENGLISH)</span></span></a></li>';
						echo '<li><a href="send_all_sms_bangla.php"><span><span>SEND SMS (BANGLA)</span></span></a></li>';
						echo '<li><a href="outbox.php"><span><span>SMS REPORT</span></span></a></li>';
						
						break;
                   
                   		 case 2:	
                   		 		
						
                        echo '<li><a href="send_all_sms.php"><span><span>SEND SMS</span></span></a></li>';
						
                        echo '<li><a href="a_c_panel.php"><span><span>VIEW CREDIT</span></span></a></li>';
						echo '<li><a href="a_c_panel_add.php"><span><span>ADD/EDIT USER</span></span></a></li>';
						echo '<li><a href="a_c_panel_delete.php"><span><span>DELETE USER</span></span></a></li>';
						echo '<li><a href="my_users.php"><span><span>USER STATUS</span></span></a></li>';
						echo '<li><a href="outbox.php"><span><span>SMS REPORT</span></span></a></li>';
						echo '<li><a href="gen_url.php"><span><span>Generate URL</span></span></a></li>';
                       		 break;
                        
        			
                    }
                    ?>
                
                
					</ul>
				</div>