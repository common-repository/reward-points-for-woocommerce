<?php

defined( 'ABSPATH' ) || exit;

$subject  = unserialize (REF_SUBJECT);
$message  = unserialize (REF_MESSAGE);
$ref_code = unserialize (REF_CODE);

$message = (!empty($message)) ? $message : 'You can send or give this refferal code to another customer for geting reward point';
?>


<div style="background-color:#f5f5f5;width:100%;margin:0;padding:70px 0 70px 0">
	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
		<tbody>
			<tr>
				<td valign="top" align="center">
                	<table width="600" cellspacing="0" cellpadding="0" border="0" style="border-radius:6px!important;background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:6px!important">
						<tbody>
							<tr>
								<td valign="top" align="center">
                            		<table width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#557da1" style="background-color:#557da1;color:#ffffff;border-top-left-radius:6px!important;border-top-right-radius:6px!important;border-bottom:0;font-family:Arial;font-weight:bold;line-height:100%;vertical-align:middle">
										<tbody>
											<tr>
												<td>
													<h1 style="color:#ffffff;margin:0;padding:28px 24px;display:block;font-family:Arial;font-size:30px;font-weight:bold;text-align:left;line-height:150%"><?= _e($subject) ?></h1>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
                        	</tr>
	
							<tr>
								<td valign="top" align="center">
									<table width="600" cellspacing="0" cellpadding="10" border="0" style="border-top:0">
										<tbody>
											<tr>
												<td valign="top">
													<table width="100%" cellspacing="0" cellpadding="10" border="0">
														<tbody>
															<tr>
																<td valign="middle" style="border:0;color:#99b1c7;font-family:Arial;font-size:15px;line-height:125%;" colspan="2">
																	<h3>Congraluation User</h3>
																</td>
															</tr>
															<tr>
																<td valign="middle" style="border:0;color:#99b1c7;font-family:Arial;font-size:15px;line-height:125%;" colspan="2">
																	<h3>Your Refferal Code is <span style="color: #4caf50;text-decoration: underline;"><?= _e($ref_code)?></span></h3>
																</td>
															</tr>
															<tr>
																<td valign="middle" style="border:0;color:#99b1c7;font-family:Arial;font-size:15px;line-height:125%;text-align: center;" colspan="2">
																	<p style="font-size:15px;color:black;"><?= _e($message)?></p>
																</td>
															</tr>
															<tr>
																<td valign="middle" style="border:0;color:#99b1c7;font-family:Arial;font-size:15px;line-height:125%;text-align: center;" colspan="2">
																	<p style="font-size: 15px;color: black;border-bottom: 1px solid #dec3c3;">!.. Thanks for creating an account ..!</p>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
                             </tr>
					 	</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>