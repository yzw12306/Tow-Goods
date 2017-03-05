<?php
use Think;
	$Verify = new \Think\Verify();

	$Verify->fontSize = 30;

	$Verify->length = 3;

	$Verify->useNoise = false;

	$Verify->fontttf = '5.ttf';

	$Verify->useImgBg = true;

	$Verify->entry();
