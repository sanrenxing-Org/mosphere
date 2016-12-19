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
			<?php $form = ActiveForm::begin(['id' => 'account-form']); ?>
				<div style="float:left;"><img id="avatar" src="<?php echo res?>images/profile/avatar/<?php echo empty(Yii::$app->user->identity->avatar)?'default.jpg':Yii::$app->user->identity->avatar;?>" style="width:90px;height:90px;"></div>
				<div style="margin-left:100px;">
					<p><input name="sfile" type="file" accept="image.png,image.jpg" onchange="show_avatar(this)" /></p>
					<p><h6>You can also drag and drop a picture from your computer.</h6></p>
				</div>
			</div>
		</div>
		<div style="clear:both;">
           <?= $form->field($model, 'username')->textInput();?>
			<?= $form->field($model, 'signature')->textInput();?>
           <?= $form->field($model, 'email') ?>

           <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'account-button']) ?>
           </div>
           <?php ActiveForm::end(); ?>
		</div>
            
    </div>
    
</div>
<script type="text/javascript">
function show_avatar(obj){
	//浏览器不支持FileReader则不处理
    if (!window.FileReader) return;
    var files = obj.files;
    for (var i = 0, f; f = files[i]; i++) {
        if (!f.type.match('image.*')) {  
            continue;  
        }  
        var reader = new FileReader();
        reader.onload = (function(theFile) {  
            return function(e) {
                // img 元素  
            	$("#avatar").attr("src",e.target.result);
            }; 
        })(f);  
        reader.readAsDataURL(f);
    }
}
</script>


