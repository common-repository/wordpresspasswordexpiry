//Settings page live preview JS

jQuery(document).ready(function()
			{
			    jQuery("#wpe_cont_email_list").css("display","none");
			    
			    jQuery("#wpe_cust_msg_list").css("display","none");
			    
			    jQuery("#wpe_main_admin_note").css("display","none");
			    
			    jQuery("#exp_cont_opt").click(
							    function()
							    {
								    jQuery("#wpe_cont_email_list").css("display","block");
								    jQuery("#wpe_cust_msg_list").css("display","none");
								    
								    if(jQuery("#wpe_main_admin_option").is(':checked'))
								    {
									jQuery("#wpe_main_admin_note").css("display","block");
									jQuery("#wpe_submit_settings").css("display","none");
									
								    }
								    else
								    {
									jQuery("#wpe_submit_settings").css("display","block");
								    }
							    }
							    );
			    
			    jQuery("#exp_cust_opt").click(
							    function()
							    {
								    jQuery("#wpe_cust_msg_list").css("display","block");
								    jQuery("#wpe_cont_email_list").css("display","none");
								    
								    if(jQuery("#wpe_main_admin_option").is(':checked'))
								    {
									jQuery("#wpe_main_admin_note").css("display","block");
									jQuery("#wpe_submit_settings").css("display","none");
								    }
								    else
								    {
									jQuery("#wpe_submit_settings").css("display","block");
								    }
							    }
							    );
			    
			    jQuery("#exp_auto_opt").click(
							    function()
							    {
								    jQuery("#wpe_cont_email_list").css("display","none");
								    jQuery("#wpe_cust_msg_list").css("display","none");
								    jQuery("#wpe_main_admin_note").css("display","none");
								    jQuery("#wpe_submit_settings").css("display","block");
								    
							    }
							    );
			    
			    jQuery("#wpe_main_admin_option").on('click',
								function()
								{
								    if (jQuery(this).is(':checked'))
								    {
									if(jQuery("#exp_cont_opt").is(':checked'))
									{
									    jQuery("#wpe_main_admin_note").css("display","block");
									    jQuery("#wpe_submit_settings").css("display","none");
									    jQuery("#wpe_cont_email_list").css("display","block");
									    jQuery("#wpe_cust_msg_list").css("display","none");
									}
								
									else if(jQuery("#exp_cust_opt").is(':checked'))
									{
									    jQuery("#wpe_main_admin_note").css("display","block");
									    jQuery("#wpe_submit_settings").css("display","none");
									    jQuery("#wpe_cust_msg_list").css("display","block");
									    jQuery("#wpe_cont_email_list").css("display","none");
									}
								
									else 
									{
									    jQuery("#wpe_main_admin_note").css("display","none");
									    jQuery("#wpe_submit_settings").css("display","block");
									    jQuery("#wpe_cont_email_list").css("display","none");
									    jQuery("#wpe_cust_msg_list").css("display","none");
									}
									
								    }
								    
								    else 
									{
									    jQuery("#wpe_main_admin_note").css("display","none");
									    jQuery("#wpe_submit_settings").css("display","block");
									}
								
								}
							    );
			
								if(jQuery("#exp_cont_opt").is(':checked'))
								{
								    jQuery("#wpe_cont_email_list").css("display","block");
								    
								    if(jQuery("#wpe_main_admin_option").is(':checked'))
								    {
									jQuery("#wpe_main_admin_note").css("display","block");
									jQuery(".wpe_cont_email_check").css("display","none");
									jQuery(".wpe_cust_msg_check").css("display","none");
									jQuery("#wpe_submit_settings").css("display","none");
								    }
								}
								
								else if(jQuery("#exp_cust_opt").is(':checked'))
								{
								    jQuery("#wpe_cust_msg_list").css("display","block");
								    
								    if(jQuery("#wpe_main_admin_option").is(':checked'))
								    {
									jQuery("#wpe_main_admin_note").css("display","block");
									jQuery(".wpe_cont_email_check").css("display","none");
									jQuery(".wpe_cust_msg_check").css("display","none");
									jQuery("#wpe_submit_settings").css("display","none");
								    }
								}
								
								else
								{
								    jQuery("#wpe_cont_email_list").css("display","none");
								    jQuery("#wpe_main_admin_note").css("display","none");
								    jQuery("#wpe_submit_settings").css("display","block");
								}
								
			    jQuery('#wdm_wpe_form').validate();
			}
			);