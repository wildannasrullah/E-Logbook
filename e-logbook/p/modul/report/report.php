 <?php
 error_reporting(0);
session_start(); 
$m = date(m);$d = date(d);$y = date(Y);
$aksi="modul/actlog/act_log.php";
$dated = date('Y-m-d');
$a = mysql_query("select *from user where username='$_SESSION[username]'");
$user = mysql_fetch_array($a);
 ?>
 <div class="container-fluid">
			<?php
switch($_GET[act]){
default:
			echo"
			<div class='block-header'>
                <div class='row'>
                    <div class='col-lg-5 col-md-8 col-sm-12'>                        
                        <h2><a href='javascript:void(0);' class='btn btn-xs btn-link btn-toggle-fullwidth'><i class='fa fa-arrow-left'></i></a> Problem Report</h2>
                        <ul class='breadcrumb'>
                            <li class='breadcrumb-item'><a href='?p=dashboard'><i class='icon-home'></i></a></li>                            
                            <li class='breadcrumb-item active'>Report</li>
                        </ul>
                    </div>         
                </div>
            </div>
			<div class='col-lg-12 col-md-12'>
                    <div class='card'>
                        <div class='header'>
                            <h2>Problem Report</h2>
                        </div>
                        <div class='body'>
                           <div class='row'>
                               <div class='col-lg-6 col-md-12'>
                                   <h6>Filter</h6>
									<form method='POST' action=''>
										<div class='list-group'>
											<div class='input-group mb-3'>
												<div class='input-group-prepend'>
													<select name='filter' class='btn btn-outline-secondary' required>
														<option>--- Filter ---</option>
														<option value='idprob'>Problem Code</option>
														<option value='judulproblem'>Problem Title</option>
														<option value='kategori'>Problem Category</option>
														<option value='doc'>Related Document</option>
														<option value='created'>Created By</option>
													</select>
												</div>
												<input type='text' name='kata' class='form-control' aria-label='Text input with dropdown button' autofocus>
												<div class='input-group-append'>
													<button class='btn btn-outline-secondary' type='submit'>Show</button>
												</div>
											</div>
										</div>
									</form>
								</div>
                               <div class='col-lg-6 col-md-12'>
                                   
                                     <div class='list-group'>
                                        &nbsp;
                                     </div>
                                </div>
                           </div>
							</div>
							</div></div>
				<div class='col-lg-12 col-md-12'>
                    <div class='card'>
                        <div class='body'>
                           <div class='row'>
						    <div class='col-lg-12 col-md-12'>
							<div class='table-responsive'>
                                <table class='table table-striped table-hover dataTable js-exportable'>
                                    <thead>
                                        <tr>
                                            <th align='center'>PROBLEMS</th>
                                            <th width='10%'>TIME</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
										$kata = trim($_POST['kata']);
										// mencegah XSS
										$kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);
										// pisahkan kata per kalimat lalu hitung jumlah kata
										$pisah_kata = explode(" ",$kata);
										$jml_katakan = (integer)count($pisah_kata);
										$jml_kata = $jml_katakan-1;
										
									if($_POST[filter]=='idprob'){
										$cari = "SELECT * FROM tproblems tp LEFT JOIN mcategories mc ON tp.idcat=mc.idcat WHERE " ;
										for ($i=0; $i<=$jml_kata; $i++){
												$cari .= "idprob LIKE '%$pisah_kata[$i]%'";
											if ($i < $jml_kata ){
													$cari .= " OR ";
												}
										}
											$cari .= " ORDER BY idprob DESC";
									}else if($_POST[filter]=='judulproblem'){
										$cari = "SELECT * FROM tproblems tp LEFT JOIN mcategories mc ON tp.idcat=mc.idcat WHERE " ;
										for ($i=0; $i<=$jml_kata; $i++){
												$cari .= "judulprob LIKE '%$pisah_kata[$i]%'";
											if ($i < $jml_kata ){
													$cari .= " OR ";
												}
										}
											$cari .= " ORDER BY idprob DESC";
									}else if($_POST[filter]=='kategori'){
										$cari = "SELECT * FROM tproblems tp LEFT JOIN mcategories mc ON tp.idcat=mc.idcat WHERE " ;
										for ($i=0; $i<=$jml_kata; $i++){
												$cari .= "mc.category_name LIKE '%$pisah_kata[$i]%'";
											if ($i < $jml_kata ){
													$cari .= " OR ";
												}
										}
											$cari .= " ORDER BY idprob DESC";
									}else if($_POST[filter]=='doc'){
										$cari = "SELECT * FROM tproblems tp LEFT JOIN mcategories mc ON tp.idcat=mc.idcat left join tdoc d on tp.idprob=d.idprob WHERE " ;
										for ($i=0; $i<=$jml_kata; $i++){
												$cari .= "nodoc LIKE '%$pisah_kata[$i]%'";
											if ($i < $jml_kata ){
													$cari .= " OR ";
												}
										}
											$cari .= " ORDER BY tp.idprob DESC";
									}else if($_POST[filter]=='created'){
										$cari = "SELECT * FROM tproblems tp LEFT JOIN mcategories mc ON tp.idcat=mc.idcat WHERE " ;
										for ($i=0; $i<=$jml_kata; $i++){
												$cari .= "created_by LIKE '%$pisah_kata[$i]%'";
											if ($i < $jml_kata ){
													$cari .= " OR ";
												}
										}
											$cari .= " ORDER BY idprob DESC";
									}else{
										$cari = "SELECT *from tproblems where divisi_problem = '$user[divisi]' order by idprob DESC";
									}
									$hasil  = mysql_query($cari);
									$ketemu = mysql_num_rows($hasil);
									echo "<h6 align='right'>Key : $kata . Found<font color='red'> $ketemu </font>entries.</h6>";
									while($r = mysql_fetch_array($hasil)){
									echo "
                                        <tr>
                                            <td><a href='?p=new-post&act=problem-detail&id=$r[idprob]'><h6><b>$r[judulprob]</b></h6></a>
												<div class='col-4'>                     
												</div>
											</td>
                                            <td>".tgl_indo($r[dateprob])." <br> $r[timeprob]</td>
                                        </tr>";
									}
										
                              echo"      </tbody>
                                </table>
                            </div>
							
                        </div>
                    </div></div>
							";
	break;
}
?>
