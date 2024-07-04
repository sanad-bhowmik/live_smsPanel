<?php
include('../function.php');
include('../db.php');
//http://123.49.3.58:8081/web_send_sms.php?ms=xxxxxx&txt=dddddd&username=&password=
?>

<SCRIPT LANGUAGE="JavaScript">

function checkAll(field)
{
	
	//alert('yes:line12');
for (i = 0; i < field.length; i++)
	field[i].checked = true ;
}

function uncheckAll(field)
{
for (i = 0; i < field.length; i++)
	field[i].checked = false ;
}

</script>





         <form name="edt_grp_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
       	            <input type="submit" name="delete_edt_grp_form" value="Delete Entry from Group" />
       	</form>                     
                             
                             
 <?php  if($_REQUEST['delete_edt_grp_form']){ ?>
                		
                      <div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                      		<form name="retrive_grp_list_for_get_contacts" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	
                         		<select name="show_edt_grp_form_group_name">
                                    <?php	
                        
                            $retrive_data=list_grp();
                            while($retrive_result=mysql_fetch_array($retrive_data)){ ?>
                                    <option value="<?php echo $retrive_result['grp_id']; ?>"><?php echo $retrive_result['grp_id']; ?></option>
                                     <?php    } ?>
                                </select>
                                <input type="submit" name="submit_for_gets_contact_list" value="Get Contacts" />
 							</form>
                      </div>
                    
                
                <?php
                    }
                
                if($_REQUEST['submit_for_gets_contact_list']){ 
                ?>                    
                          
                            <div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                                <form name="retrive_contacts_from_grp_id" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        							
                                  <span style="width:70%; height:250px; margin:auto; overflow:auto; float:left; border:1px green solid;">
                                  <input type="hidden" value="<?php echo $_POST['show_edt_grp_form_group_name']; ?>" name="send_grp_id"/>
                                  	  <?php	
                                $retrive_data_for_member_list=show_grp_members($_POST['show_edt_grp_form_group_name']);
                                while($retrive_result_for_member_list=mysql_fetch_array($retrive_data_for_member_list)){ ?>
                                 
                                    <input type="checkbox" id="delete_mob_num" name="send_mobile_num_for_delete[]" value="<?php echo $retrive_result_for_member_list['mob_num']; ?>" /> &nbsp;<?php echo $retrive_result_for_member_list['mob_num']; ?><br />
                                   
                                  
                          
                          		<?php    } ?>
                                
                                        <input type="button" name="CheckAll" value="Check All" onClick="checkAll(document.retrive_contacts_from_grp_id.delete_mob_num);">
                                        <input type="button" name="UnCheckAll" value="Uncheck All" onClick="uncheckAll(document.retrive_contacts_from_grp_id.delete_mob_num);">
                                  
                                  </span>
                                  <span style="width:28%; height:250px; margin:auto; overflow:auto; float:right;">
                                  	<input type="submit" name="delete_contacts_from_group_exec" value="Delete Contact" />
                                  </span>
                             		
                                </form>
                      		</div>
                             
                      
                  <?php
                    }        
					
					 if($_REQUEST['delete_contacts_from_group_exec']){        
	
					
				
				
					print_r($_POST['send_mobile_num_for_delete']);
					
					for ($i=0; $i<count($_POST['send_mobile_num_for_delete']);$i++) {
					
						$grp_id=$_POST['send_grp_id'];
						$mobile_num=$_POST['send_mobile_num_for_delete'][$i];
						
						delete_contact_frp_grp($mobile_num,$grp_id);
					
						}
					echo "106";
			
                    }        
					
				?>
				
                <?php while($grp_value_grp_sms=list_grp()){
                           echo $grp_value_grp_sms['grp_id'];
						   
						   ?>
						 <!--  <input type="checkbox" name="grp_list_for_grp_sms[]" id="grp_list_for_grp_sms" value="<?php echo $grp_value_grp_sms['grp_id']; ?>"/> &nbsp;<?php echo $grp_value_grp_sms['grp_id']; ?><br/>
                           
                         <?php    } ?>  
                         
           