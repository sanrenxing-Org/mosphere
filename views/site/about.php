<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.team{margin-top:15px;}
.avatar{ margin:15px auto} 
.avatar img{ border-radius:50%}
</style>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        We are devoted to share everything about music,movies,games and photograph. We tend to the idea that be interested,be interesting.
    </p>
	<div class="team">
		<div class="avatar">
			<img src="<?php echo res?>/images/profile/avatar/default.jpg">
			<span>mos,站长，负责网站的开发与设计</span>
		</div>
		<div class="avatar"><img src="<?php echo res?>/images/profile/avatar/default.jpg"></div>
		<div class="avatar"><img src="<?php echo res?>/images/profile/avatar/default.jpg"></div>
		<div class="avatar"><img src="<?php echo res?>/images/profile/avatar/default.jpg"></div>
	</div>
</div>
