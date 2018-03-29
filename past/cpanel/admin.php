<?php
session_start();
if($_SESSION["AdminName"] == ""){
header("location:index.php"); 
exit;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>WEB ADMIN SECTION</title>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
-->
</style>
<script language="javascript" type="text/javascript" src="include/required_functions.js"></script>
<link href="include/style.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="changeScrollbarColor(); init(); hideMenus();">
<div ID=tabDiv style="width:10;">
  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="middle"><a href="javascript:hideMenus();"><img title="Click to Show/Hide" name="myPanelmage" src="images/nav.jpg" width=9 height=620 border=0></a></td>
    </tr>
  </table>
</div>
<div ID=poptextDiv>
  <table width="180" height="600"  border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="top"><table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr bgcolor="#FFFFFF">
                          <td width="12%" height="30" rowspan="2" align="left" valign="top" class="titleLeft"><img src="images/topleft.gif" width="14" height="3"></td>
                          <td width="76%" rowspan="2" class="tableHead"  style="cursor:pointer;" onClick="toggleMenu(menu_general,imgMenu_general);"><a href="javascript:void(0);" class="tableHead">General</a></td>
                          <td width="12%" align="right" valign="top"><img src="images/topright.gif" width="3" height="3"></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><img style="cursor:pointer;" id="imgMenu_general" src="images/UP.gif" alt="" width="18" height="19" border="0" onClick="toggleMenu(menu_general,imgMenu_general);"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><div id="menu_general">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr bgcolor="#E0E0E0">
                            <td width="12%" height="22"><div align="right"><a href="#" title="Home"><img src="images/home.gif" alt="Home" border="0" height="16" width="16"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="main.php" target="mainFrame" class="tableInner">&nbsp;Home</a></span></td>
                          </tr>
                        </table>
                      </div></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
		  <tr>
            <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr bgcolor="#FFFFFF">
                          <td width="12%" height="30" rowspan="2" align="left" valign="top" class="titleLeft"><img src="images/topleft.gif" width="14" height="3"></td>
                          <td width="76%" rowspan="2" class="tableHead" style="cursor:pointer;" onClick="toggleMenu(menu_Users,imgMenu_Users);"><a href="javascript:void(0);" class="tableHead">Offer Section </a></td>
                          <td width="12%" align="right" valign="top"><img src="images/topright.gif" width="3" height="3"></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><img style="cursor:pointer;" id="imgMenu_Users" src="images/UP.gif" alt="" width="18" height="19" border="0" onClick="toggleMenu(menu_Users,imgMenu_Users);"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><div id="menu_Users" style="display:inline;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr bgcolor="#E0E0E0">
                            <td width="14%" height="22"><div align="center"><a href="#" title="Home"><img src="images/edit.gif" alt="View Edit Users" border="0"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="offers/index.php" target="mainFrame" class="tableInner">Add Offers </a></span></td>
                          </tr>
						  <tr bgcolor="#E0E0E0">
                            <td width="14%" height="22"><div align="center"><a href="#" title="Home"><img src="images/edit.gif" alt="View Edit Users" border="0"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="offers/list.php" target="mainFrame" class="tableInner">View/Delete Offers </a></span></td>
                          </tr>
                        </table>
                      </div></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
		  <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr bgcolor="#FFFFFF">
                          <td width="12%" height="30" rowspan="2" align="left" valign="top" class="titleLeft"><img src="images/topleft.gif" width="14" height="3"></td>
                          <td width="76%" rowspan="2" class="tableHead" style="cursor:pointer;" onClick="toggleMenu(menu_add,imgMenu_Add);"><a href="javascript:void(0);" class="tableHead">Add Section </a></td>
                          <td width="12%" align="right" valign="top"><img src="images/topright.gif" width="3" height="3"></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><img style="cursor:pointer;" id="imgMenu_Add" src="images/DOWN.gif" alt="" width="18" height="19" border="0" onClick="toggleMenu(menu_add,imgMenu_Add);"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><div id="menu_add" style="display:none;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/add.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td bgcolor="#E0E0E0" style="padding-left:5px; padding-right:5px;"><span class="name"><a href="category/index.php" target="mainFrame" class="tableInner">Add New Make </a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/add.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td bgcolor="#E0E0E0" style="padding-left:5px; padding-right:5px;"><span class="name"><a href="subcategory/index.php" target="mainFrame" class="tableInner">Add New Model </a></span></td>
                          </tr>
						  <!--tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/add.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td bgcolor="#E0E0E0" style="padding-left:5px; padding-right:5px;"><span class="name"><a href="location/index.php" target="mainFrame" class="tableInner">Add New Location </a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/add.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td bgcolor="#E0E0E0" style="padding-left:5px; padding-right:5px;"><span class="name"><a href="banners/index.php" target="mainFrame" class="tableInner">Add New Banner</a></span></td>
                          </tr>
						  <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/add.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td bgcolor="#E0E0E0" style="padding-left:5px; padding-right:5px;"><span class="name"><a href="centerAd/index.php" target="mainFrame" class="tableInner">Add New Center Ad</a></span></td>
                          </tr-->
                        </table>
                      </div></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
             <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                 <tr bgcolor="#FFFFFF">
                 <td width="12%" height="30" rowspan="2" align="left" valign="top" class="titleLeft"><img src="images/topleft.gif" width="14" height="3"></td>
                 <td width="76%" rowspan="2" class="tableHead" style="cursor:pointer;" onClick="toggleMenu(menu_insersion,imgMenu_insersion);"><a href="javascript:void(0);" class="tableHead">Modify Section </a></td>
                 <td width="12%" align="right" valign="top"><img src="images/topright.gif" width="3" height="3"></td>
                 </tr>
                 <tr bgcolor="#FFFFFF">
                    <td><img style="cursor:pointer;" id="imgMenu_insersion" src="images/UP.gif" alt="" width="18" height="19" border="0" onClick="toggleMenu(menu_insersion,imgMenu_insersion);"></td>
                 </tr>
                  </table></td>
           </tr>
		    <tr>
                    <td><div id="menu_insersion" style="display:inline;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"></a><a href="#" title="Home"><img src="images/edit.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td bgcolor="#E0E0E0" style="padding-left:5px; padding-right:5px;"><span class="name"><a href="category/list.php" target="mainFrame" class="tableInner">Edit/Delete Make </a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/edit.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="subcategory/list.php" target="mainFrame" class="tableInner">Edit/Delete Model </a></span></td>
                          </tr>
                          <!--tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/edit.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="location/list.php" target="mainFrame" class="tableInner"> Edit/Delete Location </a><a href="sendnewsletter/index.php" target="mainFrame" class="tableInner"></a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td width="14%" height="22"><div align="right"><a href="#" title="Home"><img src="images/edit.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="banners/list.php" target="mainFrame" class="tableInner">Edit/Delete Banner </a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><a href="#" title="Home"><img src="images/edit.gif" alt="Home" border="0" height="21" width="22"></a></td>
                            <td class="tableInner" style="padding-left:5px; padding-right:5px;"><a href="centerAd/list.php" target="mainFrame" class="tableInner">Edit/Delete Center Ad</a></td>
                          </tr-->
                       </table>
                    </div></td>
                 </tr>
				 <tr><td>&nbsp;</td></tr>
		 
          <tr>
             <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                 <tr bgcolor="#FFFFFF">
                 <td width="12%" height="30" rowspan="2" align="left" valign="top" class="titleLeft"><img src="images/topleft.gif" width="14" height="3"></td>
                 <td width="76%" rowspan="2" class="tableHead" style="cursor:pointer;" onClick="toggleMenu(menu_insersion1,imgMenu_insersion);"><a href="javascript:void(0);" class="tableHead">Testimonial Section </a></td>
                 <td width="12%" align="right" valign="top"><img src="images/topright.gif" width="3" height="3"></td>
                 </tr>
                 <tr bgcolor="#FFFFFF">
                    <td><img style="cursor:pointer;" id="imgMenu_insersion" src="images/UP.gif" alt="" width="18" height="19" border="0" onClick="toggleMenu(menu_insersion1,imgMenu_insersion);"></td>
                 </tr>
                  </table></td>
           </tr>
		    <tr>
                    <td><div id="menu_insersion1" style="display:inline;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/edit.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="testimonial/index.php?action=EDIT&testimonial_id=1" target="mainFrame" class="tableInner">View/Edit Testimonial </a></span></td>
                          </tr>
                       </table>
                    </div></td>
                 </tr>
				 <tr><td>&nbsp;</td></tr>
		  <tr>
            <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr bgcolor="#FFFFFF">
                          <td width="12%" height="30" rowspan="2" align="left" valign="top" class="titleLeft"><img src="images/topleft.gif" width="14" height="3"></td>
                          <td width="76%" rowspan="2" class="tableHead" style="cursor:pointer;" onClick="toggleMenu(menu_insersion1,imgMenu_insersion);"><a href="javascript:void(0);" class="tableHead">Newsletter Section </a></td>
                          <td width="12%" align="right" valign="top"><img src="images/topright.gif" width="3" height="3"></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><img style="cursor:pointer;" id="imgMenu_insersion1" src="images/UP.gif" alt="" width="18" height="19" border="0" onClick="toggleMenu(menu_insersion1,imgMenu_insersion);"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><div id="menu_insersion1" style="display:inline;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/add.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td bgcolor="#E0E0E0" style="padding-left:5px; padding-right:5px;"><span class="name"><a href="newsletters/index.php" target="mainFrame" class="tableInner">Add New Newsletter </a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/edit.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="newsletters/list.php" target="mainFrame" class="tableInner">View/Delete Newsletters </a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/control.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="sendnewsletter/index.php" target="mainFrame" class="tableInner">Send Newsletter </a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td width="14%" height="22" valign="top"><div align="right"><a href="#" title="Home"><img src="images/control.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="managenewsletterusers/list.php" target="mainFrame" class="tableInner">Manage Newsletter Subscriptions </a></span><br><br></td>
                          </tr>
                        </table>
                      </div></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
          
          
          <tr>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                  <tr>
                    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr bgcolor="#FFFFFF">
                          <td width="12%" height="30" rowspan="2" align="left" valign="top" class="titleLeft"><img src="images/topleft.gif" width="14" height="3"></td>
                          <td width="76%" rowspan="2" class="tableHead" style="cursor:pointer;" onClick="toggleMenu(menu_system,imgMenu_system);"><a href="javascript:void(0);" class="tableHead">System</a></td>
                          <td width="12%" align="right" valign="top"><img src="images/topright.gif" width="3" height="3"></td>
                        </tr>
                        <tr bgcolor="#FFFFFF">
                          <td><img style="cursor:pointer;" id="imgMenu_system" src="images/UP.gif" alt="" width="18" height="19" border="0" onClick="toggleMenu(menu_system,imgMenu_system);"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td><div id="menu_system">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr bgcolor="#E0E0E0">
                            <td height="22"><div align="right"><a href="#" title="Home"><img src="images/view.gif" alt="Home" border="0" height="18" width="18"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="changeadmin/index.php" target="mainFrame" class="tableInner">Change Admin Name </a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td width="14%" height="22"><div align="right"><a href="#" title="Home"><img src="images/Lock1.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="changepass/index.php" target="mainFrame" class="tableInner">Change Password </a></span></td>
                          </tr>
                          <tr bgcolor="#E0E0E0">
                            <td width="14%" height="22"><div align="right"><a href="#" title="Home"><img src="images/logout.gif" alt="Home" border="0" height="21" width="22"></a></div></td>
                            <td style="padding-left:5px; padding-right:5px;"><span class="name"><a href="logout.php" target="_self" class="tableInner">Logout</a></span></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </div></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="46" colspan="2"><div align="right">
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30" valign="top" bgcolor="#A6B3BC" style="padding-bottom:2px;"></td>
                        <td valign="top" style="padding-bottom:2px;"><div align="right"><a href="admin.php" title="Home"><img src="images/FleetStreet_logo.jpg" alt="Home" border="0" heght="40" width="185"></a></div></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr>
          <td id="myLeftTD" width="200" height="550" valign="top" bgcolor="#A6B3BC" style="padding-top:20px; padding-bottom:20px; padding-left:10px; padding-right:10px;">&nbsp;</td>
          <td width="793" valign="top" bgcolor="#F9F8F8" class="headGray" style="padding:5px;"><iframe name="mainFrame" frameborder="0" src ="main.php" width="100%" height="100%"></iframe>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
