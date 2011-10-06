<?php
/*********************************************************************************
 * X2Engine is a contact management program developed by
 * X2Engine, Inc. Copyright (C) 2011 X2Engine Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY X2Engine, X2Engine DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact X2Engine, Inc. at P.O. Box 66752,
 * Scotts Valley, CA 95067, USA. or at email address contact@X2Engine.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * X2Engine" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by X2Engine".
 ********************************************************************************/

Yii::import('zii.widgets.CWidget');

class InlineActionForm extends CWidget {
	public $associationType;
	public $associationId;
	public $assignedTo;
	public $users;
	public $startHidden = false;

	public function init() {
		Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/x2forms.js');
		Yii::app()->clientScript->registerScript('hideActionForm',
			"$(document).ready(hideActionForm);
			function hideActionForm() {
				$('#action-form').hide();
			}
			",CClientScript::POS_HEAD);
		
		if (!$this->startHidden) {
			Yii::app()->clientScript->registerScript('gotoActionForm',
				"$('#action-form').ready(gotoActionForm);
				function gotoActionForm() {
					$('#action-form').show();
					//toggleForm('#action-form',400);
					$('#action-form #ActionChild_actionDescription').focus();
				}
				",CClientScript::POS_HEAD);
		}
		parent::init();
	}

	public function run() {
		$actionModel = new ActionChild;
		$actionModel->associationType = $this->associationType;
		$actionModel->associationId = $this->associationId;
		$actionModel->assignedTo = $this->assignedTo;
		echo $this->render('../../views/actions/_form', array('actionModel'=>$actionModel,'users'=>$this->users,'inlineForm'=>true));
	}
}
?>