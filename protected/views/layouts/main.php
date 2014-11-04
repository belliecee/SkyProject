<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.3.custom.js"></script>
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui/css/smoothness/jquery-ui-1.10.3.custom.css" />
<!--
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
-->	

 <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
           <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?>
                <div id="nowuser" style="float:right; font-size:14px; margin-right: 30px;">
                    
                    
                    <?php if(!Yii::app()->user->isGuest){ ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <b>สวัสดีคุณ</b>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <?php echo user::model()->findByPk(Yii::app()->user->getId())->username; ?><br/>
                        <b>สิทธิ์ในการเข้าใช้งานคือ</b>
                        &nbsp;&nbsp;
                         <?php echo user::model()->findByPk(Yii::app()->user->getId())->auth; ?><br/>
                    
                   <?php } ?>
                </div>
               </div>
	</div><!-- header -->
        <?php
              $thisuser =  user::model()->findByPk(Yii::app()->user->getId());
              $visi = false;
              $cansee = false;
              if(Yii::app()->user->isGuest){
                  $visi = false;  $cansee = false;
              }
              else{
                 if($thisuser != null){
                    $group = user::model()->findByPk(Yii::app()->user->getId())->auth;
                    $auth = usergroup::model()->findByAttributes(array('name'=>$group)); 
                   if($auth->name == "admin"){ $visi = true;
                       
                   }
                    $cansee = true;
                 }
                
                 
              }
              
             
           
             
                
        ?>
      	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
			
                                array(
                                        'label'=>'Search',
                                        'url'=>array('project/theproject'),
                                        'linkOptions'=>array('id'=>'menuChange'),
                                        'itemOptions'=>array('id'=>'itemChange'),
                                       
                                        'items'=>array(
                                          array('label'=>'Project', 'url'=>array('project/theproject')),  
                                          array('label'=>'Taiwan Order & Stock', 'url'=>array('project/taiwanandstock')),
                                          array('label'=>'Check Price', 'url'=>array('project/checkprice')),
                                          array('label'=>'Follow Quotation', 'url'=>array('project/followquotation')),
                                          array('label'=>'Waiting Quotation', 'url'=>array('project/waitingquotation')),
                                          array('label'=>'Follow PO', 'url'=>array('project/followpo')),
                                          array('label'=>'Follow Taiwan Quotation', 'url'=>array('project/followtaiwanquotation')),
                                          array('label'=>'Complete', 'url'=>array('project/complete')),
                                        ),
                                      ),
                                array('label'=>'Taiwan-Order', 'url'=>array('project/index','projecttype'=>1),'visible'=>$cansee),
                                array('label'=>'Made-Order', 'url'=>array('project/index','projecttype'=>2),'visible'=>$cansee),
                                array('label'=>'Stock-Order', 'url'=>array('project/index','projecttype'=>3),'visible'=>$cansee),
                                array(
                                        'label'=>'Configuration', 
                                        'url'=>array('customer/admin'),
                                        'linkOptions'=>array('id'=>'menuChange'),
                                        'itemOptions'=>array('id'=>'itemChange'),
                                        'visible' => $visi,
                                        'items'=>array(
                                                 array('label'=>'Customer', 'url'=>array('customer/admin')),
                                                 array('label'=>'Vendor', 'url'=>array('vendor/admin')),
                                                 array('label'=>'Model', 'url'=>array('product/admin')),
                                                 array('label'=>'Type', 'url'=>array('type/admin')),
                                        )
                                    ),
                            array(
                                        'label'=>'Administrator', 
                                        'url'=>array('user/update','id'=>Yii::app()->user->getId()),
                                        'linkOptions'=>array('id'=>'menuChange'),
                                        'itemOptions'=>array('id'=>'itemChange'),
                                        'visible' => $visi,
                                        'items'=>array(
                                                 array('label'=>'My Profile', 'url'=>array('user/update','id'=>Yii::app()->user->getId())),
                                                 array('label'=>'Change Password', 'url'=>array('user/changepassword','id'=>Yii::app()->user->getId())),
                                                 array('label'=>'User List', 'url'=>array('user/index'), 'visible'=>$visi),
                                                 array('label'=>'User Group', 'url'=>array('usergroup/index','id'=>Yii::app()->user->getId())),
                                        )
                                    ),
                                
				
                            
                                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
        

        
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Bizkit Corp.<br/>
		All Rights Reserved.<br/>
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
