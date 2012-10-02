<?php
/*********************************************************************************
 * The X2CRM by X2Engine Inc. is free software. It is released under the terms of 
 * the following BSD License.
 * http://www.opensource.org/licenses/BSD-3-Clause
 * 
 * X2Engine Inc.
 * P.O. Box 66752
 * Scotts Valley, California 95066 USA
 * 
 * Company website: http://www.x2engine.com 
 * Community and support website: http://www.x2community.com 
 * 
 * Copyright (C) 2011-2012 by X2Engine Inc. www.X2Engine.com
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * - Redistributions of source code must retain the above copyright notice, this 
 *   list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright notice, this 
 *   list of conditions and the following disclaimer in the documentation and/or 
 *   other materials provided with the distribution.
 * - Neither the name of X2Engine or X2CRM nor the names of its contributors may be 
 *   used to endorse or promote products derived from this software without 
 *   specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
 * IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, 
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, 
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF 
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE 
 * OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 ********************************************************************************/

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
require_once "dbConfig.php";
require_once "emailConfig.php";


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>$appName,
	'sourceLanguage'=>'en',
	'language'=>$language,

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		 'application.controllers.*',
		 'application.models.*',
		 'application.components.*',		
	),

	'modules'=>array(
		'gii'=>$gii,
		'mobile',
	),

//	'behaviors' => array('ApplicationConfigBehavior'),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'file'=>array(
			'class'=>'application.extensions.CFile',
		),
		// uncomment the following to enable URLs in path-format
		'db'=>array_merge($db,array(
			'schemaCachingDuration'=>84600
		)),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>$email,
		'adminModel'=>null,
		'profile'=>null,
		'roles'=>array(),
		'groups'=>array(),
		'logo'=>"uploads/logos/yourlogohere.png",
		'webRoot'=>__DIR__.DIRECTORY_SEPARATOR.'..',
		'trueWebRoot'=>substr(__DIR__,0,-17), 
		'registeredWidgets'=>array(
			'TimeZone' => 'Time Zone',
			'MessageBox'=>'Message Board',
			'QuickContact'=>'Quick Contact',
			'GoogleMaps'=>'Google Map',
			'TwitterFeed'=>'Twitter Feed',
			'ChatBox'=>'Chat',
			'NoteBox'=>'Note Pad',
			'ActionMenu'=>'My Actions',
			'TagCloud'=>'Tag Cloud',
			'OnlineUsers'=>'Active Users',
			'MediaBox' => 'Media',
			'DocViewer' => 'Doc Viewer',
			'TopSites' => 'Top Sites',
		),
		'currency'=>'',
		'version'=>$version,
		'buildDate'=>$buildDate,
	),
);
