<?php
include '../connection.php';
session_start();
if(isset($_SESSION['tchr']))
{
$uid=$_SESSION['tchr'];
    $sel_data=mysqli_query($dbcon,"select * from staf_data where stfif='$uid'");
    $rdata=mysqli_fetch_row($sel_data);
    $cid=$rdata[3];
    $did=$rdata[4];
    $selcrs=mysqli_query($dbcon,"select * from crs_info where crsid='$cid'");
    $rcrs=mysqli_fetch_row($selcrs);
    $seldep=mysqli_query($dbcon,"select * from dep_info where depid='$did'");
    $rdep=mysqli_fetch_row($seldep);
}   
else{
    header("location:../index.php");
}
if(isset($_POST['sub10']))
{
    $qn=$_POST['qn'];
    $mrk=$_POST['mrk'];
    $subid=$_GET['subid'];
    $cid=$_GET['cid'];
    $did=$_GET['did'];
    $sem=$_GET['sem'];
    $insq=mysqli_query($dbcon,"INSERT INTO `qn_bank`(`qn`, `mrk`, `subid`, `cid`, `did`, `sem`) VALUES ('$qn','$mrk','$subid','$cid','$did','$sem')");
    if($insq>0)
    {
        header("location:mquestions.php?subid=$subid&cid=$cid&did=$did&sem=$sem");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title ?></title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../admin_tmplate/assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../admin_tmplate/assets/css/font-awesome.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="../admin_tmplate/assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../admin_tmplate/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../admin_tmplate/assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../admin_tmplate/assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="../admin_tmplate/assets/js/ace-extra.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../admin_tmplate/assets/js/html5shiv.js"></script>
		<script src="../admin_tmplate/assets/js/respond.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-university"></i>
							<?php echo $hd ?>
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
                                            <li class="brown">
                                                <?php
                                                $chk=mysqli_query($dbcon,"select * from stud_doubt where stfid='$uid' and st='0'");
                                                ?>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-tasks"></i>
								<span class="badge badge-danger"><?php echo mysqli_num_rows($chk) ?></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									<?php echo mysqli_num_rows($chk) ?> New Doubts
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
                                                                            <?php
                                                                            while($rdbt=mysqli_fetch_row($chk))
                                                                            {
                                                                                $st=mysqli_query($dbcon,"select * from student_data where admnum='$rdbt[1]'");
                                                                                $rst=mysqli_fetch_row($st);
                                                                            ?>
										<li><a href="studdoubts.php">Doubt from <?php echo $rst[6] ?></a></li>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </ul>
								</li>

								<li class="dropdown-footer">
									<a href="studdoubts.php">
										See All Doubts
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						

						

						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                                           <img class="nav-user-photo" src="../admin/staff_pic/<?php echo $rdata[10] ?>" alt="<?php echo $rdata[1] ?>" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo $rdata[1] ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="settings.php">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>
								<li class="divider"></li>

								<li>
                                                                    <a href="../logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="">
						<a href="index.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
                                        <li class="open">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-upload"></i>
							<span class="menu-text">
								Upload
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                                                        <li class="">
								<a href="smaterial.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Study Material
								</a>

								<b class="arrow"></b>
							</li>
                                                        <li class="">
								<a href="pquestions.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Previous Questions
								</a>

								<b class="arrow"></b>
							</li>
                                                        <li class="active">
								<a href="mquestions.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Add Question Bank
								</a>

								<b class="arrow"></b>
							</li>
                                                </ul>
                                        </li>
                                        <li class="">
						<a href="exam.php">
							<i class="menu-icon fa fa-file"></i>
							<span class="menu-text"> Exams </span>
						</a>

						<b class="arrow"></b>
					</li>
                                        
					
                                     <!--   <li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-upload"></i>
							<span class="menu-text">
								Upload
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
                                                        <li class="">
								<a href="smaterial.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Study Material
								</a>

								<b class="arrow"></b>
							</li>
                                                        <li class="">
								<a href="pquestions.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Previous Questions
								</a>

								<b class="arrow"></b>
							</li>
                                                </ul>
                                        </li>
                                        -->                                        		
					
                                        <li class="">
                                            <a href="../logout.php">
							<i class="menu-icon fa fa-sign-out"></i>
							<span class="menu-text">Logout </span>
						</a>

						<b class="arrow"></b>
					</li>
                                    </ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">TEACHERS PORTAL <![<?php echo $rcrs[1] ?> | <?php echo $rdep[2] ?>]--></li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<!-- #section:settings.box -->
						<!-- /.ace-settings-container -->

						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								Dashboard :: Upload Questions
								
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
                                                
                                                    <div class="col-xs-12">
                                                        <div class="col-md-6">
                                                             <?php
                                                             if(isset($_GET['subid']))
                                                             {
                                                                 
                                                                 ?>
                                                            <script src="ckeditor/ckeditor.js"></script>
                                                            <script src="ckeditor/samples/js/sample.js"></script>
                                                            <form method="post">
                                                            <table class="table table-bordered table-condensed table-hover">
                                                                <tr>
                                                                    <td>Question Here<textarea id="editor" name="qn" required="required"></textarea>  </td>
                                                                </tr>
                                                                <script>
                                                initSample();
                                                </script>
                                                                <tr>
                                                                    <td>
                                                                        Mark for the Question
                                                                        <select name="mrk" class="form-control">
                                                                            <option value="1">1 Mark</option>
                                                                            <option value="2">2 Mark</option>
                                                                            <option value="3">3 Mark</option>
                                                                            <option value="4">4 Mark</option>
                                                                            <option value="5">5 Mark</option>
                                                                            <option value="6">6 Mark</option>
                                                                            <option value="7">7 Mark</option>
                                                                            <option value="7.5">7.5 Mark</option>
                                                                            <option value="15">15 Mark</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="submit" name="sub10" value="ADD Question" class="btn btn-sm btn-danger pull-right" /></td>
                                                                </tr> 
                                                            </table>
                                                            </form>
                                                            <?php
                                                            $subid=$_GET['subid'];
                                                            $selq=mysqli_query($dbcon,"select * from qn_bank where subid='$subid' order by mrk asc");
                                                            if(mysqli_num_rows($selq)>0)
                                                            {
                                                                ?>
                                                            <table class="table table-bordered table-condensed table-responsive">
                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Question</td>
                                                                    <td>Mark</td>
                                                                </tr>
                                                                <?php
                                                                $i=0;
                                                                while($rq=mysqli_fetch_row($selq))
                                                                {
                                                                    $i++;
                                                                    ?>
                                                                <tr>
                                                                    <td><?php echo $i ?></td>
                                                                    <td><?php echo $rq[1] ?></td>
                                                                    <td><?php echo $rq[2] ?></td>
                                                                </tr>
                                                                <?php
                                                                }
                                                                ?>
                                                            </table>
                                                            <?php
                                                            }
                                                             }
                                                             else
                                                             {
                                                             ?>
                                                             <table class="table table-bordered table-condensed table-hover">
                                                                <tr>
                                                                    <td colspan="4"><center><b>ASSIGNED SUBJECT</b></center></td>
                                                                </tr>
                                                                <?php
                                                                $sels=mysqli_query($dbcon,"select * from subjct_assign where stf_id='$uid'");
                                                                if(mysqli_num_rows($sels)>0)
                                                                {
                                                                    $i=0;
                                                                    while($rs=mysqli_fetch_row($sels))
                                                                    {
                                                                        $i++;
                                                                        ?>
                                                                <tr>
                                                                    <td><?php echo $i ?></td>
                                                                    <td>
                                                                        <?php
                                                                        $selsub=mysqli_query($dbcon,"select * from syllabus_data where sub_id='$rs[5]'");
                                                                        $rsub=mysqli_fetch_row($selsub);
                                                                        echo $rsub[4];
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                        $selc=mysqli_query($dbcon,"select * from qn_bank where subid='$rs[5]'");
                                                                        echo mysqli_num_rows($selc);
                                                                        ?> Qns
                                                                    </td>
                                                                    <td><a href="mquestions.php?subid=<?php echo $rs[5] ?>&cid=<?php echo $rs[2] ?>&did=<?php echo $rs[3] ?>&sem=<?php echo $rs[4] ?>"><span class="fa fa-plus-circle" title="ADD Question"></span></a></td>
                                                                </tr>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </table>
                                                            <?php
                                                             }
                                                             ?>
                                                        </div>
                                                        <div class="col-md-6"></div>
                                                    </div>
                                                    <div class="col-lg-12"></div>
                                                    <!-- /.col -->
						
                                                </div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<?php echo $footr ?>
						</span>

						
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../admin_tmplate/assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../admin_tmplate/assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="../admin_tmplate/assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="../admin_tmplate/assets/js/excanvas.js"></script>
		<![endif]-->
		<script src="../admin_tmplate/assets/js/jquery-ui.custom.js"></script>
		<script src="../admin_tmplate/assets/js/jquery.ui.touch-punch.js"></script>
		<script src="../admin_tmplate/assets/js/jquery.easypiechart.js"></script>
		<script src="../admin_tmplate/assets/js/jquery.sparkline.js"></script>
		<script src="../admin_tmplate/assets/js/flot/jquery.flot.js"></script>
		<script src="../admin_tmplate/assets/js/flot/jquery.flot.pie.js"></script>
		<script src="../admin_tmplate/assets/js/flot/jquery.flot.resize.js"></script>

		<!-- ace scripts -->
		<script src="../admin_tmplate/assets/js/ace/elements.scroller.js"></script>
		<script src="../admin_tmplate/assets/js/ace/elements.colorpicker.js"></script>
		<script src="../admin_tmplate/assets/js/ace/elements.fileinput.js"></script>
		<script src="../admin_tmplate/assets/js/ace/elements.typeahead.js"></script>
		<script src="../admin_tmplate/assets/js/ace/elements.wysiwyg.js"></script>
		<script src="../admin_tmplate/assets/js/ace/elements.spinner.js"></script>
		<script src="../admin_tmplate/assets/js/ace/elements.treeview.js"></script>
		<script src="../admin_tmplate/assets/js/ace/elements.wizard.js"></script>
		<script src="../admin_tmplate/assets/js/ace/elements.aside.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.ajax-content.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.touch-drag.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.sidebar.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.submenu-hover.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.widget-box.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.settings.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.settings-rtl.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.settings-skin.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.searchbox-autocomplete.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});
			
			})
		</script>

		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
		<link rel="stylesheet" href="../admin_tmplate/assets/css/ace.onpage-help.css" />
		<link rel="stylesheet" href="../admin_tmplate/docs/assets/js/themes/sunburst.css" />

		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="../admin_tmplate/assets/js/ace/elements.onpage-help.js"></script>
		<script src="../admin_tmplate/assets/js/ace/ace.onpage-help.js"></script>
		<script src="../admin_tmplate/docs/assets/js/rainbow.js"></script>
		<script src="../admin_tmplate/docs/assets/js/language/generic.js"></script>
		<script src="../admin_tmplate/docs/assets/js/language/html.js"></script>
		<script src="../admin_tmplate/docs/assets/js/language/css.js"></script>
		<script src="../admin_tmplate/docs/assets/js/language/javascript.js"></script>
	</body>
</html>
