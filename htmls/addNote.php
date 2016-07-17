<?php 
	include "../connect.php";
include 'session_check.php';
?>
<div id="notificationSpace" class="notificationSpace"></div>
<div class="writeNoteContainer">
<div label="inherit" class="typeArea">
<div align="center" class="noteProperties" id="noteProperties"><span class="dateSwitchArrow">❬</span>
<span id="noteDate"></span><span class="dateSwitchArrow">❭</span></div>
<!--<textarea id="typeSpace" placeholder="Type your note here..."></textarea>-->
<div contenteditable id="typeSpace"></div>
<div class="buttonPocket">
<!--<input id="saveButton" onclick="transferNote();" class="button-juice" type="button" style="cursor:pointer;" value="Save Note"/>-->
<div id="saveButton" onclick="transferNote();" class="button-juice" type="button" style="cursor:pointer;" value="Save Note">Save</div>
<div id="changeDate" onclick="showCalender()" class="button-juice" type="button" style="cursor:pointer;" value="Change Date">Change Date</div>
<div id="setLocation" onclick="showLocationSlot()" class="button-juice" type="button" style="cursor:pointer;" value="Attach a place">Attach a place</div>
<div disabled="disabled" id="setLocation" onclick="callOut();" class="button-juice" type="button" style="cursor:pointer;" value="Fetch people">Fetch People</div>
</div>
<input id="dateCave" type="hidden"/></div>
<div label="inherit" class="fileArea">
<div class="option">
<span title="Attach a file with this Note." style="cursor:pointer;  padding:.1em" onclick="gen.id('fileSelect').click();">+ Attach files </span> to <!--<span id="folderSpec" data-id="0" style="cursor:pointer;" onclick="chooseFolders();">Attachments </span> <!--<span style="cursor:pointer;" onclick="startUpload()">Start Upload</span>--><select title="Choose a folder, you can create a folder from the 'Files' option." id="folderSpec">
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
<div label="inherit" class="places" id = "locationList" style="position:relative; float:right;">
<div class="option">
Attach a place <button  class="turnit" style="cursor:pointer;" id = "fetchTheCoords">Get location </button><button  class="turnit" style="cursor:pointer;" id = "trackMe" onclick="trackMe()">Find my location </button> <!--<span style="cursor:pointer;" onclick="startUpload()">Start Upload</span>--></div>
<div class="mapRoll" id="mapRoll"></div></div>

<!--<div class="peopleSlot" id="peopleSlot"></div></div>
	<div class="toolsSpace"></div>-->
<input id="fileSelect" name="fileSelect[]" multiple type="file" style="display:none;"></div>
