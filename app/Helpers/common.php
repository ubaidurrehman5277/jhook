<?php
    require dirname(dirname(dirname(__FILE__)))."/dompdf/vendor/autoload.php";
    use Dompdf\Dompdf;
    use Dompdf\Options;
    function pdf_generate($html, $file="", $is_view = false, $is_download = false,$page_size ="legal",$orientation="portrait"){
        $options = new Options();
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($page_size, $orientation);
        if($is_download){
            $dompdf->render();
            $dompdf->stream($file, array("Attachment" => true));
            exit(0);
        }
        if($is_view){
            $dompdf->render();
            $output = $dompdf->output();
            if(file_exists(base_path("/public/images/$file"))){
                unlink(base_path("/public/images/$file"));
            }
            file_put_contents(base_path("/public/images/$file"), $output);
        }else{
            $dompdf->render();
            $output = $dompdf->output();
            file_put_contents(base_path("/public/images/$file"), $output);
        }

    }