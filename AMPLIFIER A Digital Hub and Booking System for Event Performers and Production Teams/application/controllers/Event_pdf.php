<?php
    class Event_Pdf extends CI_Controller {
        public function index(){
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                // [width, height]
                'format' => [150, 200],
                'orientation' => 'P',
                'img_dpi' => 300,
            ]);
            // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'utf-8', [190, 236]]);
            $stylesheet = file_get_contents(base_url().'assets/css/pdf.css');
            $html = $this->load->view('client/event_pdf',[],true);
            $mpdf->writeHTML($stylesheet, 1);
            $mpdf->WriteHTML($html);
            $mpdf->Output(); // opens in browser
            //$mpdf->Output('test.pdf','D'); // it downloads the file into the user system.
        }
    }