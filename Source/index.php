<!DOCTYPE HTML>
<html>
    <head>
        <title>Softwarepraktikum 2018</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
       <link rel="stylesheet" href="./css/dropzone.css">
		
		
       <link rel="stylesheet" href="./css/images.css">
        
        <script src="Scripts/dropzone.js"></script>
        
       <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </head>
    
    <body>
		
		<ul class="nav nav-pills list-inline" role="tablist" style="background-color: LightGrey;">
			
  <li id="websiteName">Praktikum '18</li>
  <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#home" role="tab">Upload</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu1" role="tab">Analyse</a></li>
  <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#menu2" role="tab">Ergebnisse</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane active" style="padding-left: 2rem;" role="tabpanel">
    <h3>Cel-Files zum Analysieren hochladen</h3>
    <div>
                        <!--++++++++++++START OF UPLOAD+++++++++++++++++++-->
                        <section>
                            <form id="projectform">
                                Enter your Projectname:
                                <input type="text" id="projectname">
                            </form>
                            <div id="dropzone">
                                <form action="./Scripts/uploadDropzone.php" class="dropzone dz-clickable" name="updrop" id="updrop" enctype="multipart/form-data">
                                    <div class="dz-message">Drop files here or click to upload.</div>
                                </form>
                            </div>
                        </section>
                        <script>
                            Dropzone.options.updrop={
                                acceptedFiles:".CEL"
                            };    
                        </script>
    
                        <!--+++++++++++++++++UPLOAD BUTTONS+++++++++++++++++++++++-->
                        <div id="btnAndProgress">
                            <div class="row" id="buttons">
                            <form method="post" enctype="multipart/form-data" id="Upload">
                            <div class="row">
                                <label class="btn btn-success fileinput-button">
                                    <i class="fa fa-plus"></i>
                                    <span>Add Files</span>
                                    <input type="file" name="files[]" id="files[]" onchange="filelist()" multiple hidden>
                                     
                                </label>
            
                                <label class="btn btn-primary start" >
                                    <i class="fa fa-arrow-circle-o-up"></i>
                                    <span>Start Upload</span>
                                    <input type="submit" value="upload" onclick=goto() hidden>
                                </label>
								
								<script>
									function goto(){
									$('#menu1').tab('show');
									}
								</script>
            
                                <label type="reset" class="btn btn-warning cancel">
                                    <i class="fa fa-ban"></i>
                                    <span>Cancel Upload</span>
                                    <input onclick=reload() hidden>
                                    <script> function reload(){location.reload();}</script>
                                </label>
								
								<label class="btn btn-warning cancel" style="background-color: red;">
                                    <i class="fa fa-ban"></i>
                                    <span>Delete</span>
                                    <input type="button" class="button" onclick=deleteFiles() hidden>
									<script> 
										function deleteFiles(){
    										$.post("delete.php");
											return false;
											}
									</script>
                                </label>
                            </div>
                            </form>
                            </div>
        
                            <!-- ++++++++++++++++++PROGRESS BAR (NOT IMPLEMENTED!) +++++++++++++-->
                            <!--
                            <div id="progress" class="row">
                                
                                <span class="fileupload-process">
                                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"   aria-valuenow="0">
                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                                </span>
                            </div>-->
                        </div>
                        
                        <table>
                            <tbody>
                                <script>
                                    function filelist(){
                                        var filelist = document.getElementById('files[]').files;
                                        document.getElementById('test').innerHTML = filelist;
                                        var fileCount = filelist.length;
                                        if(fileCount > 2){
                                            for(var i=3; i < fileCount; i++){
                                                var rowCount = table.rows.length;
                                                var row = table.insertRow(rowCount);
                                                    
                                                var newcell = row.insertCell(0);
                                                newcell.innerHTML = filelist[i]; 
                                            }
                                        }
                                   }
                                </script>
                                    
                            </tbody>
                        </table>
                        <!-- ++++++++++++++++++++++UPLOAD PHP ++++++++++++++++++++++++++++++++-->
                        
                        <?php
                            if (isset($_FILES['files'])) {
                            $total = count($_FILES['files']['tmp_name']);
                    
                                for($i=0; $i < $total ; $i++){
                                    $tmpFilePath = $_FILES['files']['tmp_name'][$i];
                    
                                    if($tmpFilePath != ""){
                                        $newFilePath = "../Input/".$_FILES['files']['name'][$i];
                        
                                        move_uploaded_file($tmpFilePath, $newFilePath);
                                    }   
                                }   
                            }
                        ?>
                    </div>
  </div>
  <div id="menu1" class="tab-pane fade" role="tabpanel">
                        <!-- +++++++++++++++++++++ CODE FOR PROCESSING++++++++++++++++++++++++-->
                    <div style="padding-left: 2rem;">
                <div>
                    <p id="info"></p>
                    <form method="post" name="form" id="form">
                        <div id="formcontent"></div>
                        <script>
                            /*Get all names from files in input folder*/
                            var names = <?php $dir = '../Input'; $names = scandir($dir); echo json_encode($names);?>;
                            var namesCount = names.length;
                                
                            /*has always two entries, so two means Input is empty*/
                            if(namesCount == 2){
                                document.getElementById("info").innerHTML = "Please upload some files first!";
                            }
                            /*Show instruction when there are files*/
                            else{
                                document.getElementById("info").innerHTML = "Select if the file contains diseased or control data:";
                                        
                                var buffer= "";
                                var template1='<section><label>';
                                var template2 = '</label><select name="select"><option value=1></option><option value=2>Desease</option><option value=3>Control</option></select></section>'
                                for(i=2; i < namesCount; i++){
                                    buffer = buffer.concat(template1,names[i],template2);            
                                }
                                document.getElementById("formcontent").innerHTML = buffer;
                            }
                        </script>
                        <section id="analysebtn"></section>
                        <script>
                            var names = <?php $dir = '../Input'; $names = scandir($dir); echo json_encode($names);?>;
                            var namesCount = names.length;
                            if(namesCount != 2){
                                document.getElementById('analysebtn').innerHTML= '<label class="btn btn-primary start" id="analyse"><i class="fa fa-play"></i><span>Analyse</span><input type="submit" value="Submit" onclick="readselect()" id="analyse" hidden></label>'
                            }
                        </script>
                    </form>
                            
                    <p id="runinfo"></p>
                    <script>
                        function readselect(){
                            var type = $('form').serialize();
                            var type2 = type.replace(/&|select=/gi, "");
                
                            document.getElementById('runinfo').innerHTML = type2;
                
                            window.location.href = "Scripts/Ranalyse.php?name=" + type2;
							$('#menu2').tab('show');
                        }
                    </script>
                </div>
                </div>
	  
	 				 	<div id="activity-indicator" style="margin-top: 70px;" hidden>
							<img  src="spinner.gif" height="50" width="50"/>
						</div>
							
                    </div>
	
  <div id="menu2" class="tab-pane fade" role="tabpanel">
    <h3>Analyseergebnisse:</h3>
	  
	  <button onclick=zeigeErgebnisse()>Zeige Ergebnisse!</button>
                    <div class="card-body">
                    <!-- +++++++++++++++++++++ CODE FOR RESULTS++++++++++++++++++++++++-->
                   	<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

	<!-- Modal Caption (Image Text) -->
  			<div id="caption"></div>
		</div>
						
		<div id="imagesKlein" style="float: left;">
			<?php
     $files = glob("../Output/*.*");
     for ($i=0; $i<count($files); $i++)
      {
        $image = $files[$i];
        $supported_file = array(
                'gif',
                'jpg',
                'jpeg',
                'png'
         );

         $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
		  $imageDiv = "";
         if (in_array($ext, $supported_file)) {
			 echo '<div class="modalDiv">';
            echo "<h3>".basename($image)."</h3>"."<br />";
             echo '<img src="'.$image .'" alt=" '.basename($image).'" onclick="showModal(this)" class="modalImage"/>';
				 echo "<br /><br />";
			echo'</div>';
            } else {
                continue;
            }
          }
       ?>
			
	</div>
		  <script>
			  function zeigeErgebnisse(){
				$.post("bilderAnzeigen.php", function(data){
					$("#imagesKlein").html(data);
				});
					return false;
			  }
			</script>
<script src="Scripts/modalImages.js"></script>
                    </div>
                </div>
			</div>

    
    </body>
</html>