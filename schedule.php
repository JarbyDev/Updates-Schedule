<?php
/*
Updates Schedule System Version: 1.0.0
By Jarby Agudelo
Copyright (c) 2015
Based on the mtdowling/cron-expression
Copyright (c) 2009-2012
Updates Schedule System, like mtdowling/cron-expression V1.0.3, is 100% free and open-source.
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the 'Software'), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

require(__DIR__ . '/vendor/autoload.php');
require('db-connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Updates Schedule System">
    <meta name="author" content="Jarby Agudelo">
    <meta name="robots" content="noindex, nofollow">

    <title>Updates Schedule System</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    
    
    <!-- Custom CSS -->
    <link href="assets/css/schedule.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

	<body class="login-layout light-login">
<div class="container">
     <div class="col-lg-6 col-lg-offset-3">
    <!-- PAGE CONTENT BEGINS -->
        <center><h1><span class="red">Updates</span>
		 <span class="black"> Schedule Groups!</h1></span></center>
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4 class="alert-heading">Attention!</h4>
			<p>Click Schedules below for more Information</p>
		</div>
<?php
// Get the schedules
$Schedules_Result = mysqli_query($con,"SELECT * FROM cron_schedule u,active_status a WHERE u.id = a.id and a.status = 1");
while ($row = mysqli_fetch_array($Schedules_Result)) {
    $id=$row['id'];
     // Install OOB 
    $cron = Cron\CronExpression::factory($row['cron']);
    $Chicago =  new \DateTimeZone('America/Chicago');
?>
<p>
<!-- Button trigger modal -->
<a data-toggle="modal" href="#query<?php echo $id;?>" class="btn btn-danger btn-sm btn-block">
<span class="badge"><?php echo $row['code'];?></span>
<?php
    echo $cron->getNextRunDate()->format('D, M-d-Y h:i:s A');
    if ($cron->isDue()) {
        // The Cron should be enabled!
    }
?>
    <span class="label label-danger arrowed-in hidden-xs">
        <?php echo $row['description'];?>
    </span></p></a>
  
    <!-- Modal -->
    <div class="modal fade" id="query<?php echo $id;?>" data-modal-index="1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $row['description'];?></h4>
      </div>
      <div class="modal-body">
        <p class="lead">We Will be performing scheduled maintenance.</p>
        <a class="list-group-item list-group-item-warning"><b>We will be utilizing a maintenance window to update the following Servers:</b></a>
        <br />
<?php
    $result1 = mysqli_query($con,"SELECT * FROM schedule s WHERE s.code = " . $row['code']);
    while($row1 = mysqli_fetch_array($result1))
    {
        echo "<center>{$row1['hostname']}<br/>";
    }
?>
    <br><a class="list-group-item list-group-item-warning">You will receive a maintenance notice announcing the start of the maintenance window, and another notice at the close of the maintenance window, signaling the maintenance is complete.<br/>
    <br/>We apologize for any inconvenience you may experience during this time.<br /><br />
    Sincerely,<br />
    Support Team</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php 
}
?>
<!-- PAGE CONTENT ENDS -->
        </div>
    </div>
	<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<hr><i class="fa fa-calendar red"></i><span class="red bolder"> Updates </span>Schedule System &copy; 2015
						</span>
						&nbsp; &nbsp;
						For the Best Experience use:
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-edge light-blue bigger-150" title="Edge 10+"></i>
							</a>
                            <a href="#">
								<i class="ace-icon fa fa-firefox orange bigger-150" title="Firefox 29+"></i>
							</a>
							<a href="#">
								<i class="ace-icon fa fa-chrome light-gray bigger-150" title="Chrome 32+"></i>
							</a>
							<a href="#">
								<i class="ace-icon fa fa-safari light-blue bigger-150" title="Safari 5+"></i>
							</a>
						</span>
					</div>
					<!-- /section:basics/footer -->
				</div>
			</div>

		<!-- inline scripts related to this page -->

            
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 
</body>
</html>