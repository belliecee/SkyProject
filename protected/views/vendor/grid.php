<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jQueryEffect.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui-1.10.2.custom.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/dhtmlx/grid/dhtmlxcommon.js"type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/dhtmlx/grid/dhtmlxgrid.js" 		type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/dhtmlx/grid/dhtmlxgridcell.js" 	type="text/javascript" charset="utf-8"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/dhtmlx/dhtmlxdataprocessor.js" 	type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/dhtmlx/connector/connector.js" 	type="text/javascript" charset="utf-8"></script>

	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dhtmlx/grid/dhtmlxgrid.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dhtmlx/grid/skins/dhtmlxgrid_dhx_skyblue.css" type="text/css" media="screen" title="no title" charset="utf-8">

	


	<div id="grid_here" style='display:block; width:350px; height:350px; margin: 0 auto; overflow:hidden; '>
	</div>
	<br/>
   
	<input type="button" value='Add new row' onclick='add_row()'>
    
	<input type="button" value='Delete selected' onclick='mygrid.deleteSelectedRows()'>


<script type="text/javascript" charset="utf-8">
	
        function add_row(){
		var id = mygrid.uid();
		mygrid.addRow(id, ["id, Vendor Name"]);
		mygrid.selectRowById(id);
	}
       
        
	mygrid = new dhtmlXGridObject('grid_here');
	mygrid.setImagePath("./dhtmlx/grid/imgs/");
	mygrid.setHeader("ID,Name");
        mygrid.setColSorting("int,str"); // define sorting state for columns 0-3
	
       
	mygrid.setColTypes("ro,ed");
	mygrid.setSkin("dhx_skyblue");
	mygrid.init();
      
	mygrid.loadXML("./grid_data");
     
       
       
	var dp = new dataProcessor("./grid_data");
      
	dp.attachEvent("onAfterUpdate", function(sid, action, tid, xml){
		if (action == "invalid"){
			mygrid.setCellTextStyle(sid, 2, "background:#eeaaaa");
			dhtmlx.message(xml.getAttribute("details"));
		}
	})
        
	dp.init(mygrid);
      
        
        
</script>
        

