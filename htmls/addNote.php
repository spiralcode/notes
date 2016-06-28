<?php 
	include "connect.php";
include 'session_check.php';
?>
<div id="notificationSpace" class="notificationSpace"></div>
<div class="writeNoteContainer">
<div class="typeArea">
<div align="center" class="noteProperties" id="noteProperties"><span class="dateSwitchArrow">❬</span>
<span id="noteDate"></span><span class="dateSwitchArrow">❭</span></div>
<textarea id="typeSpace" placeholder="Type your note here..."></textarea>
<div class="buttonPocket">
<input id="saveButton" onclick="transferNote();" class="button-primary" type="button" style="cursor:pointer;" value="Save Note"/>
<input id="changeDate" onclick="showCalender()" class="button-primary" type="button" style="cursor:pointer;" value="Change Date"/>
<input id="setLocation" onclick="showLocationSlot()" class="button-primary" type="button" style="cursor:pointer;" value="Attach a place"/>
<input id="setLocation" onclick="callOut();" class="button-primary" type="button" style="cursor:pointer;" value="Fetch people"/></div>
<input id="dateCave" type="hidden"/></div>
<div class="fileArea" id="filesFiles" dropable>
<div class="option">
Attach files with this Note<span style="cursor:pointer;" onclick="gen.id('fileSelect').click();">Choose Files </span> to <!--<span id="folderSpec" data-id="0" style="cursor:pointer;" onclick="chooseFolders();">Attachments </span> <!--<span style="cursor:pointer;" onclick="startUpload()">Start Upload</span>--><select id="folderSpec">
	<option value="0">Attachments</option>
	<?php

$query = mysqli_query($link, "select id,name from image_folders where userid = $userid")or die(mysqli_error($link));
while($data=mysqli_fetch_array($query))
{	
	echo '<option value='.$data['id'].'>'.$data['name'].'</option>';
}
	?>
</select>
	</div>
<div class="fileList" id="fileList"></div></div>
<div class="places" id = "locationList">
<div class="option">
Attach a place <button  class="turnit" style="cursor:pointer;" id = "fetchTheCoords">Get location </button><button  class="turnit" style="cursor:pointer;" id = "trackMe" onclick="trackMe()">Find my location </button> <!--<span style="cursor:pointer;" onclick="startUpload()">Start Upload</span>--></div>
<div class="mapRoll" id="mapRoll"></div></div>

<!--<div class="peopleSlot" id="peopleSlot"></div></div>
	<div class="toolsSpace"></div>-->
<input id="fileSelect" name="fileSelect[]" multiple type="file" style="display:none;"></div>
