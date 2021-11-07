

<center>
    <h1>Submitted Successfully: </h1>
    <?php echo $this->input->post('urlField'); ?>
    <br />
    <!-- The text field -->
    <input type="text" value=<?php echo $url;?> class="m-4" disabled="disabled" id="myInput">

    <!-- The button used to copy the text -->
    <button class="btn btn-success" onclick="myFunction()">Copy URL</button>
    <br />
    <a href="/" class="btn btn-outline-success animate__animated animate__heartBeat m-4">Shrinking Another URL?</a>
</center>

<script>
    function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>
