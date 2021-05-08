<?php

namespace Model\Entities;

use \Model\Fpdf;

class Report
{
    use \Library\Shared;
	use \Library\Entity;

    public function toPDF(){
		$this->pdf->AddPage();
		$this->pdf->SetFont('Arial','B',16);
		$this->pdf->Cell(40,10,'Hello World!');
		$this->pdf->Output();	
		$this->TG->alert("pdf");
    }

    public function save():self {
		$db = $this->db;
		$db->insert(['Reports'=>['user'=>$this->user,'path'=>$this->path]]);
		return $this;
	}

    public function __construct(public Int $user, public String $from, public String $to,
                                public String $content, public String $path) {
		$this->db = $this->getDB();
        $this->pdf = new FPDF();
	}
}
