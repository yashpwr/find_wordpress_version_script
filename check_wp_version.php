<?

function get_version($url){
    $homepage = file_get_contents($url);
    $doc = new DOMDocument;
    $doc->loadHTML($homepage);
    $xpath = new DOMXPath($doc);
    $data = $xpath->evaluate('//meta[@name="generator"]/@content')->item(0);
    return $data->value;
}

$version = [];

if(isset($_POST['urls'])){
    $arr = explode("\n", $_POST['urls']);

    foreach ($arr as $key => $value) {
        if($value !== ""){
            $url = preg_replace('/\s+/', '', $value);
            $version[$url] = get_version($url);
        }
        
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Check WP Version</title>
</head>
<body>

<section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">Check Wordpress Version</div>

                    <form method="POST">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Website URL</label>
                                    <!-- <input name="url" type="text" class="form-control" placeholder="Enter Website URL" value="<?php echo $_POST['url']; ?>"> -->
                                    <textarea name="urls" cols="30" rows="10"><?php echo $_POST['urls']; ?></textarea>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>

                    </form>
                    <br>
                    <?php 
                    
                        if(isset($version) && !empty($version) ){

                            foreach ($version as $key => $value) { ?>
                                <h3><b><?php echo $key; ?> : <span  style="color: red;" ><?php echo $value; ?><span></b></h3>
                            <? } ?>

                            

                        <?php } ?>
                </div>
            </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    
</body>
</html>