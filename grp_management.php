<?php

session_start();

include('function.php');

include('db.php');

//echo $user_name;

//die();



if (isset($_SESSION['_u_li_'])){



	$login_user_name=$_SESSION['_u_li_'];

	$user_type_code=chk_user_type($login_user_name);





?>



<?php include ('header.php'); ?>



			<div id="menus_wrapper">

				

				<?php include ('menu.php'); ?>

                

                

                

				<div id="sec_menu">

					<ul>

                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="grp_management">
                     
                     	
						<li><a href="#" class="sm1"><input type="submit" name="list_grp" value="List Groups" /></a></li>

						<li><a href="#" class="sm2"><input type="submit" name="edt_grp" value="Edit Groups" /></a></li>

						<li><a href="#" class="sm3"><input type="submit" name="add_new_grp" value="Add New Groups" /></a></li>

						<li><a href="#" class="sm4"><input type="submit" name="dlt_grp" value="Delete Groups" /></a></li>
                        

					</form>

                    </ul>

				</div>

				

				

				

			</div>

			<!--[if !IE]>end menus_wrapper<![endif]-->

			

			

			

		</div>

		<!--[if !IE]>end head<![endif]-->

		

		<!--[if !IE]>start content<![endif]-->

		<div id="content">

			

			

			

			

			

			<!--[if !IE]>start page<![endif]-->

			<div id="page">

			

            <div class="inner">

					

					

					

					<!--[if !IE]>start section<![endif]-->	

					<div class="section">

						<!--[if !IE]>start title wrapper<![endif]-->

						<div class="title_wrapper">

							<h2>Group Management</h2>

							<span class="title_wrapper_left"></span>

							<span class="title_wrapper_right"></span>

						</div>

						<!--[if !IE]>end title wrapper<![endif]-->

						<!--[if !IE]>start section content<![endif]-->

						<div class="section_content">

							<!--[if !IE]>start section content top<![endif]-->

							<div class="sct">

								<div class="sct_left">

									<div class="sct_right">

										<div class="sct_left">

											<div class="sct_right">

												<!--[if !IE]>start dashboard menu<![endif]-->

												<div class="dashboard_menu_wrapper">

                                                <br /><br />









<!-- listing grp -->     <?php

	

				if($_REQUEST['list_grp']){ ?>

				

                <div class="table_wrapper">

				<div class="table_wrapper_inner" style="overflow:auto">

				<table cellpadding="0" cellspacing="0" width="50%" style="margin-left:23%">

				<tbody><tr>

					<th>&nbsp;</th>										

				<th><a href="#">Group Name</a></th>

				</tr>

                                                        

                    <?php	

					$k=1;

					$retrive_data=list_grp($login_user_name);

					while($retrive_result=mysql_fetch_array($retrive_data)){ ?>

                    

				<tr class="first">
				<td><?php echo $k; ?></td>

				<td>&nbsp;<?php $grp_id_temp=explode('_',$retrive_result['grp_id']); echo $grp_id_temp[1]; ?></td>

				</tr>

                <?php   $k++; } ?>

                </tbody></table>

                </div>

                </div>



            <?php

            }

        

        

       		?><!-- end listing grp -->

        

        

        <!-- edit groups -->

        

       <?php  if($_REQUEST['edt_grp']){ ?>

       

       <form name="edt_grp_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

       <ul class="dashboard_menu">

  	  
       <li style="list-style:none;"><input class="dash_bt" style="background:url(images/show_groups.png) no-repeat center; height:102px;" type="submit" name="list_grp" value=" " /></li>

       <li style="list-style:none;"><input class="dash_bt" style="background:url(images/show_grp.png) no-repeat center; height:102px;" type="submit" name="show_edt_grp_form" value=" " /></li>

       <li style="list-style:none;"><input class="dash_bt" style="background:url(images/show_grp_members.png) no-repeat center; height:102px;" type="submit" name="insert_edt_grp_form" value=" " /></li>

       <li style="list-style:none;"><input class="dash_bt" style="background:url(images/delete_frm_grp.png) no-repeat center; height:102px;" type="submit" name="delete_edt_grp_form" value=" " /></li>

       

       </ul>

       </form>

       



        

          <?php

            }

        

        

        ?>

        <!-- end edit groups -->

        

        <?php

	

				if($_REQUEST['add_new_grp']){ ?>

                

                <form name="add_new_grp" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="search_form general_form">

                <fieldset>



                <div class="row">

					<label>Type the Group Name : &nbsp;</label>

					<div class="inputs">

					<span class="input_wrapper"><input class="text" type="text" name="new_grp_name" /></span>

					</div>

					</div>

                    

                    <div class="row">

					<div class="buttons" style="margin-left:48px;">

					<ul style="list-style:none;">

					<li><span class="button orange_btn"><span><span>Add Group</span></span><input name="add_new_grp" type="submit" /></span></li>

					</ul>

					</div>

					</div>



              	  </fieldset>

                  </form>



              

            <?php

            }

        

        

        ?>

        

        <?php

	

				if($_REQUEST['add_new_grp']){ ?>

				<div style=" width:100%; overflow:auto; height:200px; margin:auto;" >

                <br /><br />    

                 <?php 

				 

				 $new_grp_name=trim($_POST['new_grp_name']);

				  if($new_grp_name!=NULL){

					  $new_grp_name1=$login_user_name.'_'.$new_grp_name;

					 if(add_grp($new_grp_name1,$login_user_name)){

					 

					 echo 'New Group '.$new_grp_name1.' Added to Group List';

					 

					 }

					 else { echo 'Group '.$new_grp_name1.' exists';}

				  }

				  else  { echo 'Please Type New Group Name!!';}

				 ?>

                </div>

              

            <?php

            }

        

        

        ?>

        <?php

	

				if($_REQUEST['dlt_grp']){ ?>

                

                <form name="dlt_grp_submit" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

                

                <div style="float:left; width:200px;">               

                <select name="show_edt_grp_form_group_name" style="width:180px;">

                 <option value="" selected="selected">Select From Below</option>

                <?php	

                                        

                $retrive_data=list_grp($login_user_name);

                while($retrive_result=mysql_fetch_array($retrive_data)){ ?>

                <option value="<?php echo $retrive_result['grp_id']; ?>"><?php $grp_id_temp=explode('_',$retrive_result['grp_id']); echo $grp_id_temp[1]; ?></option>

                <?php    } ?>

                </select>

                </div>

               

                            

               <ul class="dashboard_menu">

  	  	       <li style="list-style:none;"><input class="dash_bt" style="background:url(images/delete_grp.png) no-repeat center; height:102px;" type="submit" name="grp_delete_submit" value=" " /></li>               </ul>

               

               </form>



              

            <?php

            }

        

        

        ?>

  		

        <?php

	

				if($_REQUEST['grp_delete_submit']){ ?>

                

                <div style=" width:25%; overflow:auto; height:200px; margin:auto; color:#F00; font-weight:bold;" >

                <br /><br /><br /><br />

                   <?php 

				   

				  	$delete_grp_name=$_POST['show_edt_grp_form_group_name'];

				   if(isset($delete_grp_name)){

					   

					   if(delete_group($delete_grp_name)){

						   

						   echo 'Group '.$delete_grp_name.'&nbsp;has been deleted.';

						   

						   }

						   else { echo '&nbsp; sql not executed';}

					   					   

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

                

                <form name="show_edt_grp_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                

                <div style="float:left; width:200px;">

                <label> Select Group Name : </label>               

                <select name="show_edt_grp_form_group_name" style="width:180px;">

                 <option value="" selected="selected">Select From Below</option>

                <?php	

                                        

                $retrive_data=list_grp($login_user_name);

                while($retrive_result=mysql_fetch_array($retrive_data)){ ?>

                <option value="<?php echo $retrive_result['grp_id']; ?>"><?php $grp_id_temp=explode('_',$retrive_result['grp_id']); echo $grp_id_temp[1]; ?></option>

                <?php    } ?>

                </select>

                </div>

               

                            

               <ul class="dashboard_menu">

  	  	       <li style="list-style:none;"><input class="dash_bt" type="submit" style="background:url(images/show.png) no-repeat center; height:102px;" name="show_members_from_grp" value=" " /></li>               </ul>

               

               </form>

                

                

             		

            			

                       

					 <?php

                    }

                

                

                ?>

                

                <?php  if($_REQUEST['show_members_from_grp']){ ?>

                		

                <div class="table_wrapper">

				<div class="table_wrapper_inner" style="overflow:auto">

				<table cellpadding="0" cellspacing="0" width="50%" style="margin-left:23%">

				<tbody><tr>

															

				<th style="text-align:center"><a href="#">GROUP MEMBERS MOBILE NUMBER</a></th>

				</tr>

                                                        

                    <?php	

                          $retrive_data_for_member_list=show_grp_members($_POST['show_edt_grp_form_group_name']);

                          while($retrive_result_for_member_list=mysql_fetch_array($retrive_data_for_member_list)){ ?>

                    

				<tr class="first">

				<td style="text-align:center; font-size:14px;">&nbsp;<?php echo $retrive_result_for_member_list['mob_num']; ?></td>

				</tr>

                <?php    } ?>

                </tbody></table>

                </div>

                </div> 

                        



                

                <?php

                    }

                

                

                ?>

                 <?php  if($_REQUEST['insert_edt_grp_form']){ ?>

		

        <form name="insert_method_edt_grp_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

          

        <ul class="dashboard_menu">

  	  	<li style="list-style:none;"><input class="dash_bt" style="background:url(images/by_mobile.png) no-repeat center; height:102px;" type="submit" name="insert_method_mobile_num" value=" " /></li>

        <li style="list-style:none;"><input class="dash_bt" style="background:url(images/from_csv.png) no-repeat center; height:102px;" type="submit" name="insert_method_from_file" value=" " /></li>

        </ul>

                             

               </form>

                             

                             

               

                    

                

                <?php

                    }

                

                

                ?>

                <?php  if($_REQUEST['insert_method_mobile_num']){ ?>

                

                

                <form name="insert_method_mobile_number_edt_grp_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="search_form general_form">

                <fieldset>

				<div class="row">

					<label>Select Group :</label>

						<div class="inputs">

						<span class="input_wrapper blank">

                         

						<select name="show_edt_grp_form_group_name">

                        	<option value="" selected="selected">Select From Below</option>

                        <?php	

                        

                            $retrive_data=list_grp($login_user_name);

                            while($retrive_result=mysql_fetch_array($retrive_data)){ ?>

                                    <option value="<?php echo $retrive_result['grp_id']; ?>"><?php $grp_id_temp=explode('_',$retrive_result['grp_id']); echo $grp_id_temp[1]; ?></option>

                                     <?php    } ?>

                        </select>

						</span>

						</div>

						</div>



                <div class="row">

					<label>Enter Mobile Number :</label>

					<div class="inputs">

					<span class="input_wrapper"><input class="text" type="text" name="insert_method_edt_grp_form_mobile_num" /></span>

					</div>

					</div>

                    

                    <div class="row">

					<div class="buttons" style="margin-left:110px;">

					<ul style="list-style:none;">

					<li><span class="button orange_btn"><span><span>Import</span></span><input name="insert_mobile_num_to_grp" type="submit" /></span></li>

					</ul>

					</div>

					</div>



              	  </fieldset>

                  </form>		



                    

                

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

                		

                       <div style=" width:30%; overflow:auto; height:200px; margin:auto; color:#F00; font-weight:bold;" >

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

                		

                <form name="insert_method_from_file_edt_grp_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="search_form general_form" enctype="multipart/form-data">

                <fieldset>

				<div class="row">

					<label>Select Group :</label>

						<div class="inputs">

						<span class="input_wrapper blank">

						<select name="show_edt_grp_form_group_name">

                        	 <option value="" selected="selected">Select From Below</option>

                        <?php	

                        

                            $retrive_data=list_grp($login_user_name);

                            while($retrive_result=mysql_fetch_array($retrive_data)){ ?>

                            <option value="<?php echo $retrive_result['grp_id']; ?>"><?php $grp_id_temp=explode('_',$retrive_result['grp_id']); echo $grp_id_temp[1]; ?></option>

                            <?php    } ?>

                        </select>

						</span>

						</div>

						</div>



                <div class="row">

					<label>Upload CSV :</label>

					<div class="inputs">

					<span class="input_wrapper blank"><input name="mobile_num_file" type="file"/></span>

					</div>

					</div>

                    

                    <div class="row">

					<div class="buttons" style="margin-left:48px;">

					<ul style="list-style:none;">

					<li><span class="button orange_btn"><span><span>Insert CSV</span></span><input name="insert_mobile_num_frm_file_to_grp" type="submit" /></span></li>

					</ul>
					<a href="upload/contact.csv" >DEMO CONTACT FILE</a> &nbsp;(right click -->then choose save to download this file)

					</div>

					</div>

                    

                   </fieldset>

                   </form>

                        



                    

                

                <?php

                    }

                

                

                ?>

                

                

                 <?php  if($_REQUEST['delete_edt_grp_form']){ ?>

                 

                 <form name="retrive_grp_list_for_get_contacts" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="search_form general_form">

                <fieldset>

				<div class="row">

					<label>Select Group :</label>

						<div class="inputs">

						<span class="input_wrapper blank">

						<select name="show_edt_grp_form_group_name">

                        	 <option value="" selected="selected">Select From Below</option>

                        <?php	

                        

                        $retrive_data=list_grp($login_user_name);

                        while($retrive_result=mysql_fetch_array($retrive_data)){ ?>

                        <option value="<?php echo $retrive_result['grp_id']; ?>"><?php $grp_id_temp=explode('_',$retrive_result['grp_id']); echo $grp_id_temp[1]; ?></option>

                        <?php    } ?>

                        </select>

						</span>

						</div>

						</div>

                                   

                    <div class="row">

					<div class="buttons" style="margin-left:48px;">

					<ul style="list-style:none;">

					<li><span class="button orange_btn"><span><span>Get Contacts</span></span><input name="submit_for_gets_contact_list" type="submit" /></span></li>

					</ul>

					</div>

					</div>

                    

                   </fieldset>

                   </form>

    

                

                <?php

                    }

                

                if($_REQUEST['submit_for_gets_contact_list']){ 

                ?>                    



												

				<form name="retrive_contacts_from_grp_id" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

				<fieldset style="border:none">

												<!--[if !IE]>start table_wrapper<![endif]-->

				<input type="button" name="CheckAll" value="Check All" onClick="checkAll(document.retrive_contacts_from_grp_id.delete_mob_num);">

                <input type="button" name="UnCheckAll" value="Uncheck All" onClick="uncheckAll(document.retrive_contacts_from_grp_id.delete_mob_num);">

                <input type="submit" name="delete_contacts_from_group_exec" value="Delete Contact" />

                <br/><br/>

							

                <div class="table_wrapper">

				<div class="table_wrapper_inner">

				<table cellpadding="0" cellspacing="0" width="100%">

				<tbody><tr>

				<th>Mobile Number</th>

				</tr>

				<tr class="first">

				<td>

                <input type="hidden" value="<?php echo $_POST['show_edt_grp_form_group_name']; ?>" name="send_grp_id"/>

                                  	  <?php	

                                $retrive_data_for_member_list=show_grp_members($_POST['show_edt_grp_form_group_name']);

                                while($retrive_result_for_member_list=mysql_fetch_array($retrive_data_for_member_list)){ ?>

             

				</tr>

                <tr class="second">

				<td><input type="checkbox" id="delete_mob_num" name="send_mobile_num_for_delete[]" value="<?php echo $retrive_result_for_member_list['mob_num']; ?>" /> &nbsp;<?php echo $retrive_result_for_member_list['mob_num']; ?><br /></td><?php    } ?>

                </tbody></table></div></div></fieldset></form>   

                                                        



                             

                      

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





												</div>

												<!--[if !IE]>end dashboard menu<![endif]-->

												

												

												

											</div>

										</div>

									</div>

								</div>

							</div>

							<!--[if !IE]>end section content top<![endif]-->

							<!--[if !IE]>start section content bottom<![endif]-->

							<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>

							<!--[if !IE]>end section content bottom<![endif]-->

							

						</div>

						<!--[if !IE]>end section content<![endif]-->

					</div>

					<!--[if !IE]>end section<![endif]-->

					

					

					<!--[if !IE]>start section<![endif]-->	

					

					<!--[if !IE]>end section<![endif]-->

					

					

					

					<!--[if !IE]>start section<![endif]-->	

					

					<!--[if !IE]>end section<![endif]-->

					

					

					

					

					<!--[if !IE]>start section<![endif]-->	

					

					<!--[if !IE]>end section<![endif]-->

					

					

					

					

						

				</div>

            

            

            

            

             

             

             

             

			</div>

			<!--[if !IE]>end page<![endif]-->

			<!--[if !IE]>start sidebar<![endif]-->

<?php include ('side_footer.php'); ?>

	

	<?php

	}

	else { 

		

		$_SESSION['_log_in_error_']=1;

		header("Location: index.php");

	

	}



?>