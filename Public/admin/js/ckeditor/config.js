﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	//config.uiColor = '#AADC6E';
	config.skin = 'kama';
	config.width = '78.5%';
	config.height = 300;
	config.toolbarStartupExpanded = true ;
	config.resize_minHeight = 400;
	config.resize_minWidth = 680;
	
	config.toolbar = 'Full';
	
	config.toolbar_Full =
	[
		{ name: 'document', items : [ 'Source'/*,'-','Save','NewPage','DocProps','Preview','Print','-','Templates'*/ ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
		//{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button' ] },
		
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		'/',
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		
		{ name: 'links', items : [ 'Link','Unlink','Anchor'] },
		{ name: 'tools', items : [ 'Maximize', 'ShowBlocks'] },
		{ name: 'styles', items : [ /*'Styles','Format','Font',*/'FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'insert', items : [ 'Files','Image','Flash','Table','HorizontalRule','Smiley'/*,'SpecialChar','PageBreak','Iframe'*/ ] }
	];
	config.toolbar_Basic =
	[
		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About']
	];
};
