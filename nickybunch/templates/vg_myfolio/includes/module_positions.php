<?php
/****************************** component-top ******************************/

// contenttop - 3 positions
if(  $this->countModules('component-top-a') and $this->countModules('component-top-b') and $this->countModules('component-top-c') ){
	$contenttop = array(
		'col1-3',
		'col1-3',
		'col1-3'
	);
}
// contenttop - 2 first positions
if(  $this->countModules('component-top-a') and $this->countModules('component-top-b') and !$this->countModules('component-top-c') ){
	$contenttop = array(
		'col2-3',
		'col1-3',
		''
	);
}
// contenttop - 2 last positions
if(  !$this->countModules('component-top-a') and $this->countModules('component-top-b') and $this->countModules('component-top-c') ){
	$contenttop = array(
		'',
		'col2-3',
		'col1-3'
	);
}
// contenttop - first and last positions
if(  $this->countModules('component-top-a') and !$this->countModules('component-top-b') and $this->countModules('component-top-c') ){
	$contenttop = array(
		'col2-3',
		'',
		'col1-3'
	);
}
// contenttop - just first position
if(  $this->countModules('component-top-a') and !$this->countModules('component-top-b') and !$this->countModules('component-top-c') ){
	$contenttop = array(
		'col1-1',
		'',
		''
	);
}
// contenttop - just second position
if(  !$this->countModules('component-top-a') and $this->countModules('component-top-b') and !$this->countModules('component-top-c') ){
	$contenttop = array(
		'',
		'col1-1',
		''
	);
}
// contenttop - just last position
if(  !$this->countModules('component-top-a') and !$this->countModules('component-top-b') and $this->countModules('component-top-c') ){
	$contenttop = array(
		'',
		'',
		'col1-1'
	);
}

/****************************** component-top ******************************/

// contentbottom - 3 positions
if(  $this->countModules('component-bottom-a') and $this->countModules('component-bottom-b') and $this->countModules('component-bottom-c') ){
	$contentbottom = array(
		'col1-3',
		'col1-3',
		'col1-3'
	);
}
// contentbottom - 2 first positions
if(  $this->countModules('component-bottom-a') and $this->countModules('component-bottom-b') and !$this->countModules('component-bottom-c') ){
	$contentbottom = array(
		'col2-3',
		'col1-3',
		''
	);
}
// contentbottom - 2 last positions
if(  !$this->countModules('component-bottom-a') and $this->countModules('component-bottom-b') and $this->countModules('component-bottom-c') ){
	$contentbottom = array(
		'',
		'col2-3',
		'col1-3'
	);
}
// contentbottom - first and last positions
if(  $this->countModules('component-bottom-a') and !$this->countModules('component-bottom-b') and $this->countModules('component-bottom-c') ){
	$contentbottom = array(
		'col2-3',
		'',
		'col1-3'
	);
}
// contentbottom - just first position
if(  $this->countModules('component-bottom-a') and !$this->countModules('component-bottom-b') and !$this->countModules('component-bottom-c') ){
	$contentbottom = array(
		'col1-1',
		'',
		''
	);
}
// contentbottom - just second position
if(  !$this->countModules('component-bottom-a') and $this->countModules('component-bottom-b') and !$this->countModules('component-bottom-c') ){
	$contentbottom = array(
		'',
		'col1-1',
		''
	);
}
// contentbottom - just last position
if(  !$this->countModules('component-bottom-a') and !$this->countModules('component-bottom-b') and $this->countModules('component-bottom-c') ){
	$contentbottom = array(
		'',
		'',
		'col1-1'
	);
}

/****************************** footer ******************************/

// footer - 3 positions
if(  $this->countModules('footer-a') and $this->countModules('footer-b') and $this->countModules('footer-c') ){
	$contentfooter = array(
		'col1-3',
		'col1-3',
		'col1-3'
	);
}
// footer - 2 first positions
if(  $this->countModules('footer-a') and $this->countModules('footer-b') and !$this->countModules('footer-c') ){
	$contentfooter = array(
		'col2-3',
		'col1-3',
		''
	);
}
// footer - 2 last positions
if(  !$this->countModules('footer-a') and $this->countModules('footer-b') and $this->countModules('footer-c') ){
	$contentfooter = array(
		'',
		'col2-3',
		'col1-3'
	);
}
// footer - first and last positions
if(  $this->countModules('footer-a') and !$this->countModules('footer-b') and $this->countModules('footer-c') ){
	$contentfooter = array(
		'col2-3',
		'',
		'col1-3'
	);
}
// footer - just first position
if(  $this->countModules('footer-a') and !$this->countModules('footer-b') and !$this->countModules('footer-c') ){
	$contentfooter = array(
		'col1-1',
		'',
		''
	);
}
// footer - just second position
if(  !$this->countModules('footer-a') and $this->countModules('footer-b') and !$this->countModules('footer-c') ){
	$contentfooter = array(
		'',
		'col1-1',
		''
	);
}
// footer - just last position
if(  !$this->countModules('footer-a') and !$this->countModules('footer-b') and $this->countModules('footer-c') ){
	$contentfooter = array(
		'',
		'',
		'col1-1'
	);
}
?>