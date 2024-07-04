<?php
session_start();
include('function.php');
include('db.php');
//echo $user_name;
//die();

if (isset($_SESSION['_u_li_'])){

	$user_name=$_SESSION['_u_li_'];
	$user_type_code=chk_user_type($user_name);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mkt sms panel</title>

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

</SCRIPT>

<body>

<table width="80%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="100">
      <?php
    

	
	switch ($user_type_code) {
    case 1:
	
        echo '<a href="send_single_sms.php" style="color:black;">SEND SINGLE SMS</a>&nbsp;&nbsp;';
		echo '<a href="grp_sms.php" style="color:black;">SEND GROUP SMS</a>&nbsp;&nbsp;';
		echo '<a href="scdl_sms.php" style="color:black;">SCHEDULING SMS</a>&nbsp;&nbsp;';
		echo '<a href="grp_management.php" style="color:black;">GROUP MANAGEMENT</a>&nbsp;&nbsp;';   
        break;
    case 2:
	
        echo '<a href="send_single_sms.php" style="color:black;">SEND SINGLE SMS</a>&nbsp;&nbsp;';
		echo '<a href="grp_sms.php" style="color:black;">SEND GROUP SMS</a>&nbsp;&nbsp;';
		echo '<a href="scdl_sms.php" style="color:black;">SCHEDULING SMS</a>&nbsp;&nbsp;';
		echo '<a href="grp_management.php" style="color:black;">GROUP MANAGEMENT</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel.php" style="color:black;">INSERT CREDIT</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel_add.php" style="color:black;">ADD/EDIT USER</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel_delete.php" style="color:black;">DELETE USER</a>&nbsp;&nbsp;'; 
        break;
    case 3:
	
 		echo '<a href="a_c_panel.php" style="color:black;">INSERT CREDIT</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel_add.php" style="color:black;">ADD/EDIT USER</a>&nbsp;&nbsp;';
		echo '<a href="a_c_panel_delete.php" style="color:black;">DELETE USER</a>&nbsp;&nbsp;'; 
        break;
	}
    ?>
    <span style="float:right; width:100px;"><a href="logout.php">Log Out</a></span>
    </td>
  </tr>
  <tr>
    <td>
    <br /><br />
	<center> 
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="grp_management">
    	<input type="submit" name="list_grp" value="List Groups" />&nbsp;
        <input type="submit" name="edt_grp" value="Edit Groups" />&nbsp;
        <input type="submit" name="add_new_grp" value="Add New Groups" />&nbsp;
        <input type="submit" name="dlt_grp" value="Delete Groups" />&nbsp;        
    </form>
    </center>
    <br />
    </td>
  </tr>
  <tr>
    <td>
    	<br />
   		
         <!-- listing grp -->     <?php
	
				if($_REQUEST['list_grp']){ ?>
				<div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                <table width="100%" border="1" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <th>GROUP NAME</th>
                        
                      </tr>
                
				<?php	
				
					$retrive_data=list_grp();
					while($retrive_result=mysql_fetch_array($retrive_data)){ ?>
                      <tr align="center">
                        <td>&nbsp;<?php echo $retrive_result['grp_id']; ?></td>
                       
                      </tr>
              
			  <?php    } ?>
              
               </table>
                </div>
              
            <?php
            }
        
        
        ?><!-- end listing grp -->
        
        
        <!-- edit groups -->
       <?php  if($_REQUEST['edt_grp']){ ?>
       
       <center>
       	<form name="edt_grp_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
       		<input type="submit" name="show_edt_grp_form" value="Show Group Members" />
            <input type="submit" name="insert_edt_grp_form" value="Insert New to Group" />
            <input type="submit" name="delete_edt_grp_form" value="Delete Entry from Group" />
       	</form>
       </center>
        
          <?php
            }
        
        
        ?>
        <!-- end edit groups -->
        <?php
	
				if($_REQUEST['add_new_grp']){ ?>
				<div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                    
                  <form name="add_new_grp" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">  
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                       
                       	<tr align="center">
                       		<td>Type the Group Name : &nbsp;<input type="text" name="new_grp_name" /></td>
                  		</tr>
                    </table>
                    <center><br/><input type="submit" name="add_new_grp" value="Add Group" /></center>
                  </form>
                </div>
              
            <?php
            }
        
        
        ?>
        
        <?php
	
				if($_REQUEST['add_new_grp']){ ?>
				<div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                    
                 <?php 
				 
				 $new_grp_name=$_POST['new_grp_name'];
				  if(isset($new_grp_name)){
					 if(add_grp($new_grp_name)){
					 
					 echo 'New Group '.$new_grp_name.' Added to Group List';
					 
					 }
					 else { echo 'Group '.$new_grp_name.' exists';}
				  }
				  else  { echo 'Please Type New Group Name!!';}
				 ?>
                </div>
              
            <?php
            }
        
        
        ?>
        <?php
	
				if($_REQUEST['dlt_grp']){ ?>
				<div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                    <form name="dlt_grp_submit" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                            
                                 <select name="show_edt_grp_form_group_name">
                                                    <?php	
                                        
                                            $retrive_data=list_grp();
                                            while($retrive_result=mysql_fetch_array($retrive_data)){ ?>
                                                    <option value="<?php echo $retrive_result['grp_id']; ?>"><?php echo $retrive_result['grp_id']; ?></option>
                                                     <?php    } ?>
                                  </select>
                            
                            </td>
                            <td>&nbsp;<input type="submit" name="grp_delete_submit" value="Delete Group" /></td>
                          </tr>
                        </table>
					</form>
                </div>
              
            <?php
            }
        
        
        ?>
  		
        <?php
	
				if($_REQUEST['grp_delete_submit']){ ?>
				<div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                   <?php 
				   
				  	$delete_grp_name=$_POST['show_edt_grp_form_group_name'];
				   if(isset($delete_grp_name)){
					   
					   if(delete_group($delete_grp_name)){
						   
						   echo 'Group '.$delete_grp_name.'has been deleted.';
						   
						   }
						   else { echo 'sql not executed';}
					   					   
					   }
					  else { echo 'Please Type New Group Name!!'; }
                	
					?>
				</div>
              
            <?php
            }
        
        
        ?>
		<br />
    </td>
  </tr>
  		<tr>
        	<td align="center">
            	<?php  if($_REQUEST['show_edt_grp_form']){ ?>
                <br/>
             		<div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
            			<form name="show_edt_grp_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"/>
            		
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                  
                                  	<td><b>Select Group Name :</b></td>
                                    <td>
                                    
                                    <select name="show_edt_grp_form_group_name">
                                            <?php	
                                
                                    $retrive_data=list_grp();
                                    while($retrive_result=mysql_fetch_array($retrive_data)){ ?>
                                            <option value="<?php echo $retrive_result['grp_id']; ?>"><?php echo $retrive_result['grp_id']; ?></option>
                                             <?php    } ?>
                                    </select>
                                    </td>
                                  </tr>
                                  <tr>
                                  	<td>&nbsp;</td>
                                    <td>
                                    <br/>
                                     <input type="submit" name="show_members_from_grp" value="Show Members"/>
                                    </td>
                                  </tr>
                            </table>

            			</form>
                       </div>
					 <?php
                    }
                
                
                ?>
                
                <?php  if($_REQUEST['show_members_from_grp']){ ?>
                		
                       <div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                            <table width="100%" border="1" cellspacing="0" cellpadding="0" align="center">
                                <tr>
                                    <th>GROUP MEMBERS MOBILE NUMBER</th>
                                    
                                  </tr>
                            
                            <?php	
                                $retrive_data_for_member_list=show_grp_members($_POST['show_edt_grp_form_group_name']);
                                while($retrive_result_for_member_list=mysql_fetch_array($retrive_data_for_member_list)){ ?>
                                  <tr align="center">
                                    <td>&nbsp;<?php echo $retrive_result_for_member_list['mob_num']; ?></td>
                                   
                                  </tr>
                          
                          <?php    } ?>
                          
                           </table>
                		</div>
                    
                
                <?php
                    }
                
                
                ?>
                 <?php  if($_REQUEST['insert_edt_grp_form']){ ?>
                		
                       <div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                             <form name="insert_method_edt_grp_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                             	<input type="submit" name="insert_method_mobile_num" value="Insert by Mobile Number" />
								<input type="submit" name="insert_method_from_file" value="Insert From File" />                             
                             </form>
                		</div>
                    
                
                <?php
                    }
                
                
                ?>
                <?php  if($_REQUEST['insert_method_mobile_num']){ ?>
                		
                       <div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                             <form name="insert_method_mobile_number_edt_grp_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                             	<select name="show_edt_grp_form_group_name">
                                    <?php	
                        
                            $retrive_data=list_grp();
                            while($retrive_result=mysql_fetch_array($retrive_data)){ ?>
                                    <option value="<?php echo $retrive_result['grp_id']; ?>"><?php echo $retrive_result['grp_id']; ?></option>
                                     <?php    } ?>
                                </select>
                             	<input type="text" name="insert_method_edt_grp_form_mobile_num"  />
                                <input type="submit" name="insert_mobile_num_to_grp" value="Insert"  />                     
                             </form>
                		</div>
                    
                
                <?php
                    }
                
                
                ?>
                
                                <?php  if($_REQUEST['insert_mobile_num_frm_file_to_grp']){ ?>
                		
                       <div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                             <?php
							 		$return_contact_upload_status=contact_upload();
									echo $return_contact_upload_status;
							 ?>
                		</div>
                    
                
                <?php
                    }
                
                
                ?>
                
                
                 <?php  if($_REQUEST['insert_mobile_num_to_grp']){ ?>
                		
                       <div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                            <?php  
							
							$grp_name=$_POST['show_edt_grp_form_group_name'];
							$mobile_num=$_POST['insert_method_edt_grp_form_mobile_num'];
							if(insert_in_grp_by_num_grp($grp_name,$mobile_num)){
								
										echo 'Mobile Number '.$mobile_num.' Added to Group '.' '.$grp_name;
								
								}
								
								?>
                		</div>
                    
                
                <?php
                    }
                
                
                ?>
                <?php  if($_REQUEST['insert_method_from_file']){ ?>
                		
                       <div style=" width:30%; overflow:auto; height:300px; margin:auto;" >
                             <form name="insert_method_from_file_edt_grp_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                             	<select name="show_edt_grp_form_group_name">
                                    <?php	
                        
                            $retrive_data=list_grp();
                            while($retrive_result=mysql_fetch_array($retrive_data)){ ?>
                                    <option value="<?php echo $retrive_result['grp_id']; ?>"><?php echo $retrive_result['grp_id']; ?></option>
                                     <?php    } ?>
                                </select>
                             	<input  type="file" name="mobile_num_file"/>
                                <input type="submit" name="insert_mobile_num_frm_file_to_grp" value="Insert"  />                     
                             </form>
                		</div>
                    
                
                <?php
                    }
                
                
                ?>
                
                
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
        							
                                     
                                    
                                  <span style="width:60%; height:250px; margin:auto; overflow:auto; float:left; border:1px green solid;">
                                  <input type="button" name="CheckAll" value="Check All" onClick="checkAll(document.retrive_contacts_from_grp_id.delete_mob_num);">
                                  <input type="button" name="UnCheckAll" value="Uncheck All" onClick="uncheckAll(document.retrive_contacts_from_grp_id.delete_mob_num);"><br/><br/>
                                  <input type="hidden" value="<?php echo $_POST['show_edt_grp_form_group_name']; ?>" name="send_grp_id"/>
                                  	  <?php	
                                $retrive_data_for_member_list=show_grp_members($_POST['show_edt_grp_form_group_name']);
                                while($retrive_result_for_member_list=mysql_fetch_array($retrive_data_for_member_list)){ ?>
                                 
                                    <input type="checkbox" id="delete_mob_num" name="send_mobile_num_for_delete[]" value="<?php echo $retrive_result_for_member_list['mob_num']; ?>" /> &nbsp;<?php echo $retrive_result_for_member_list['mob_num']; ?><br />
                                   
                                  
                          
                          		<?php    } ?>
                                
                                       
                                  
                                  </span>
                                  <span style="width:38%; height:250px; margin:auto; overflow:auto; float:right;">
                                  	<input type="submit" name="delete_contacts_from_group_exec" value="Delete Contact" />
                                  </span>
                             		
                                </form>
                      		</div>
                             
                      
                  <?php
                    }        
					
					 if($_REQUEST['delete_contacts_from_group_exec']){        
					
					for ($i=0; $i<count($_POST['send_mobile_num_for_delete']);$i++) {
					
						$grp_id=$_POST['send_grp_id'];
						$mobile_num=$_POST['send_mobile_num_for_delete'][$i];
						
						if(delete_contact_frp_grp($mobile_num,$grp_id)!=1){
							echo "mobile Number: ".$mobile_num."Not Deleted <br />";
							}
					
						}
					echo "Deletion Complete";
			
                    }        
					
				?>
                
            </td>
        </tr>
</table>
</body>
</html>

<?php
	
	}
	else { 
		
		$_SESSION['_log_in_error_']=1;
		header("Location: index.php");
	
	}

?>
}

?>
