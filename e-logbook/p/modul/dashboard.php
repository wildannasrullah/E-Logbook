<div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>      
                </div>
            </div>

            <div class="row clearfix">
			<div class="col-lg-7 col-md-3">
			<div class="card">
                        <div class="header">
                            <h2>Timeline</h2>
						</div>
                        <div class="body">
						<div class="card text-center bg-info">
							<div class="p-15 text-light">
								<h2><?php echo date('d');?><?php echo "".tgl_indo(date('M'))."&nbsp;". date('Y');?></h2>
							</div>
						</div>
                            
                        </div>
                    </div>
				</div>
                <div class="col-lg-4 col-md-10">
                    <div class="card top_counter">
                        <div class="body">
							<div class="icon"><i class="fa fa-exclamation"></i> </div>
							<div class="content">
                                
								<?php
								$date = date('Y-m-d');
								
								if($_SESSION[level]=='superadmin'){
								?>
								<div class="text">All Division Problems Today</div>
                                <h1 class="number">
								<?php
								$p = mysql_num_rows(mysql_query("select *from tproblems p left join user u on p.created_by=u.username
																 where dateprob = '$date'"));
								echo $p;
								}else{
								?>
								<div class="text">Division Problems Today</div>
                                <h1 class="number">
								<?php
								$p = mysql_num_rows(mysql_query("select *from tproblems p left join user u on p.created_by=u.username
																 where divisi='$_SESSION[divisi]' and dateprob = '$date'"));
								echo $p;
								}
								?>
								</h1>
                            </div>
                            <hr>
                            <div class="icon"><i class="fa fa-tasks"></i> </div>
                            <div class="content">
                               
								<?php
								if($_SESSION[level]=='superadmin'){
								?>
									<div class="text">Total All Division Problems </div>
									<h1 class="number">
								<?php
									$p = mysql_num_rows(mysql_query("select *from tproblems p left join user u on p.created_by=u.username"));
								}else{
								?>
									<div class="text">Total Division Problems </div>
									<h1 class="number">
								<?php
									$p = mysql_num_rows(mysql_query("select *from tproblems p left join user u on p.created_by=u.username
																 where divisi='$_SESSION[divisi]'"));
								}
								echo $p;
								?>
								</h1>
                            </div>
							 <hr>
                        </div>
                    </div>
                </div>
				<div class="col-lg-7 col-md-8">
				<div class="card">
                        <div class="header">
                            <h2>Hot Problems</h2>
                        </div>
                        <div class="body">                           
                            <ul class="right_chat list-unstyled">
							<?php
								$date = date('Y-m-d');
								$p = mysql_query("SELECT a.*,mc.category_name,b.status,c.pic_handling FROM `tproblems` a 
															left join tlaporan b on a.idprob=b.no_pelaporan 
															LEFT JOIN mcategories mc ON a.idcat=mc.idcat 
															left join tassign c on a.idprob=c.no_pelaporan
															where a.divisi_problem='$_SESSION[divisi]' order by idprob desc LIMIT 4");
								while($j = mysql_fetch_array($p)){
									$l = mysql_fetch_array(mysql_query("select *from user where username = '$j[created_by]'"));
							?>
                                <li class="online">
                                    <a href="<?php echo "?p=new-post&act=problem-detail&id=$j[idprob]"; ?>">
                                        <div class="media">
										<?php
										if($l[photo]==''){
												echo "<img class='media-object' alt='User Profile Picture' src='modul/master/users/photo/no_image.jpg'>";
										}
										else{
												echo "<img class='media-object' src='modul/master/users/photo/$l[photo]'>";
										}
										?>
                                            <div class="media-body">
                                                <span class="name"><?php echo $l[fullname]; 
											if($j[status]=="O"){
												echo "<span class='badge badge-primary'> OPEN </span>";
											}
											else if ($j[status]=="A"){
												echo "<span class='badge badge-danger'> ASSIGN TO $j[pic_handling] </span>";
											}
											else if ($j[status]=="IN"){
												echo "<span class='badge badge-danger'> IN PROGRESS <i class='fas fa-spinner fa-pulse'></i> </span>";
											}
											else if ($j[status]=="F"){
												echo "<span class='badge badge-success'> FINISHED BY $j[pic_handling]</span>";
											}
											else if ($j[status]=="C"){
												echo "<span class='badge badge-default'> CLOSE</span>";
											}
												if($j[status_del]=='Delete'){
														echo "&nbsp;&nbsp;<font color='red'> [ DELETE !! ] &nbsp;<i class='fas fa-spinner fa-pulse'></i></font>";
													}
												else{}
												?> <small class="float-right"><?php echo "".tgl_indo($j[dateprob]); ?></small></span>
                                                <span class="message"><?php 
												echo $j[judulprob];

												?></span>
                                                <span class="badge badge-outline status"></span>
                                            </div>
                                        </div>
                                    </a>                            
                                </li>
							<?php
								}
							?>
                            </ul>
							<p align='right'><a href='?p=new-post&act=problem-list'>See All <i class="fa fa-angle-double-right"></i> </a></p>
                        </div>
                    </div>
				</div>
                <div class="col-lg-4 col-md-6">
                   <div class="card">
                        <div class="header">
                            <h2>Categories </h2>
                        </div>
                        <div >                            
                            <ul class="list-unstyled feeds_widget">
								<?php
								$r = showCategory();
								foreach($r as $t){
									$h = mysql_num_rows(mysql_query("select *from tproblems where idcat = '$t[idcat]'"));
								echo"
								<li>
                                <a href='?p=new-post&act=problem-list&t=1&id=$t[idcat]&category=$t[category_name]'>
                                    <div class='feeds-left'><i class='fa fa-thumbs-o-up'></i></div>
                                    <div class='feeds-body'>
                                        <h6 class='title'><font color='black'>$t[category_name] </font><small class='float-right text-muted badge badge-primary'>$h</small></h6>
                                    </div>    
								</a>
                                </li>  ";
								}
								?>
                            </ul>
                        </div>
                    </div> 
                </div>
				
            </div>            
            </div>

            