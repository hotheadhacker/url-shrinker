<div class="list-group-item clearfix">
    <center>
        <h5 class="text-info m-4">Enter a URL to Shrink</h5>
        <form method="post" class="m-4">
        <?php echo validation_errors(); ?> 
        <input type="url" name="urlField" value="" placeholder="https://example.com/some-long-string" autocomplete="off" required />
        <input type="Submit" value="submit">
        </form>
    </center>
</div>