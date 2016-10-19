<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Account';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Your profile</h3>
    </div>
    <div class="panel-body">
		<div>
			<p>Profile picture</p>
			<div>
				<div style="float:left;"><img src="/mosphere/web/statics/images/profile/avatar/<?php echo Yii::$app->user->identity->avatar;?>}" style="width:90px;height:90px;"></div>
				<div style="margin-left:100px;">
					<p><button type="button" class="btn btn-default btn-sm"><input type="file"></button></p>
					
					<p><h6>You can also drag and drop a picture from your computer.</h6></p>
				</div>
			</div>
		</div>
		<div style="clear:both;">
           <?php $form = ActiveForm::begin(['id' => 'account-form']); ?>

           <?= $form->field($model, 'username')->textInput() ?>
			<?= $form->field($model, 'signature')->textInput() ?>
           <?= $form->field($model, 'email') ?>

           <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'account-button']) ?>
           </div>
           <?php ActiveForm::end(); ?>
		</div>
            
    </div>
    
</div>



